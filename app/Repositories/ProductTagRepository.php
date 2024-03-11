<?php

namespace App\Repositories;

use App\Models\ProductTag;
use App\Traits\FileUpload;
use Illuminate\Container\Container;

class ProductTagRepository extends BaseRepository
{
    use FileUpload;

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
        return ProductTag::class;
    }

    public function getListing()
    {
        return ProductTag::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(ProductTag::all(), $key, 'name');
    }

    public function createProductTag(array $input, int $product_id)
    {
        ProductTag::where('product_id', $product_id)->delete();

        foreach ($input['product_tag'] as $data) {

            $tagRepository = new TagRepository(new Container());
            $tag = $tagRepository->find($data);

            $model = new ProductTag();
            $model->tag_id = $tag->id;
            $model->product_id = $product_id;
            $model->save();
        }
    }
}
