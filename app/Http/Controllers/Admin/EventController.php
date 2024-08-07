<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Blog\CreateBlogRequest;
use App\Http\Requests\Form\Blog\UpdateBlogRequest;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventController extends BaseController
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->eventRepository->getListing();

            return DataTables::of($model)
                ->addColumn('status', function ($model) {
                    $route = route('admin.event.status.post', ['id' => $model->id]);
                    $status = $model->status;
                    return view('shared.status', compact('route', 'status', 'model'));
                })
                ->addColumn('action', function ($model) {
                    return $this->view('event.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('event.index');
    }

    public function create()
    {
        return $this->view('event.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->eventRepository->createEvent($request->all());
            DB::commit();
            return redirect(route('admin.event.index'))->with('success', "Successfully create event");
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(int $id)
    {
        $model = $this->eventRepository->find($id);
        $model->published_at = $model->published_at ? Carbon::parse($model->published_at)->format('Y-m-d g:i A') : null;
        return $this->view('event.update', compact('model'));
    }

    public function update(Request $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->eventRepository->updateEvent($request->all(), $id);
            DB::commit();
            return redirect(route('admin.event.index'))->with('success', "Successfully update event");
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['msg' => $exception->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $this->eventRepository->delete($id);
        return $this->response();
    }


    public function toggleStatus(int $id)
    {
        $this->eventRepository->toggleStatus($id);
    }
}
