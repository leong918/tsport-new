<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends BaseController
{
    private BlogRepository $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->blogRepository->getListing();

            return DataTables::of($model)
                ->addColumn('title', function ($model) {
                    return $model->translate('en')->title;
                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.blog.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('blog.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('blog.index');
    }

    public function create()
    {
        return $this->view('blog.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $this->blogRepository->createBlog($data);

            DB::commit();

            return redirect(route('admin.blog.index'))
                ->with('success', 'Successfully created blog');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(int $id)
    {
        $model = $this->blogRepository->find($id);

        return $this->view('blog.update', compact('model'));
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $this->blogRepository->updateBlog($data, $id);

            DB::commit();

            return redirect(route('admin.blog.index'))
                ->with('success', 'Successfully updated blog');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        $this->blogRepository->deleteBlog($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->blogRepository->toggleStatus($id);
    }
}
