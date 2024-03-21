<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Category\UpdateCategoryRequest;
use App\Http\Requests\Form\Category\CreateCategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->categoryRepository->getListing();

            return DataTables::of($model)
                ->addColumn('image', function ($model) {
                    $image = $model->image;
                    return view('shared.image', compact('image'));
                })
                ->addColumn('parent_category_name', function ($model) {

                    if($model->parent_category_id){
                        $parentCategory = $this->categoryRepository->find($model->parent_category_id);

                        return $parentCategory->name ;
                    } else {
                        return '-';
                    }

                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.category.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('category.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('category.index');
    }

    public function create()
    {
        $categoryDropdown = $this->categoryRepository->dropdown();

        return $this->view('category.create', compact('categoryDropdown'));
    }

    public function store(CreateCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->categoryRepository->createCategory($request->all());
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.category.index'))->with('success', "Successfully create category {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->categoryRepository->find($id);

        $categoryDropdown = $this->categoryRepository->dropdown();

        if (array_key_exists($id, $categoryDropdown)) {
            unset($categoryDropdown[$id]);
        }

        return $this->view('category.update', compact('model', 'categoryDropdown'));
    }

    public function update(UpdateCategoryRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->categoryRepository->updateCategory($request->all(), $id);
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.category.index'))->with('success', "Successfully update category {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->categoryRepository->delete($id);
        $this->categoryRepository->deleteChildCategory($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->categoryRepository->toggleStatus($id);
    }
}
