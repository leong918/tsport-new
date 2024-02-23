<?php

namespace App\Http\Controllers\Web;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\BrandRepository;
use App\Models\Category;
use App\Repositories\BlogRepository;
use Carbon\Carbon;

class AppController extends BaseController
{
    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;
    private BrandRepository $brandRepository;
    private BlogRepository $blogRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository, BrandRepository $brandRepository, BlogRepository $blogRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        return $this->view('index');
    }
    public function product(string $category_type)
    {
        //to get category name
        $flipped_array = array_flip(Category::TYPE);
        $category_type_name = strtolower($flipped_array[$category_type]);
    
        $category_list = $this->categoryRepository->getListingByCategoryType($category_type);
        $brand_list = $this->brandRepository->getListing()->get();                                                       
        $product_list = $this->productRepository->getProductByCategoryType($category_type,'indr');

        return $this->view('product',compact('category_type','category_type_name','category_list','brand_list','product_list'));
    }

    public function filterProduct(string $category_type, int $category_id){
        $product_list = $this->productRepository->getProductByCategoryType($category_type,'indr',$category_id);
        return $this->view('product_list',compact('product_list'));
    }

    public function productDetail()
    {
        return $this->view('product_detail');
    }
    public function productNew()
    {
        $product_list = $this->productRepository->getNewProduct('indr');
        return $this->view('product_new',compact('product_list'));
    }
    public function bestSeller()
    {
        $product_list = $this->productRepository->getBestSellingProduct('indr');
        return $this->view('best_seller',compact('product_list'));
    }
    public function brand(int $brand_id)
    {
        $brand = $this->brandRepository->find($brand_id);
        $category_list = $this->categoryRepository->getListing()->get();
        $retrieve_product_list = $this->productRepository->getProductByBrand($brand_id);
        $product_list = $this->productRepository->regroupProductListByCategory($retrieve_product_list);
        return $this->view('brand',compact('brand','category_list','product_list'));
    }
    public function blog()
    {
        $blog_list = $this->blogRepository->getListing()->get();
        foreach ($blog_list as $blog) {
            $blog->published_at = Carbon::parse($blog->published_at)->format('M j, Y');
        }

        return $this->view('blog', compact('blog_list'));
    }
    public function blogDetail()
    {
        return $this->view('blog_detail');
    }
    public function voucher()
    {
        return $this->view('voucher');
    }
    public function howTo()
    {
        return $this->view('how_to');
    }
    public function search()
    {
        return $this->view('search_result');
    }
}
