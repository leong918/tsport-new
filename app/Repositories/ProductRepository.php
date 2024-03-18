<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Container\Container;

class ProductRepository extends BaseRepository
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

    public function getProductByCurrencyCode(string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where('product_price.code', $currency_code)
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*,product_price.code, product_price.price');
    }

    public function getProductByAlias(string $alias, string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product.alias' => $alias, 'product_price.code' => $currency_code])
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*,product_price.code, product_price.price')
            ->with('category')
            ->first();
    }

    public function getProductByKeywords(string $keyword, string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product_price.code' => $currency_code, 'product_price.deleted_at' => null])
            ->where('product.name', 'LIKE', '%' . $keyword . '%')
            ->distinct('product.id')
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*,product_price.code, product_price.price')
            ->get();
    }

    public function getProductByTag(string $keyword, string $currency_code)
    {
        return Product::leftjoin('product_tag', 'product.id', '=', 'product_tag.product_id')
            ->leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->leftjoin('tag', 'tag.id', '=', 'product_tag.tag_id')
            ->where(['product_price.code' => $currency_code, 'product_price.deleted_at' => null])
            ->where('tag.name', 'LIKE', '%' . $keyword . '%')
            ->distinct('product.id')
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*, product_price.code, product_price.price')
            ->get();
    }

    public function getProductByTagOrKeywords(string $keyword, string $currency_code)
    {
        return Product::leftjoin('product_tag', 'product.id', '=', 'product_tag.product_id')
            ->leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->leftjoin('tag', 'tag.id', '=', 'product_tag.tag_id')
            ->where(['product_price.code' => $currency_code, 'product_price.deleted_at' => null])
            ->where(function ($query) use ($keyword) {
                $query->where('tag.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('product.name', 'LIKE', '%' . $keyword . '%');
            })
            ->distinct('product.id')
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*, product_price.code, product_price.price')
            ->get();
    }


    public function getProductByCategoryType(string $category_id, string $currency_code) //int $category_id = null
    {
        $query =  Product::leftjoin('category', 'product.category_id', '=', 'category.id')
            ->leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->whereNull('product_price.deleted_at')
            ->where(['category.id' => $category_id, 'product_price.code' => $currency_code]);

        return $query->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*, product_price.code, product_price.price')
            ->get();
    }

    public function getProductByBrand(int $brand_id, string $currency_code)
    {
        return Product::leftjoin('category', 'product.category_id', '=', 'category.id')
            ->leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->leftjoin('brand', 'product.brand_id', '=', 'brand.id')
            ->distinct('product.id')
            ->where(['brand.id' => $brand_id, 'product_price.code' => $currency_code, 'category.deleted_at' => null])
            ->orderBy('category.name', 'asc')
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*,product_price.code, product_price.price, category.name as category_name')
            ->get();
    }

    public function getBestSellingProduct(string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product_price.code' => $currency_code, 'product.is_best_seller' => 1])
            ->whereNull('product_price.deleted_at')
            ->selectRaw('product.*, product_price.code, product_price.price')
            ->get();
    }

    public function getNewProduct(string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product_price.code' => $currency_code, 'product.is_new' => 1])
            ->whereNull('product_price.deleted_at')
            ->selectRaw('product.*, product_price.code, product_price.price')
            ->get();
    }

    public function regroupProductListByCategory($product_list)
    {
        $regroup_product_list = array();
        foreach ($product_list as $product) {
            if (!array_key_exists($product->category_name, $regroup_product_list)) {
                $regroup_product_list[$product->category_name] = array($product);
            } else {
                array_push($regroup_product_list[$product->category_name], $product);
            }
        }
        return $regroup_product_list;
    }

    public function getCategoryByProductList($product_list)
    {
        $regroup_category_list = array();

        foreach ($product_list as $product) {
            $regroup_category_list[] = $product->category_id;
        }

        $regroup_category_list = array_values($regroup_category_list);

        $category_list = Category::whereIn('id', $regroup_category_list)->orderBy('category.name', 'asc')->get();

        return $category_list;
    }

    public function createProduct(array $input)
    {
        $this->verifyDescription($input);

        $input['alias'] = strtolower($input['alias']);
        $model = new Product();
        $model->fill($input);
        $model->save();

        if (isset($input['product_related'])) {
            $productRelatedRepository = new ProductRelatedRepository(new Container());
            $productRelatedRepository->createProductRelated($input, $model->id);
        }

        if (isset($input['product_tag'])) {
            $productTag = new ProductTagRepository(new Container());
            $productTag->createProductTag($input, $model->id);
        }

        if (isset($input['option'])) {
            $productAttribute = new ProductAttributeRepository(new Container());
            $productAttribute->createProductAttribute($input, $model->id);
        } else {
            $productBalanceLog = new ProductBalanceLogRepository(new Container());
            $productBalanceLog->createProductBalanceLog($model);
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
        $this->verifyDescription($input);

        $input['alias'] = strtolower($input['alias']);
        $model = Product::findOrFail($id);
        $model->fill($input);
        $model->save();

        if (isset($input['product_related'])) {
            $productRelatedRepository = new ProductRelatedRepository(new Container());
            $productRelatedRepository->createProductRelated($input, $model->id);
        }

        if (isset($input['image'])) {
            $productImageRepository = new ProductImageRepository(new Container());
            $productImageRepository->createProductImage($input, $model->id);
        }

        if (isset($input['product_tag'])) {
            $productTag = new ProductTagRepository(new Container());
            $productTag->createProductTag($input, $model->id);
        }

        if (isset($input['option'])) {
            $productAttribute = new ProductAttributeRepository(new Container());
            $productAttribute->createProductAttribute($input, $model->id);
        }

        $productPriceRepository = new ProductPriceRepository(new Container());
        $productPriceRepository->createProductPrice($input, $model->id);

        $productDescriptionRepository = new ProductDescriptionRepository(new Container());
        $productDescriptionRepository->createProductDescription($input, $model->id);

    }

    public function updateStock(array $input, int $id)
    {
        $model = Product::findOrFail($id);

        if ($input['type'] == 'ADD') {
            $total = $model->quantity + $input['quantity'];
        } else {
            $total = $model->quantity - $input['quantity'];
        }

        $model->quantity = $total;
        $model->save();

        $productBalanceLog = new ProductBalanceLogRepository(new Container());
        $productBalanceLog->createProductBalanceLog($model, null, $input);
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
                throw new \Exception(__('Name for ' . $lang . ' cannot be empty!'));
            }
            if (isset($language['information']) == false) {
                throw new \Exception(__('Information for ' . $lang . ' cannot be empty!'));
            }
            if (isset($language['description']) == false) {
                throw new \Exception(__('Description for ' . $lang . ' cannot be empty!'));
            }
            if (isset($language['ingredient']) == false) {
                throw new \Exception(__('Ingredient for ' . $lang . ' cannot be empty!'));
            }
            if (isset($language['usage']) == false) {
                throw new \Exception(__('Usage for ' . $lang . ' cannot be empty!'));
            }
            if (isset($language['additional_information']) == false) {
                throw new \Exception(__('Addtional Information for ' . $lang . ' cannot be empty!'));
            }
        }
    }
}
