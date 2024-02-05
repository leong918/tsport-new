<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Blog\CreateBlogRequest;
use App\Http\Requests\Form\Blog\UpdateBlogRequest;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

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
                ->addColumn('status', function ($model) {
                    $route = route('admin.currency.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('currency.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('currency.index');
    }

    public function create()
    {
        return $this->view('currency.create');
    }

    public function store(CreateBlogRequest $request)
    {
        $this->blogRepository->createBlog($request->all());
        return redirect(route('admin.currency.index'))->with('success', "Successfully create currency {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->blogRepository->find($id);

        return $this->view('currency.update', compact('model'));
    }

    public function update(UpdateBlogRequest $request, int $id)
    {
        $this->blogRepository->updateBlog($request->all(), $id);
        return redirect(route('admin.currency.index'))->with('success', "Successfully update currency {$request->name}");
    }

    public function destroy(int $id)
    {
        $this->blogRepository->delete($id);
        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->blogRepository->toggleStatus($id);
    }
}
