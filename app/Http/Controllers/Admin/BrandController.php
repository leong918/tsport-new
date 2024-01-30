<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Brand\UpdateBrandRequest;
use App\Http\Requests\Form\Brand\CreateBrandRequest;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends BaseController
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->brandRepository->getListing();

            return DataTables::of($model)
                ->addColumn('image', function ($model) {
                    $image = $model->image;
                    return view('shared.image', compact('image'));
                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.brand.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return $this->view('brand.status', compact('route', 'status', 'model'));
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
        $this->brandRepository->createBrand($request->all());
        return redirect(route('admin.brand.index'))->with('success', "Successfully create brand {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->brandRepository->find($id);

        return $this->view('brand.update', compact('model'));
    }

    public function update(UpdateBrandRequest $request, int $id)
    {
        $this->brandRepository->updateBrand($request->all(), $id);
        return redirect(route('admin.brand.index'))->with('success', "Successfully update brand {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->brandRepository->delete($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        // $this->authorizeForUser(Auth::guard('admin')->user(), 'self-deny', $id);
        $this->brandRepository->toggleStatus($id);
    }
}
