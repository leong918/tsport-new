<?php

namespace App\Http\Controllers\Web;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\BrandRepository;
use App\Repositories\BlogRepository;
use App\Repositories\BlogCommentRepository;
use App\Repositories\UserRepository;
use App\Repositories\SliderRepository;
use App\Plugins\ProductReview\Repositories\ProductReviewRepository;
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
    private SettingRepository $settingRepository;
    private SliderRepository $sliderRepository;
    private ProductReviewRepository $productReviewRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        BrandRepository $brandRepository,
        BlogRepository $blogRepository,
        BlogCommentRepository $blogCommentRepository,
        UserRepository $userRepository,
        SettingRepository $settingRepository,
        SliderRepository $sliderRepository,
        ProductReviewRepository $productReviewRepository,
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->blogRepository = $blogRepository;
        $this->blogCommentRepository = $blogCommentRepository;
        $this->userRepository = $userRepository;
        $this->settingRepository = $settingRepository;
        $this->sliderRepository = $sliderRepository;
        $this->productReviewRepository = $productReviewRepository;
    }

    public function index()
    {
        $slider_list = $this->sliderRepository->getListing()->get();
        $setting_list = $this->settingRepository->getListing()->get();
        $blog_list = $this->blogRepository->getListing()->get();
        $brand_list = $this->brandRepository->getListing()->where('status', 1)->get();
        $more_discover_category_list = $this->categoryRepository->getMoreToDiscoverListing();

        return $this->view('index', compact('slider_list', 'setting_list', 'blog_list', 'brand_list', 'more_discover_category_list'));
    }

    public function product(Request $request, string $category_id = null)
    {
        $product_list = $this->productRepository->getProductByCurrencyCode('HKD')->get();
        $category_list = $this->categoryRepository->getListingForNav();
        $brand_list = $this->brandRepository->getListingForNav();
        $current_category = null;
        $search_keyword = null;
        $parent_category = null;

        //product page with filtering
        if ($request->ajax()) {
            if ($category_id) {
                $product_list = $this->productRepository->getProductByCategoryType($category_id, 'HKD');
            }
        }

        //product page without filtering 
        if ($category_id) {
            $current_category = $this->categoryRepository->find($category_id);
            $category_list = $this->categoryRepository->getSubCategoryByCategoryId($current_category->id);
            $parent_category = $this->categoryRepository->find($current_category->parent_category_id);

            $product_list = $this->productRepository->getProductByCategoryType($category_id, 'HKD');
        }

        //search page
        if ($request->input('search_keyword')) {
            $search_keyword = $request->input('search_keyword');

            $product_list = $this->productRepository->getProductByTagOrKeywords($search_keyword, 'HKD');
        }

        return $this->view('product', compact('product_list', 'category_list', 'brand_list', 'search_keyword', 'current_category', 'parent_category'));
    }

    public function productDetail(string $alias)
    {
        $product = $this->productRepository->getProductByAlias($alias, 'HKD');
        $product_category = $this->categoryRepository->find($product->category_id);
        $product_parent_category = $this->categoryRepository->find($product_category->parent_category_id);
        $review_record = $this->productReviewRepository->getReviewByProductId($product->id);
        $avgRating = $this->productReviewRepository->getAvgProductRating($product->id);
        $review_total = $review_record->count();
        $review_list = $review_record->paginate(6);

        return $this->view('product_detail', compact('product', 'product_parent_category', 'review_total', 'review_list', 'avgRating'));
    }

    public function productNew()
    {
        $product_list = $this->productRepository->getNewProduct('HKD');
        return $this->view('product_new', compact('product_list'));
    }

    public function bestSeller()
    {
        $product_list = $this->productRepository->getBestSellingProduct('HKD');
        return $this->view('best_seller', compact('product_list'));
    }

    public function brand(int $brand_id)
    {
        $brand = $this->brandRepository->find($brand_id);
        $retrieve_product_list = $this->productRepository->getProductByBrand($brand_id, 'HKD');
        $product_list = $this->productRepository->regroupProductListByCategory($retrieve_product_list);
        $category_list = $this->productRepository->getCategoryByProductList($retrieve_product_list);

        return $this->view('brand', compact('brand', 'category_list', 'product_list'));
    }

    public function blog()
    {
        $blog_list = $this->blogRepository->getActiveListing();
        return $this->view('blog', compact('blog_list'));
    }

    public function blogDetail(int $blog_id)
    {
        $blog = $this->blogRepository->find($blog_id);
        $product_list = $this->productRepository->getProductByCurrencyCode('HKD')->take(2)->get();
        $blog_list = $this->blogRepository->makeModel()->where('id', '!=', $blog_id)->orderBy('created_at', 'desc')->take(3)->get();
        return $this->view('blog_detail', compact('blog', 'product_list', 'blog_list'));
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
            return redirect(route('web.blog_detail', ['blog_id' => $request->blog_id]))->with('success', "Blog Comment Posted");
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
