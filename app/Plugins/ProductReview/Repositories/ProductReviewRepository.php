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
            $table->bigInteger("user_id");
            $table->bigInteger("product_id");
            $table->integer("rate")->default(5);
            $table->string("username");
            $table->longText("comment");
            $table->tinyInteger("status")->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function getListing()
    {
        return ProductReview::query()->orderBy('created_at', 'desc');
    }

    public function toggleStatus(int $id)
    {
        $model = ProductReview::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
