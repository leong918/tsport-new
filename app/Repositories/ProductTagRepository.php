<?php

namespace App\Repositories;

// use App\Models\Product;
use App\Models\ProductTag;
use App\Traits\FileUpload;
use Illuminate\Container\Container;

class ProductTagRepository extends BaseRepository
{
    use FileUpload;

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

        foreach($input['product_tag'] as $data){

            $tagRepository = new TagRepository(new Container());
            $tag = $tagRepository->find($data);

            $model = new ProductTag();
            $model->tag_id = $tag->id;
            $model->product_id = $product_id;
            $model->save();
        }
        
    }

    // public function updateProductTag(array $input, int $id)
    // {
    //     $model = ProductTag::findOrFail($id);
    //     $model->fill($input);

    //     if(isset($input['image'])){
    //         //image
    //         $this->upload_path = 'ProductTag';
    //         $this->uploadFile($input['image']);  
    //         $model->image = $this->uploaded_filename;
    //     }

    //     $model->save();

    //     $ProductTagDescriptionRepository = new ProductTagDescriptionRepository(new Container());
    //     $ProductTagDescriptionRepository->createProductTagDescription($input, $model->id);
    // }

    // public function toggleStatus(int $id)
    // {
    //     $model = ProductTag::find($id);
    //     $model->status = !$model->status;
    //     $model->save();
    // }

    // private function verifyDescription($input)
    // {
    //     foreach ($input['language'] as $key => $language) {
    //         $lang = ($key == 'cn' ? 'Chinese' : 'English');

    //         if (isset($language['name']) == false) {
    //             throw new \Exception(__('Name for '.$lang.' cannot be empty!'));
    //         }
    //         if (isset($language['description']) == false) {
    //             throw new \Exception(__('Description for '.$lang.' cannot be empty!'));
    //         }
    //     }
    // }

    // public function getProductByTag(string $keyword, string $currency_code)
    // {
    //     return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
    //         ->leftjoin('tag_id')
    //         ->where('product_price.code', $currency_code)
    //         ->where('product.name', 'LIKE', '%' . $keyword . '%')
    //         ->distinct('product.id')
    //         ->orderBy('product.created_at', 'desc')
    //         ->selectRaw('product.*,product_price.code, product_price.price')
    //         ->get();

    //     $query = Product::leftjoin('product_id', 'product.id', '=', 'product_tag.product_id')
    //             ->leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
    //             ->leftjoin('tag_id', 'tag.id', '=', 'product_tag.tag_id')
    //             ->where('product_price.code', $currency_code)
    //             ->where('tag.name', 'LIKE', '%' . $keyword . '%')
    //             ->distinct('product.id')
    //             ->orderBy('product.created_at', 'desc')
    //             ->selectRaw('product.*, product_price.code, product_price.price')
    //             ->get();

    //     dd($query);
    // }
}
