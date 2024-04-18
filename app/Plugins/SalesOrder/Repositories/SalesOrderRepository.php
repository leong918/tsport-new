<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\SalesOrder;
use App\Repositories\BaseRepository;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Utils\IDGenerator;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerNoteMail;
use App\Plugins\SalesOrder\Mail\AdminOrderStatusMail;
use App\Plugins\SalesOrder\Mail\OrderStatusMail;
use Illuminate\Container\Container;
use App\Plugins\SalesOrder\Repositories\SalesOrderLogRepository;
use App\Repositories\CountryRepository;
use App\Repositories\UserRepository;
use App\Repositories\PointLogRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductAttributeTermRepository;
use App\Repositories\LevelRepository;
use App\Repositories\LevelChangeLogRepository;
use App\Repositories\ProductBalanceLogRepository;
use App\Repositories\ReferralRepository;
use App\Repositories\SettingRepository;
use Carbon\Carbon;

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
        Schema::dropIfExists('cart_rule');
        Schema::dropIfExists('wishlist');
    }

    public function installExtension()
    {
        Schema::dropIfExists('sales_order');

        Schema::create('sales_order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('country_id');
            $table->string('sales_order_id');
            $table->string('payment_method')->nullable();
            $table->string('delivery_partner');
            $table->string('tracking_number')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->decimal('subtotal', 16, 2)->default(0);
            $table->decimal('shipping', 16, 2)->default(0);
            $table->decimal('discount', 16, 2)->default(0);
            $table->decimal('point_redemption', 16, 2)->default(0);
            $table->decimal('total', 16, 2)->default(0);
            $table->integer('point_earned')->default(0);
            $table->integer('point_used')->default(0);
            $table->tinyInteger('status')->default(0);
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
            $table->string('level_change')->nullable();
            $table->tinyInteger('is_free_shipping')->default(0);
            $table->tinyInteger('is_pay_later')->default(0);
            $table->tinyInteger('is_buy_now_order')->default(0);
            $table->timestamp('payment_succeed_at')->nullable();
            $table->timestamp('payment_failed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('sales_order_product');

        Schema::create('sales_order_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_order_id');
            $table->bigInteger('product_id');
            $table->string('product_attribute_term')->nullable();
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
            $table->string('type')->nullable();
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
            $table->string('product_attribute_term')->nullable();
            $table->string('user_ip');
            $table->decimal('price', 16, 2)->default(0);
            $table->integer('quantity');
            $table->decimal('total_price', 16, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('cart_rule');

        Schema::create('cart_rule', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('table_id')->nullable();
            $table->string('name');
            $table->string('coupon_code')->nullable();
            $table->string('type');
            $table->string('target_table')->nullable();
            $table->string('discount_type');
            $table->decimal('value', 16, 2)->default(0);
            $table->integer('priority')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('wishlist');

        Schema::create('wishlist', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('product_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function getSalesOrderByUserId(int $id)
    {
        return SalesOrder::where('user_id', $id);
    }

    public function getListing(array $form_data)
    {
        $models = SalesOrder::query()->orderBy('created_at', 'desc');
        foreach (array_filter($form_data, 'filter') as $key => $value) {
            if ($key === 'sales_order.sales_order_id') {
                $models->where($key, 'like', "%{$value}%");
            } elseif ($key === 'date_range') {
                if (str_contains($value, ' - ')) {
                    $dates = explode(' - ', $value);
                    $dateFrom = Carbon::parse($dates[0])->startOfDay();
                    $dateTo = Carbon::parse($dates[1])->endOfDay();
                    $models->whereBetween('created_at', [$dateFrom, $dateTo]);
                } else {
                    $date = Carbon::parse($value);
                    $models->whereDate('created_at', $date);
                }
            } else {
                $models->where($key, $value);
            }
        }
        return $models;
    }

    public function getListingByID(array $order_id_list)
    {
        return SalesOrder::leftJoin('sales_order_product', 'sales_order_product.sales_order_id', '=', 'sales_order.id')
            ->leftJoin('product', 'product.id', '=', 'sales_order_product.product_id')
            ->whereIn('sales_order.id', $order_id_list)
            ->selectRaw('sales_order.*, sales_order_product.quantity, sales_order_product.product_name, sales_order_product.quantity, sales_order_product.price, product.sku')
            ->get();
    }

    public function getExportListing(array $form_data)
    {

        $models = SalesOrder::leftJoin('sales_order_product', 'sales_order_product.sales_order_id', '=', 'sales_order.id')
            ->leftJoin('product', 'product.id', '=', 'sales_order_product.product_id');

        foreach (array_filter($form_data, 'filter') as $key => $value) {
            if ($key === 'sales_order.sales_order_id') {
                $models->where($key, 'like', "%{$value}%");
            } elseif ($key === 'date_range') {
                if (str_contains($value, ' - ')) {
                    $dates = explode(' - ', $value);
                    $dateFrom = Carbon::parse($dates[0])->startOfDay();
                    $dateTo = Carbon::parse($dates[1])->endOfDay();
                    $models->whereBetween('sales_order.created_at', [$dateFrom, $dateTo]);
                } else {
                    $date = Carbon::parse($value);
                    $models->whereDate('sales_order.created_at', $date);
                }
            } else {
                $models->where($key, $value);
            }
        }

        return $models->selectRaw('sales_order.*, sales_order_product.quantity, sales_order_product.product_name, sales_order_product.quantity, sales_order_product.price, product.sku')->get();
    }

    public function updateSalesOrder(array $input, int $id, $admin)
    {
        $salesOrderlogRepository = new SalesOrderLogRepository(new Container());
        $salesOderTotalRepository = new SalesOrderTotalRepository(new Container());
        $sales_order = SalesOrder::find($id);
        $order_total_id = null;
        $editedOrderTotal = array();
        $level_change = null;
        foreach ($input as $key => $value) {
            $previousValue = $sales_order->$key;

            if (str_starts_with($key, 'order_total_')) {
                $order_total_id = (int)substr($key, strpos($key, "order_total_") + strlen("order_total_"));
                $editedOrderTotal = $salesOderTotalRepository->updateOrderTotal($id, null, $order_total_id, $value);
            } else {

                if ($key == 'country_id') {
                    $countryRepository = new CountryRepository(new Container());
                    $country = $countryRepository->find($value);
                    $sales_order->country = $country->name;
                }

                if ($key == 'status') {
                    //update success order if order processing/completed
                    if ($previousValue == 0 && $value > 0) {
                        $sales_order->shipping_fee_status = $sales_order->is_pay_later == 0 ? 1 : 0;
                        $this->updateSuccessOrder($sales_order);
                    }
                    //update failed order if order failed/cancelled/refunded
                    if ($previousValue >= 0 && $value < 0) {
                        $this->updateFailedOrder($sales_order, $admin, $previousValue, $value);

                        //return if cancel order from onhold/processing/completed
                        $level_change = $sales_order->level_change;
                    }

                    //add product balance if order status changed from < 0 to >= 0
                    if ($previousValue < 0 && $value >= 0) {
                        $this->updateProductQuantity($sales_order, "DEDUCT", $admin, $previousValue, $value);
                    }
                }

                $sales_order->$key = $value;
                $sales_order->save();
            }

            //For log purpose
            if ($key == 'status') {
                $previousValue = renderModelData(SalesOrder::ORDER_STATUS, $previousValue);
                $value = renderModelData(SalesOrder::ORDER_STATUS, $value);
            }

            if ($key == 'payment_method') {
                $previousValue = renderModelData(SalesOrder::PAYMENT_METHOD, $previousValue);
                $value = renderModelData(SalesOrder::PAYMENT_METHOD, $value);
            }

            //after done create log
            $editedColumn  = $order_total_id ? $editedOrderTotal['title'] : $key;
            $previousValue = $order_total_id ? $editedOrderTotal['previousValue'] : $previousValue;
            $description = "Change <b>" . $editedColumn . "</b> from " . ($previousValue ? (is_numeric($previousValue) ? number_format($previousValue, 2)  : $previousValue) : '<i>Empty</i>') . " to " . ($value ? (is_numeric($value) ? number_format($value, 2) : $value) : '<i>Empty</i>');
            $salesOrderlogRepository->createLog($sales_order, $admin->id, 'admin', 1, $description);
            if ($key == 'customer_note') {
                $description = "Your Order (" . $sales_order->sales_order_id . ") has updated a note. <br> <b>" . $value . "</b>";
                Mail::to($sales_order->user->email)->send(new CustomerNoteMail($description));
            }
        }

        return $level_change;
    }

    public function toggleStatus(int $id)
    {
        $model = SalesOrder::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    public function createOrder($data, $cartTotal, $buyNowData)
    {
        $id_generator = new IDGenerator('App\\Plugins\\SalesOrder\\Models\\SalesOrder', 'sales_order_id', 'TC');
        $id_generator->length(6);
        $sales_order_id = $id_generator->generate();

        $order = new SalesOrder();
        $order->fill($data['address']);
        $order->delivery_partner = $cartTotal['delivery_partner'];
        $order->user_id = $data['user_id'];
        $order->sales_order_id = $sales_order_id;
        $order->subtotal = $cartTotal['subtotal'];
        $order->shipping = $cartTotal['shipping_fee'];
        $order->discount = $cartTotal['total_discount_amount'];
        $order->point_redemption = $cartTotal['point_redemption'];
        $order->total = $cartTotal['total'];
        $order->point_earned = $data['point_earned'];
        $order->point_used = $data['point_used'];
        $order->payment_method = $data['payment_method'];
        $order->status = $cartTotal['total'] <= 0 ? 2 : 0;
        $order->stripe_payment_intent_id = $data['payment_method'] === 'stripe' ? $data['stripe_payment_intent_id']['clientSecret'] : null;
        $order->is_free_shipping = $cartTotal['is_free_shipping'];
        $order->is_pay_later = $cartTotal['is_pay_later'];
        $order->is_buy_now_order = $buyNowData ? true : false;
        $order->save();

        return $order;
    }

    public function getSalesOrderId($sales_order_id)
    {
        return SalesOrder::where('sales_order_id', $sales_order_id)->first();
    }

    public function getOrderByPaymentIntentId($payment_intent_id)
    {
        return SalesOrder::where('stripe_payment_intent_id', $payment_intent_id)->first();
    }

    public function updateStripeSalesOrder($stripe_client_secret, $status)
    {
        $sales_order = SalesOrder::where('stripe_payment_intent_id', $stripe_client_secret)->first();
        if ($sales_order && $sales_order->status == 0) {
            $description = 'Stripe Payment Update. Status: ' . array_flip(SalesOrder::ORDER_STATUS)[$status];

            $sales_order->status = $status == 1 ? 2 : $status;
            if ($status == 1) {
                $sales_order->payment_succeed_at = Carbon::now();
                $this->updateSuccessOrder($sales_order);
            } else {
                $sales_order->payment_failed_at = Carbon::now();
                $this->updateFailedOrder($sales_order);
            }
            $sales_order->save();

            $salesOrderLogRepository = new SalesOrderLogRepository(new Container());
            $salesOrderLogRepository->createLog($sales_order, $sales_order->user_id, 'user', $status, $description);

            // send mail to admin
            $settingRepository = new SettingRepository(new Container());
            $receiver = $settingRepository->getValueByKey('notification_email');
            $date = Carbon::parse($sales_order->created_at);
            $formattedDate = $date->format('F j, Y');
            $status = renderModelData(SalesOrder::ORDER_STATUS, $sales_order->status);
            Mail::to($receiver)->send(new AdminOrderStatusMail($sales_order,$formattedDate,$status));
        }
    }

    public function getOrderStatus()
    {
        $status = array_flip(SalesOrder::ORDER_STATUS);

        return $status;
    }

    public function updateSuccessOrder($sales_order)
    {
        if ($sales_order->point_used > 0) {
            $pointLogRepository = new PointLogRepository(new Container());
            $pointLogData['user_id'] = $sales_order->user_id;
            $pointLogData['sales_order_id'] = $sales_order->id;
            $pointLogData['point'] = $sales_order->point_used;
            $pointLogData['type'] = 'OUT';
            $pointLogData['remark'] = 'Create New Order ' . $sales_order->sales_order_id;
            $pointLogRepository->create($pointLogData);
        }

        if ($sales_order->point_earned > 0) {
            //add point
            $userRepository = new UserRepository(new Container());
            $userRepository->addOrderPoint($sales_order);
        }

        $referralRepository = new ReferralRepository(new Container());
        // update referral voucher
        $referral_voucher = $referralRepository->getReferrerDiscount($sales_order->user_id, $sales_order->id);
        if ($referral_voucher) {
            $referral_voucher->referrer_voucher_used_at = Carbon::now();
            $referral_voucher->save();
        }

        $referee_voucher = $referralRepository->getRefereeDiscount($sales_order->user_id, $sales_order->id);
        if ($referee_voucher) {
            $referee_voucher->referee_voucher_used_at = Carbon::now();
            $referee_voucher->save();
        }
        // end update

        // level validation
        $userRepository = new UserRepository(new Container());
        $user = $userRepository->find($sales_order->user_id);
        $total_accumulate_amount = 0;

        if ($user->level_upgrade_at) {
            $total_accumulate_amount = SalesOrder::where('user_id', $user->id)
                ->where('status', '>', 0)
                ->where('created_at', '>', $user->level_upgrade_at)
                ->sum('total');

            // status havent updated to database
            $total_accumulate_amount += $sales_order->total;
        }

        // check level upgrade
        $level_upgrade = false;
        $levelRepository = new LevelRepository(new Container());
        $levelChangeLogRepository = new LevelChangeLogRepository(new Container());
        $cartRuleRepository = new CartRuleRepository(new Container());

        if ($user->level_id == 1 || $user->level_id == 2) {
            $current_level = $levelRepository->find($user->level_id);
            $next_level_target = $levelRepository->getNextLevel($current_level->leveling);

            if ($user->level_id == 1) {
                $insider_discount = $cartRuleRepository->makeModel()->where('type', 'insider_discount')->first();
                $check_condition = $sales_order->salesOrderTotal->where('cart_rule_id', $insider_discount->id)->first();
            } else {
                $check_condition = $$total_accumulate_amount >= $next_level_target->target_amount;
            }

            if ($check_condition) {
                $data['user_id'] = $user->id;
                $data['level_id'] = $user->level_id;
                $data['new_level_id'] = $next_level_target->id;
                $data['sales_order_id'] = $sales_order->id;
                $data['remark'] = 'Upgrade from level ' . $user->level->name . ' to ' . $next_level_target->name;
                $data['previous_validity'] = $user->level_validity ?? Carbon::now();
                $data['current_validity'] = Carbon::now()->addYear();
                $levelChangeLogRepository->createLevelLog($data);

                $user->level_id = $next_level_target->id;
                $user->level_upgrade_at = Carbon::now();
                $user->level_validity = Carbon::now()->addYear();
                $user->save();

                $level_upgrade = true;

                //save to sales order
                $sales_order->level_change = "upgrade";
            }
        }
        // end check level upgrade

        // check level extend
        if ($level_upgrade == false && ($user->level_id == 2 || $user->level_id == 3)) {
            $same_level_target = $levelRepository->find($user->level_id);
            if ($total_accumulate_amount >= $same_level_target->extend_amount) {
                $previous_validity = $user->level_validity;
                $current_validity = Carbon::parse($user->level_validity)->addYear();
                $user->level_validity = $current_validity;
                $user->save();

                $data['user_id'] = $user->id;
                $data['level_id'] = $user->level_id;
                $data['new_level_id'] = $user->level_id;
                $data['sales_order_id'] = $sales_order->id;
                $data['remark'] = 'Extend level ' . $user->level->name;
                $data['previous_validity'] = $previous_validity;
                $data['current_validity'] = $current_validity;

                $levelChangeLogRepository->createLevelLog($data);

                //save to sales order
                $sales_order->level_change = "extend";
            }
        }
        // end check level extend
        // end level validation

        $sales_order->save();
    }

    public function updateFailedOrder($sales_order, $admin = null, $previousOrderStatus = null, $newOrderStatus = null)
    {
        // return point used
        if ($sales_order->point_used > 0) {
            // return point
            $userRepository = new UserRepository(new Container());
            $userRepository->returnFullPoint($sales_order);

            // return point log
            $pointLogRepository = new PointLogRepository(new Container());
            $pointLogRepository->returnPointUsed($sales_order);

            $sales_order->point_used = 0;
        }

        // deduct point point
        if ($sales_order->point_earned > 0) {
            $userRepository = new UserRepository(new Container());
            $userRepository->deductOrderPoint($sales_order);

            $sales_order->point_earned = 0;
        }

        $referralRepository = new ReferralRepository(new Container());
        // update referral voucher
        $referral_voucher = $referralRepository->getReferrerDiscount($sales_order->user_id, $sales_order->id);
        if ($referral_voucher) {
            $referral_voucher->referrer_sales_order_id = null;
            $referral_voucher->referrer_voucher_used_at = null;
            $referral_voucher->save();
        }

        $referee_voucher = $referralRepository->getRefereeDiscount($sales_order->user_id, $sales_order->id);
        if ($referee_voucher) {
            $referee_voucher->referee_sales_order_id = null;
            $referee_voucher->referee_voucher_used_at = null;
            $referee_voucher->save();
        }
        // end update

        //deduct product balance
        $this->updateProductQuantity($sales_order, 'ADD', $admin, $previousOrderStatus, $newOrderStatus);

        $sales_order->save();
    }

    public function updateProductQuantity($sales_order, $action, $admin, $previousOrderStatus = null, $newOrderStatus = null)
    {
        foreach ($sales_order->salesOrderProduct as $sales_order_product) {
            $productBalanceLogRepository = new ProductBalanceLogRepository(new Container());
            $description = null;

            if ($admin) {
                $previousStatus = renderModelData(SalesOrder::ORDER_STATUS, $previousOrderStatus);
                $newStatus = renderModelData(SalesOrder::ORDER_STATUS, $newOrderStatus);
                $description = "Product " . ($action == "ADD" ? "added" : "deducted") . " due to status changes of order " . $sales_order->sales_order_id . " from " . $previousStatus . " to " . $newStatus . " by " . $admin->name;
            } else {
                $description = "Product " . ($action == "ADD" ? "added" : "deducted") . " due to stripe payment " . ($action == "ADD" ? "succeed." : "failed.");
            }

            if ($sales_order_product->product_attribute_term) {
                $productRepository = new ProductAttributeTermRepository(new Container());
                $product_attribute_term_list = json_decode($sales_order_product->product_attribute_term);

                foreach ($product_attribute_term_list as $value) {
                    $product_attribute_term = $productRepository->find($value);
                    $product_attribute_term->quantity = $action == "ADD" ? $product_attribute_term->quantity += $sales_order_product->quantity : $product_attribute_term->quantity -= $sales_order_product->quantity;
                    $product_attribute_term->save();

                    $data['stock_option'] = $action == "ADD" ? 0 : 1;
                    $data['stock_amount'] = $sales_order_product->quantity;
                    $productBalanceLogRepository->createProductBalanceLog($product_attribute_term, $data, null, $description);
                }
            } else {
                $productRepository = new ProductRepository(new Container());
                $product = $productRepository->find($sales_order_product->product_id);

                $product->quantity = $action == "ADD" ? $product->quantity += $sales_order_product->quantity : $product->quantity -= $sales_order_product->quantity;
                $product->save();

                $data['type'] = $action;
                $data['quantity'] = $sales_order_product->quantity;
                $productBalanceLogRepository->createProductBalanceLog($product, null, $data, $description);
            }
        }
    }
}
