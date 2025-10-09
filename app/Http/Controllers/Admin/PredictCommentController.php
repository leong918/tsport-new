<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PredictCommentRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PredictCommentController extends BaseController
{
    private PredictCommentRepository $predictCommentRepository;


    public function __construct(PredictCommentRepository $predictCommentRepository)
    {
        $this->predictCommentRepository = $predictCommentRepository;
    }

    public function edit(Request $request, int $id)
    {
        $model = $this->predictCommentRepository->find($id);
        $label = 'Predict';
        $returnRoute = route('admin.predict.update', ['id' => $model->predict_id]);
        $updateRoute = route('admin.predict-comment.update.put', ['id' => $id]);
        return view('shared.comment-update', compact('model', 'label', 'updateRoute', 'returnRoute'));
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();

            $res = $this->predictCommentRepository->updateTopic($data, $id);
            DB::commit();

            return redirect(route('admin.predict.update', ['id' => $res->predict_id]))
                ->with('success', 'Successfully updated predict comment');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        $this->predictCommentRepository->deleteTopic($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->predictCommentRepository->toggleStatus($id);
    }
}
