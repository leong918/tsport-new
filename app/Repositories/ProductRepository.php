<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Container\Container;

class ProductRepository extends BaseRepository
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
        return Product::class;
    }

    public function getListing()
    {
        return Product::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Product::all(), $key, 'name');
    }

    public function dropdownWithoutID(string $key = 'id', int $product_id)
    {
        return formalizeDropdown(Product::where('id', '!=', $product_id)->get(), $key, 'name');
    }

    public function createProduct(array $input)
    {
        $this->verifyDescription($input);
        $this->checkDuplicate($input);

        $input['alias'] = strtolower($input['alias']);
        $model = new Product();
        $model->fill($input);
        $model->save();
        
        if(isset($input['product_related'])){
            $productRelatedRepository = new ProductRelatedRepository(new Container());
            $productRelatedRepository->createProductRelated($input, $model->id);
        }

        $productPriceRepository = new ProductPriceRepository(new Container());
        $productPriceRepository->createProductPrice($input, $model->id);

        $productImageRepository = new ProductImageRepository(new Container());
        $productImageRepository->createProductImage($input, $model->id);

        $productDescriptionRepository = new ProductDescriptionRepository(new Container());
        $productDescriptionRepository->createProductDescription($input, $model->id);
    }

    public function updateProduct(array $input, int $id)
    {
        $this->checkDuplicate($input);
        
        $input['alias'] = strtolower($input['alias']);
        $model = Product::findOrFail($id);
        $model->fill($input);
        $model->save();

        if(isset($input['product_related'])){
            $productRelatedRepository = new ProductRelatedRepository(new Container());
            $productRelatedRepository->createProductRelated($input, $model->id);
        }

        if(isset($input['image'])){
            $productImageRepository = new ProductImageRepository(new Container());
            $productImageRepository->createProductImage($input, $model->id);
        }

        $productPriceRepository = new ProductPriceRepository(new Container());
        $productPriceRepository->createProductPrice($input, $model->id);
        
        $productDescriptionRepository = new ProductDescriptionRepository(new Container());
        $productDescriptionRepository->createProductDescription($input, $model->id);
    }

    public function toggleStatus(int $id)
    {
        $model = Product::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    private function verifyDescription($input)
    {
        foreach ($input['language'] as $key => $language) {
            $lang = ($key == 'cn' ? 'Chinese' : 'English');

            if (isset($language['name']) == false) {
                throw new \Exception(__('Name for '.$lang.' cannot be empty!'));
            }
            if (isset($language['information']) == false) {
                throw new \Exception(__('Information for '.$lang.' cannot be empty!'));
            }
            if (isset($language['description']) == false) {
                throw new \Exception(__('Description for '.$lang.' cannot be empty!'));
            }
            if (isset($language['ingredient']) == false) {
                throw new \Exception(__('Ingredient for '.$lang.' cannot be empty!'));
            }
            if (isset($language['usage']) == false) {
                throw new \Exception(__('Usage for '.$lang.' cannot be empty!'));
            }
            if (isset($language['additional_information']) == false) {
                throw new \Exception(__('Addtional Information for '.$lang.' cannot be empty!'));
            }
        }
    }

    public function removeSpecialCharacters(string $string){
        $string = preg_replace('/\s+/', '-', strtolower($string));
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    public function checkDuplicate($input) {
        $currencyIds = [];
        foreach ($input['product_price'] as $product) {
            $currencyIds[] = $product['currency_id'];
        }
        $valueCounts = array_count_values($currencyIds);
        $duplicates = array_filter($valueCounts, function($count) {
            return $count > 1;
        });
        
        if(count($duplicates) > 0){
            throw new \Exception(__('Product Price has duplicate currency'));
        }

    }
}
