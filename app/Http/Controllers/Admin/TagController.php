<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Tag\UpdateTagRequest;
use App\Http\Requests\Form\Tag\CreateTagRequest;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class TagController extends BaseController
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->tagRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.tag.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('tag.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('tag.index');
    }

    public function create()
    {
        // $categoryDropdown = $this->categoryRepository->dropdown();
        // $brandDropdown = $this->brandRepository->dropdown();
        // $productDropdown = $this->productRepository->dropdown();
        // $currencyDropdown = $this->currencyRepository->dropdown(); , compact('categoryDropdown', 'brandDropdown','productDropdown','currencyDropdown')

        return $this->view('tag.create');
    }

    public function store(CreateTagRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->tagRepository->createTag($request->all());
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.tag.index'))->with('success', "Successfully create tag {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->tagRepository->find($id);
        
        return $this->view('tag.update', compact('model'));
    }

    public function update(UpdateTagRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->tagRepository->updateTag($request->all(), $id);
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.tag.index'))->with('success', "Successfully update tag {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->tagRepository->delete($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->tagRepository->toggleStatus($id);
    }
}
