<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Blog\CreateBlogRequest;
use App\Http\Requests\Form\Blog\UpdateBlogRequest;
use App\Repositories\BlogCommentRepository;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogController extends BaseController
{
    private BlogRepository $blogRepository;
    private BlogCommentRepository $blogCommentRepository;
    private BlogCategoryRepository $blogCategoryRepository;

    public function __construct(BlogRepository $blogRepository, BlogCommentRepository $blogCommentRepository, BlogCategoryRepository $blogCategoryRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->blogCommentRepository = $blogCommentRepository;
        $this->blogCategoryRepository = $blogCategoryRepository;
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
        $blogCategoryDropdown = $this->blogCategoryRepository->all();
        return $this->view('blog.create', compact('blogCategoryDropdown'));
    }

    public function store(CreateBlogRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->blogRepository->createBlog($request->all());
            DB::commit();
            return redirect(route('admin.blog.index'))->with('success', "Successfully create blog {$request->name}");
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(int $id)
    {
        $model = $this->blogRepository->find($id);
        $blogCategoryDropdown = $this->blogCategoryRepository->all();
        $model->published_at = $model->published_at ? Carbon::parse($model->published_at)->format('Y-m-d g:i A') : null;
        return $this->view('blog.update', compact('model','blogCategoryDropdown'));
    }

    public function update(UpdateBlogRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->blogRepository->updateBlog($request->all(), $id);
            DB::commit();
            return redirect(route('admin.blog.index'))->with('success', "Successfully update blog {$request->name}");
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
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
            if ($id) {
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
