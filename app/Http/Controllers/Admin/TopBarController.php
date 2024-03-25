<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\TopBarRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Form\TopBar\CreateTopBarRequest;
use App\Http\Requests\Form\TopBar\UpdateTopBarRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class TopBarController extends BaseController
{
    private TopBarRepository $topBarRepository;

    public function __construct(TopBarRepository $topBarRepository)
    {
        $this->topBarRepository = $topBarRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->topBarRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.top_bar.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('top_bar.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('top_bar.index');
    }

    public function create()
    {
        return $this->view('top_bar.create');
    }

    public function store(CreateTopBarRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->topBarRepository->createTopBar($request->all());
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
        return redirect(route('admin.top_bar.index'))->with('success', "Successfully create product");
    }

    public function edit(int $id)
    {
        $model = $this->topBarRepository->find($id);

        return $this->view('top_bar.update', compact('model'));
    }

    public function update(UpdateTopBarRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->topBarRepository->updateTopBar($request->all(), $id);
            DB::commit();
            return $this->response();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }

        return redirect(route('admin.top_bar.index'))->with('success', "Successfully update product");
    }

    public function destroy(int $id)
    {
        $this->topBarRepository->delete($id);

        return $this->response();
    }

    public function toggleStatus(int $id)
    {
        $this->topBarRepository->toggleStatus($id);
    }
}
