<?php

namespace App\Plugins\ProductReview\Repositories;

use App\Plugins\ProductReview\Models\ProductReview;
use App\Repositories\BaseRepository;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
    ];

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
        return ProductReview::class;
    }

    public function uninstallExtension($table_name)
    {
        Schema::dropIfExists($table_name);
    }

    public function installExtension($table_name)
    {
        Schema::dropIfExists($table_name);

        Schema::create($table_name, function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->nullable();
            $table->bigInteger("product_id");
            $table->integer("rate")->default(5);
            $table->string("username");
            $table->longText("comment");
            $table->tinyInteger("status")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function getListing()
    {
        return ProductReview::leftJoin('product', 'product.id', '=', 'product_review.product_id')
            ->orderBy('product_review.created_at', 'desc')
            ->select('product_review.*', 'product.name');
    }

    public function getReviewByProductId(int $id)
    {
        return ProductReview::leftJoin('user', 'user.id', '=', 'product_review.user_id')
            ->where(['product_id' => $id, 'product_review.status' => 1])
            ->orderBy('product_review.created_at', 'desc')
            ->select('product_review.*', 'user.last_name');
    }

    public function  getAvgProductRating(int $id)
    {
        return ProductReview::where('product_id', $id)->avg('rate');
    }

    public function createProductReview(array $data)
    {
        $model = new ProductReview();
        $model->fill($data);
        $model->save();

        return $model;
    }

    public function toggleStatus(int $id)
    {
        $model = ProductReview::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
