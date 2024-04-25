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

    public function dropdownForSalesOrder(string $code)
    {
        $productListDropdown = Product::orderBy('created_at', 'desc')->get()->map(function ($product) use ($code) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->getCurrencyParameters($code)->price,
            ];
        });

        return $productListDropdown;
    }

    public function getProductByCurrencyCode(string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product.status' => 1, 'product_price.deleted_at' => null, 'product_price.product_attribute_term_id' => null])
            ->where('product_price.code', $currency_code)
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*,product_price.code, product_price.price');
    }

    public function getProductByAlias(string $alias, string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product.status' => 1, 'product_price.deleted_at' => null])
            ->where(['product.alias' => $alias, 'product_price.code' => $currency_code, 'product_price.product_attribute_term_id' => null])
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*,product_price.code, product_price.price')
            ->with('category')
            ->first();
    }

    public function getProductByKeywords(string $keyword, string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product.status' => 1, 'product_price.deleted_at' => null, 'product_price.product_attribute_term_id' => null])
            ->where(['product_price.code' => $currency_code])
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
            ->where(['product.status' => 1, 'product_price.deleted_at' => null, 'product_price.product_attribute_term_id' => null])
            ->where(['product_price.code' => $currency_code])
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
            ->where(['product.status' => 1, 'tag.status' => 1, 'product_price.deleted_at' => null, 'product_price.product_attribute_term_id' => null])
            ->where(['product_price.code' => $currency_code])
            ->where(function ($query) use ($keyword) {
                $query->where('tag.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('product.name', 'LIKE', '%' . $keyword . '%');
            })
            ->distinct('product.id')
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*, product_price.code, product_price.price')
            ->get();
    }


    public function getProductByCategoryType(string $category_id, string $currency_code)
    {
        $query =  Product::leftjoin('category', 'product.category_id', '=', 'category.id')
            ->leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product.status' => 1, 'product_price.deleted_at' => null])
            ->whereNull('product_price.deleted_at')
            ->where(['category.id' => $category_id, 'product_price.code' => $currency_code, 'product_price.product_attribute_term_id' => null]);

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
            ->where(['product.status' => 1, 'product_price.deleted_at' => null])
            ->where([
                'brand.id' => $brand_id, 'product_price.code' => $currency_code,
                'category.deleted_at' => null, 'product_price.product_attribute_term_id' => null
            ])
            ->orderBy('category.name', 'asc')
            ->orderBy('product.created_at', 'desc')
            ->selectRaw('product.*,product_price.code, product_price.price, category.name as category_name')
            ->get();
    }

    public function getBestSellingProduct(string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product_price.code' => $currency_code, 'product.is_best_seller' => 1])
            ->where(['product.status' => 1, 'product_price.deleted_at' => null, 'product_price.product_attribute_term_id' => null])
            ->selectRaw('product.*, product_price.code, product_price.price')
            ->get();
    }

    public function getNewProduct(string $currency_code)
    {
        return Product::leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
            ->where(['product_price.code' => $currency_code, 'product.is_new' => 1])
            ->where(['product.status' => 1, 'product_price.deleted_at' => null, 'product_price.product_attribute_term_id' => null])
            ->selectRaw('product.*, product_price.code, product_price.price')
            ->get();
    }

    public function getLowStockProduct()
    {
        return Product::where('is_attribute', 0)->where('quantity', '<=', 2)->get();
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

    public function getProductAttribute(int $product_id)
    {
        return Product::leftjoin('product_attribute', 'product.id', '=', 'product_attribute.product_id')
            ->leftjoin('product_attribute_term', 'product_attribute.id', '=', 'product_attribute_term.product_attribute_id')
            ->leftjoin('product_price', 'product_attribute_term.id', '=', 'product_price.product_attribute_term_id')
            ->where('product.id', $product_id)
            ->selectRaw('product_attribute.name as attribute_name, product_attribute.id as product_attribute_id, product_attribute_term.id, product_attribute_term.name,product_price.code,product_price.price')
            ->get();
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

        if ($model->is_attribute && isset($input['option'])) {
            $productAttribute = new ProductAttributeRepository(new Container());
            $productAttribute->createProductAttribute($input, $model->id);
        }

        $productPriceRepository = new ProductPriceRepository(new Container());
        $productPriceRepository->createProductPrice($input, $model->id);

        $productImageRepository = new ProductImageRepository(new Container());
        $productImageRepository->createProductImage($input, $model->id);

        $productDescriptionRepository = new ProductDescriptionRepository(new Container());
        $productDescriptionRepository->createProductDescription($input, $model->id);

        if (!$model->is_attribute && $model->quantity > 0) {
            $remark = 'Create new product';
            $stockInput['quantity'] = $model->quantity;
            $stockInput['type'] = 'IN';

            $productBalanceLog = new ProductBalanceLogRepository(new Container());
            $productBalanceLog->createProductBalanceLog($model, $stockInput, $remark);
        }
    }

    public function updateProduct(array $input, int $id)
    {
        $this->verifyDescription($input);

        $input['alias'] = strtolower($input['alias']);
        $model = Product::findOrFail($id);
        $original_quantity = $model->quantity;

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

        if ($model->is_attribute && isset($input['option'])) {
            $productAttribute = new ProductAttributeRepository(new Container());
            $productAttribute->updateProductAttribute($input, $model->id);
        } else {
            $productAttribute = new ProductAttributeRepository(new Container());
            $productAttribute->deleteAllAttribute($model->id);
        }

        $productPriceRepository = new ProductPriceRepository(new Container());
        $productPriceRepository->createProductPrice($input, $model->id);

        $productDescriptionRepository = new ProductDescriptionRepository(new Container());
        $productDescriptionRepository->createProductDescription($input, $model->id);

        if (!$model->is_attribute && $model->quantity != $original_quantity) {
            $remark = 'Update product';
            $quantity_diff = $model->quantity - $original_quantity;
            $stockInput['quantity'] = abs($quantity_diff);
            $stockInput['type'] = $quantity_diff < 0 ? 'OUT' : 'IN';

            $productBalanceLog = new ProductBalanceLogRepository(new Container());
            $productBalanceLog->createProductBalanceLog($model, $stockInput, $remark);
        }
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
            if (isset($language['information']) == false) {
                throw new \Exception(__('Information cannot be empty!'));
            }
            if (isset($language['description']) == false) {
                throw new \Exception(__('Description cannot be empty!'));
            }
            if (isset($language['ingredient']) == false) {
                throw new \Exception(__('Ingredient cannot be empty!'));
            }
            if (isset($language['usage']) == false) {
                throw new \Exception(__('Usage cannot be empty!'));
            }
        }
    }

    public function calculatePointEarned($user, $user_cart)
    {
        $point = 0;

        if ($user->level->can_earn_point == 1) {
            foreach ($user_cart as $cart) {
                $product = Product::find($cart->product_id);
                $product_point = $product->point_value;

                if ($cart->product_attribute_term) {
                    foreach (json_decode($cart->product_attribute_term) as $product_attribute_term_id) {
                        $productAttributeTermRepository = new ProductAttributeTermRepository(new Container());
                        $product_attribute_term = $productAttributeTermRepository->find($product_attribute_term_id);
                        $product_point += $product_attribute_term->point_value;
                    }
                }

                $point += $product_point * $cart->quantity;
            }
        }

        return $point;
    }

    public function deleteByBrandId($brand_id)
    {
        Product::where('brand_id', $brand_id)->delete();
    }

    public function deleteByCategoryId($category_id)
    {
        Product::where('category_id', $category_id)->delete();
    }
}
