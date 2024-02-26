<?php

namespace App\Http\Controllers\Web;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\BrandRepository;
use App\Models\Category;
use App\Repositories\BlogRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function product(Request $request, string $category_type = null)
    {  
        //product page with filtering
        if($request->ajax()){
            if($request->category_id && $category_type){
                $product_list = $this->productRepository->getProductByCategoryType($category_type,'MYR',$request->category_id);
                return $this->view('product_list',compact('product_list'));
            }
        }

        //product page without filtering 
        if($category_type){
            $flipped_array = array_flip(Category::TYPE);
            $category_type_name = strtolower($flipped_array[$category_type]);
        
            $category_list = $this->categoryRepository->getListingByCategoryType($category_type,'name')->get();
            $brand_list = $this->brandRepository->getListing()->get();                                                       
            $product_list = $this->productRepository->getProductByCategoryType($category_type,'MYR');

            return $this->view('product',compact('category_type','category_type_name','category_list','brand_list','product_list'));
        }

        //search page
        if($request->input('search_keyword')){
            $search_keyword = $request->input('search_keyword');
            $product_list = $this->productRepository->getProductByKeywords($search_keyword,'MYR');
            return $this->view('product',compact('product_list','search_keyword'));
        }
    }


    public function productDetail()
    {
        return $this->view('product_detail');
    }
    public function productNew()
    {
        $product_list = $this->productRepository->getNewProduct('MYR');
        return $this->view('product_new',compact('product_list'));
    }
    public function bestSeller()
    {
        $product_list = $this->productRepository->getBestSellingProduct('MYR');
        return $this->view('best_seller',compact('product_list'));
    }
    public function brand(int $brand_id)
    {
        $brand = $this->brandRepository->find($brand_id);
        $category_list = $this->categoryRepository->getListingByCategoryType(null,'name')->get();
        $retrieve_product_list = $this->productRepository->getProductByBrand($brand_id,'myr');
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
