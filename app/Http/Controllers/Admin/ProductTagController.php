<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\ProductTag\UpdateProductTagRequest;
use App\Http\Requests\Form\ProductTag\CreateProductTagRequest;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTagRepository;
use App\Repositories\TagRepository;
use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProductTagController extends BaseController
{
    private ProductTagRepository $productTagRepository;
    private ProductRepository $productRepository;
    private TagRepository $tagRepository;

    public function __construct(ProductRepository $productRepository, ProductTagRepository $productTagRepository, TagRepository $tagRepository)
    {
        $this->productRepository = $productRepository;
        $this->productTagRepository = $productTagRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->productTagRepository->getListing();

            // dd();
            // $model2 = $model->get();
            
            // $productName = null; 

            // foreach ($model2 as $key) {
            //     $product_id = $key->product_id;

            //     $productName = Product::where('id', $product_id)->pluck('name');
            // }

            // dd($productName);
            

            // dd($productName);

            return DataTables::of($model)
                // ->addColumn('tag_id', function ($model) {
                    
                //     $productName = Product::where('id', $model->product_id)->pluck('name');



                //     return $this->view('product_tag.action', compact('model', 'productName'));
                // })
                ->addColumn('action', function ($model) {
                    return $this->view('product_tag.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('product_tag.index');
    }

    public function create()
    {
        $productDropdown = $this->productRepository->dropdown();
        $tagDropdown = $this->tagRepository->dropdown();

        return $this->view('product_tag.create', compact('productDropdown', 'tagDropdown'));
    }

    public function store(CreateProductTagRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->productTagRepository->createProductTag($request->all());
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.product_tag.index'))->with('success', "Successfully create product tag {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->productTagRepository->find($id);
        
        return $this->view('product_tag.update', compact('model'));
    }

    public function update(UpdateProductTagRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->productTagRepository->updateProductTag($request->all(), $id);
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.product_tag.index'))->with('success', "Successfully update product tag {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->productTagRepository->delete($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->productTagRepository->toggleStatus($id);
    }
}
