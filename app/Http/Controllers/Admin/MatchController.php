<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\MatchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MatchController extends BaseController
{
    private MatchRepository $matchRepository;

    public function __construct(MatchRepository $matchRepository)
    {
        $this->matchRepository = $matchRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->matchRepository->getListing();

            return DataTables::of($model)
                ->addColumn('match_title', function ($model) {
                    return $model->match_title;
                })
                ->addColumn('short_content', function ($model) {
                    return $model->short_content ?? '-';
                })
                ->addColumn('status', function ($model) {
                    $route = route('admin.match.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('is_top', function ($model) {
                    $route = route('admin.match.top.post', ['id' => $model->id]);
                    $status = $model->is_top;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('start_at', function ($model) {
                    return $model->start_at;
                })
                ->addColumn('action', function ($model) {
                    return $this->view('match.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('match.index');
    }

    public function create()
    {
        return $this->view('match.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $this->matchRepository->createMatch($data);

            DB::commit();

            return redirect(route('admin.match.index'))
                ->with('success', 'Successfully created match');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(int $id)
    {
        $model = $this->matchRepository->find($id);

        return $this->view('match.update', compact('model'));
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $this->matchRepository->updateMatch($data, $id);

            DB::commit();

            return redirect(route('admin.match.index'))
                ->with('success', 'Successfully updated match');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        $this->matchRepository->deleteMatch($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->matchRepository->toggleStatus($id);
    }

    public function toggleTop(int $id)
    {
        $this->matchRepository->toggleTop($id);
        
        return $this->response();
    }
}
