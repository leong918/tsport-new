<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Product\UpdateProductRequest;
use App\Http\Requests\Form\Product\CreateProductRequest;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;
    private BrandRepository $brandRepository;
    private CurrencyRepository $currencyRepository;
    private TagRepository $tagRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository, BrandRepository $brandRepository, CurrencyRepository $currencyRepository, TagRepository $tagRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->currencyRepository = $currencyRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->productRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.product.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('product.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('product.index');
    }

    public function create()
    {
        $categoryDropdown = $this->categoryRepository->dropdown();
        $brandDropdown = $this->brandRepository->dropdown();
        $productDropdown = $this->productRepository->dropdown();
        $currencyDropdown = $this->currencyRepository->dropdown();
        $tagDropdown = $this->tagRepository->dropdown(); 

        return $this->view('product.create', compact('categoryDropdown', 'brandDropdown','productDropdown','currencyDropdown', 'tagDropdown'));
    }

    public function store(CreateProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->productRepository->createProduct($request->all());
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.product.index'))->with('success', "Successfully create product {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->productRepository->find($id);
        $categoryDropdown = $this->categoryRepository->dropdown();
        $brandDropdown = $this->brandRepository->dropdown();
        $productDropdown = $this->productRepository->dropdownWithoutID('id',$id);
        $currencyDropdown = $this->currencyRepository->dropdown();
        $tagDropdown = $this->tagRepository->dropdown(); 

        return $this->view('product.update', compact('model', 'categoryDropdown', 'brandDropdown','productDropdown', 'currencyDropdown', 'tagDropdown'));
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->productRepository->updateProduct($request->all(), $id);
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.product.index'))->with('success', "Successfully update product {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->productRepository->delete($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->productRepository->toggleStatus($id);
    }
}
