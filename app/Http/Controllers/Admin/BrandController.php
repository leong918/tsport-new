<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Brand\UpdateBrandRequest;
use App\Http\Requests\Form\Brand\CreateBrandRequest;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class BrandController extends BaseController
{
    private BrandRepository $brandRepository;
    private ProductRepository $productRepository;

    public function __construct(
        BrandRepository $brandRepository,
        ProductRepository $productRepository
    ) {
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->brandRepository->getListing();

            return DataTables::of($model)
                ->addColumn('logo', function ($model) {
                    $image = $model->logo;
                    return view('shared.image', compact('image'));
                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.brand.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('brand.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('brand.index');
    }

    public function create()
    {
        return $this->view('brand.create');
    }

    public function store(CreateBrandRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->brandRepository->createBrand($request->all());
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.brand.index'))->with('success', "Successfully create brand {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->brandRepository->find($id);

        return $this->view('brand.update', compact('model'));
    }

    public function update(UpdateBrandRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->brandRepository->updateBrand($request->all(), $id);
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.brand.index'))->with('success', "Successfully update brand {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->brandRepository->delete($id);
        $this->productRepository->deleteByBrandId($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->brandRepository->toggleStatus($id);
    }
}
