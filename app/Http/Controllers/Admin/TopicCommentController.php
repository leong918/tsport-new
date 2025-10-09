<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\TopicCommentRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TopicCommentController extends BaseController
{
    private TopicCommentRepository $topicCommentRepository;


    public function __construct(TopicCommentRepository $topicCommentRepository)
    {
        $this->topicCommentRepository = $topicCommentRepository;
    }

    public function edit(Request $request, int $id)
    {
        $model = $this->topicCommentRepository->find($id);
        $label = 'Topic';
        $returnRoute = route('admin.topic.update', ['id' => $model->topic_id]);
        $updateRoute = route('admin.topic-comment.update.put', ['id' => $model->id]);
        return view('shared.comment-update', compact('model', 'label', 'updateRoute', 'returnRoute'));
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $res = $this->topicCommentRepository->updateTopic($data, $id);
            DB::commit();

            return redirect(route('admin.topic.update', ['id' => $res->topic_id]))
                ->with('success', 'Successfully updated topic comment');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        $this->topicCommentRepository->deleteTopic($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->topicCommentRepository->toggleStatus($id);
    }
}
