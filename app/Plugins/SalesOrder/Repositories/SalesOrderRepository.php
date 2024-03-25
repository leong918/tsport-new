<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\SalesOrder;
use App\Repositories\BaseRepository;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Utils\IDGenerator;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerNoteMail;
use Illuminate\Container\Container;
use App\Plugins\SalesOrder\Repositories\SalesOrderLogRepository;
use App\Repositories\CountryRepository;

class SalesOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     */
    public function model()
    {
        return SalesOrder::class;
    }

    public function uninstallExtension()
    {
        Schema::dropIfExists('sales_order');
        Schema::dropIfExists('sales_order_product');
        Schema::dropIfExists('sales_order_total');
        Schema::dropIfExists('sales_order_log');
        Schema::dropIfExists('user_cart');
    }

    public function installExtension()
    {
        Schema::dropIfExists('sales_order');

        Schema::create('sales_order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('country_id');
            $table->string('sales_order_id');
            $table->string('payment_method');
            $table->string('stripe_payment_intent_id')->nullable();
            $table->decimal('subtotal', 16, 2)->default(0);
            $table->decimal('shipping', 16, 2)->default(0);
            $table->decimal('discount', 16, 2)->default(0);
            $table->decimal('total', 16, 2)->default(0);
            $table->integer('point')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('phone_no');
            $table->string('email');
            $table->string('country');
            $table->string('postcode');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->longText('customer_note')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('sales_order_product');

        Schema::create('sales_order_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_order_id');
            $table->bigInteger('product_id');
            $table->bigInteger('product_attribute_term_id')->nullable();
            $table->string('product_image');
            $table->string('product_name');
            $table->string('product_attribute_term_name')->nullable();
            $table->decimal('price', 16, 2)->default(0);
            $table->integer('quantity');
            $table->decimal('total_price', 16, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('sales_order_total');

        Schema::create('sales_order_total', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_order_id');
            $table->bigInteger('user_id');
            $table->bigInteger('cart_rule_id')->nullable();
            $table->string('title');
            $table->string('code');
            $table->decimal('value', 16, 2)->default(0);
            $table->string('text');
            $table->integer('sort');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('sales_order_log');

        Schema::create('sales_order_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_order_id');
            $table->bigInteger('user_id');
            $table->bigInteger('admin_id')->nullable();
            $table->string('description');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('user_cart');

        Schema::create('user_cart', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('product_id');
            $table->bigInteger('product_attribute_term_id')->nullable();
            $table->string('user_ip');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function getListing()
    {
        return SalesOrder::query()->orderBy('created_at', 'desc');
    }

    public function updateSalesOrder(array $input, int $id)
    {
        $salesOrderlogRepository = new SalesOrderLogRepository(new Container());
        $sales_order = SalesOrder::find($id);
        foreach($input as $key => $value)
        {
            $previousValue = $sales_order->$key;
            if($key == 'shipping')
            {
                if($value > $previousValue)
                {
                    $sales_order->total += ($value - $previousValue);
                }else{
                    $sales_order->total -= ($previousValue - $value);
                }

            }

            if($key == 'discount')
            {
                if($value > $previousValue)
                {
                    $sales_order->total -= ($value - $previousValue);
                }else{
                    $sales_order->total += ($previousValue - $value);
                }

            }

            if($key == 'country_id')
            {   
                $countryRepository = new CountryRepository(new Container());
                $country = $countryRepository->find($value);
                $sales_order->country = $country->name; 
            }

            $sales_order->$key = $value;
            $sales_order->save();

            //For log purpose
            if($key == 'status')
            {
                $previousValue = renderModelData(SalesOrder::ORDER_STATUS, $previousValue);
                $value = renderModelData(SalesOrder::ORDER_STATUS, $value);
            }

            if($key == 'payment_method')
            {
                $previousValue = renderModelData(SalesOrder::PAYMENT_METHOD, $previousValue);
                $value = renderModelData(SalesOrder::PAYMENT_METHOD, $value);
            }

            //after done create log
            $admin_id = auth()->guard('admin')->user()->id;
            $description = "Change ". $key ." from ". $previousValue ." to ". $value;
            $salesOrderlogRepository->createLog($sales_order, $admin_id,'admin', 1, $description);
            if($key == 'customer_note')
            {
                $description = "Your Order (" . $sales_order->sales_order_id . ") has updated a note. <br> <b>".$value."</b>";
                Mail::to($sales_order->user->email)->send(new CustomerNoteMail($description));
            }
        }
    }

    public function toggleStatus(int $id)
    {
        $model = SalesOrder::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    public function createOrder($data)
    {
        $id_generator = new IDGenerator('App\\Plugins\\SalesOrder\\Models\\SalesOrder', 'sales_order_id', 'TC');
        $id_generator->length(6);
        $sales_order_id = $id_generator->generate();

        $order = new SalesOrder();
        $order->fill($data['address']);
        $order->user_id = $data['user_id'];
        $order->sales_order_id = $sales_order_id;
        $order->payment_method = $data['payment_method'];
        $order->stripe_payment_intent_id = $data['payment_method'] === 'stripe' ? $data['stripe_payment_intent_id']['clientSecret'] : null;
        $order->save();

        return $order;
    }

    public function getSalesOrderId($sales_order_id)
    {
        return SalesOrder::where('sales_order_id', $sales_order_id)->first();
    }
}
