<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\TopicCommentRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TopicController extends BaseController
{
    private TopicRepository $topicRepository;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->topicRepository->getListing();

            return DataTables::of($model)
                ->addColumn('title', function ($model) {
                    return $model->title;
                })
                ->addColumn('comment', function ($model) {
                    return $model->comment->count();
                })
                ->addColumn('like', function ($model) {
                    return $model->like->count();
                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.topic.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('topic.action', compact('model'));
                })
                ->make(true);
        }
        return $this->view('topic.index');
    }

    public function create()
    {
        return $this->view('topic.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $this->topicRepository->createTopic($data);

            DB::commit();

            return redirect(route('admin.topic.index'))
                ->with('success', 'Successfully created topic');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request, int $id)
    {
        if ($request->ajax()) {
            $model = $this->topicRepository->find($id)->load('comment')->comment;
            return DataTables::of($model)
                ->addColumn('name', function ($model) {
                    return $model->user->name;
                })
                ->addColumn('comment', function ($model) {
                    return $model->comment;
                })
                ->addColumn('like', function ($model) {
                    $countLike = $model->like->count();
                    return $countLike;
                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.topic-comment.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    $editRoute = route('admin.topic-comment.update', ['id' => $model->id]);
                    $deleteRoute = route('admin.topic-comment.destroy.delete', ['id' => $model->id]);
                    return view('shared.comment-action', compact('model', 'editRoute', 'deleteRoute'));
                })
                ->make(true);
        }

        $model = $this->topicRepository->find($id);
        return $this->view('topic.update', compact('model'));
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $this->topicRepository->updateTopic($data, $id);

            DB::commit();

            return redirect(route('admin.topic.index'))
                ->with('success', 'Successfully updated blog');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        $this->topicRepository->deleteTopic($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->topicRepository->toggleStatus($id);
    }
}
