<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Blog\CreateBlogRequest;
use App\Http\Requests\Form\Blog\UpdateBlogRequest;
use App\Repositories\BlogCommentRepository;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class BlogController extends BaseController
{
    private BlogRepository $blogRepository;
    private BlogCommentRepository $blogCommentRepository;


    public function __construct(BlogRepository $blogRepository, BlogCommentRepository $blogCommentRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->blogCommentRepository = $blogCommentRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->blogRepository->getListing();

            return DataTables::of($model)
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

    public function store(CreateBlogRequest $request)
    {
        $this->blogRepository->createBlog($request->all());
        return redirect(route('admin.blog.index'))->with('success', "Successfully create blog {$request->name}");
    }

    public function edit(int $id)
    {
        $model = $this->blogRepository->find($id);
        return $this->view('blog.update', compact('model'));
    }

    public function update(UpdateBlogRequest $request, int $id)
    {
        $this->blogRepository->updateBlog($request->all(), $id);
        return redirect(route('admin.blog.index'))->with('success', "Successfully update blog {$request->name}");
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

    public function getBlogComment(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            // dd($id);
            if($id){
                $model = $this->blogCommentRepository->getBlogComment($id);

                return DataTables::of($model)
                    ->addColumn('status', function ($model) {
                        $route = route('admin.blog.status.post', ['id' => $model->id]);
                        $status = $model->status;
                        return view('shared.status', compact('route', 'status', 'model'));
                    })
                    ->make(true);
            }

        }
    }
}
