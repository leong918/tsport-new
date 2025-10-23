<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\MatchRepository;
use App\Repositories\PredictRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PredictController extends BaseController
{
    private PredictRepository $predictRepository;
    private MatchRepository $matchRepository;

    public function __construct(
        PredictRepository $predictRepository,
        MatchRepository $matchRepository
    ) {
        $this->predictRepository = $predictRepository;
        $this->matchRepository = $matchRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->predictRepository->getListing();

            return DataTables::of($model)
                ->addColumn('character_name', function ($model) {
                    return $model->getCharacterDisplayName();
                })
                ->addColumn('image', function ($model) {
                    if ($model->image_url) {
                        return '<img src="' . $model->image_url . '" alt="Prediction Image" class="img-thumbnail" style="max-width: 80px; max-height: 80px;">';
                    }
                    return '<span class="text-muted">No image</span>';
                })
                ->addColumn('match_title', function ($model) {
                    return $model->matches ? $model->matches->match_title : 'No Match';
                })
                ->addColumn('comment', function ($model) {
                    return $model->comment->count();
                })
                ->addColumn('like', function ($model) {
                    return $model->like->count();
                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.predict.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('predict.action', compact('model'));
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return $this->view('predict.index');
    }

    public function create()
    {
        $match = $this->matchRepository->all();
        return $this->view('predict.create', compact('match'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            
            // Check for duplicate using repository
            if ($this->predictRepository->isDuplicate($data['match_id'], $data['character_name'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', '这个比赛已经有该专家的预测，不能重复创建。');
            }
            
            $this->predictRepository->createPredict($data);

            DB::commit();

            return redirect(route('admin.predict.index'))
                ->with('success', 'Successfully created predict');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request, int $id)
    {
        if ($request->ajax()) {
            $model = $this->predictRepository->find($id)->load('comment')->comment;
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
                    $route = route('admin.predict-comment.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    $editRoute = route('admin.predict-comment.update', ['id' => $model->id]);
                    $deleteRoute = route('admin.predict-comment.destroy.delete', ['id' => $model->id]);
                    return view('shared.comment-action', compact('model', 'editRoute', 'deleteRoute'));
                })
                ->make(true);
        }

        $match = $this->matchRepository->all();
        $model = $this->predictRepository->find($id);

        return $this->view('predict.update', compact('model', 'match'));
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            
            // Check for duplicate using repository (excluding current record)
            if ($this->predictRepository->isDuplicate($data['match_id'], $data['character_name'], $id)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', '这个比赛已经有该专家的预测，不能重复。');
            }
            
            $this->predictRepository->updatePredict($data, $id);

            DB::commit();

            return redirect(route('admin.predict.index'))
                ->with('success', 'Successfully updated predict');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        $this->predictRepository->deletePredict($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->predictRepository->toggleStatus($id);
    }
}
