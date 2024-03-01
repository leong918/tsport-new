<?php

namespace App\Http\Controllers\Web;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\BrandRepository;
use App\Repositories\BlogRepository;
use App\Repositories\BlogCommentRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use App\Http\Requests\Form\BlogComment\CreateBlogCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AppController extends BaseController
{
    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;
    private BrandRepository $brandRepository;
    private BlogRepository $blogRepository;
    private BlogCommentRepository $blogCommentRepository;
    private UserRepository $userRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository, BrandRepository $brandRepository, BlogRepository $blogRepository, BlogCommentRepository $blogCommentRepository,UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->blogRepository = $blogRepository;
        $this->blogCommentRepository = $blogCommentRepository;
        $this->userRepository = $userRepository;
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
            $category_list = $this->categoryRepository->getListingByCategoryType($category_type,'name')->get();
            $brand_list = $this->brandRepository->getListing()->get();                                                       
            $product_list = $this->productRepository->getProductByCategoryType($category_type,'MYR');

            return $this->view('product',compact('category_type','category_list','brand_list','product_list'));
        }

        //search page
        if($request->input('search_keyword')){
            $search_keyword = $request->input('search_keyword');
            $product_list = $this->productRepository->getProductByKeywords($search_keyword,'MYR');
            return $this->view('product',compact('product_list','search_keyword'));
        }
    }


    public function productDetail(string $alias)
    {
        $product = $this->productRepository->getProductByAlias($alias, 'MYR');
        return $this->view('product_detail', compact('product'));
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
        return $this->view('blog', compact('blog_list'));
    }
    public function blogDetail(int $blog_id)
    {
        $blog = $this->blogRepository->find($blog_id);
        $product_list = $this->productRepository->getProductByCurrencyCode('myr')->take(2)->get();
        $blog_list = $this->blogRepository->makeModel()->where('id','!=',$blog_id)->orderBy('created_at','desc')->take(3)->get();
        return $this->view('blog_detail', compact('blog','product_list','blog_list'));
    }

    public function createBlogComment(CreateBlogCommentRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->find(auth()->user()->id);
            $data = $request->all();
            $data['user_id'] = $user->id;
            $data['username'] = $user->username;
            $this->blogCommentRepository->createBlogComment($data);
            DB::commit();
            return redirect(route('web.blog_detail',['blog_id' => $request->blog_id]))->with('success', "Blog Comment Posted");
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
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
