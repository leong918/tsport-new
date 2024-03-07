<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Category\UpdateCategoryRequest;
use App\Http\Requests\Form\Category\CreateCategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\CategoryDescription;

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
                        $parentCategory = Category::find($model->parent_category_id);

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
        $categoryNames = Category::whereNull('parent_category_id')->pluck('name')->toArray();
        $categoryIds = Category::whereNull('parent_category_id')->pluck('id')->toArray();

        return $this->view('category.create', compact('categoryNames', 'categoryIds'));
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

        if ($model->parent_category_id) {
            $categoryNames = Category::whereNull('parent_category_id')->where('id', '!=', $model->parent_category_id)->pluck('name')->toArray();
            $categoryIds = Category::whereNull('parent_category_id')->where('id', '!=', $model->parent_category_id)->pluck('id')->toArray();
            $currentParentCategory = Category::where('id', $model->parent_category_id)->pluck('name', 'id')->toArray();

        } else {
            $categoryNames = Category::whereNull('parent_category_id')->pluck('name')->toArray();
            $categoryIds = Category::whereNull('parent_category_id')->pluck('id')->toArray();
            $currentParentCategory = '';
        }

        $enCategoryDescription = CategoryDescription::where(['category_id' => $id, 'language' => 'en'])->first();
        $cnCategoryDescription = CategoryDescription::where(['category_id' => $id, 'language' => 'cn'])->first();

        return $this->view('category.update', compact('model', 'categoryNames', 'categoryIds', 'currentParentCategory', 'enCategoryDescription', 'cnCategoryDescription'));
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
        Category::where('id' , $id)->orWhere('parent_category_id' , $id)->delete();

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->categoryRepository->toggleStatus($id);
    }
}
