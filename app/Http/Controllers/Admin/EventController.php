<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EventController extends BaseController
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $events = $this->eventRepository->getListing(true)->get();
            
            return DataTables::of($events)
                ->addColumn('image_preview', function ($event) {
                    if ($event->image) {
                        return '<img src="' . $event->image_url . '" alt="Event Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">';
                    }
                    return '<span class="text-muted">No Image</span>';
                })
                ->addColumn('status_badge', function ($event) {
                    if ($event->deleted_at) {
                        return '<span class="badge bg-danger">Deleted</span>';
                    }
                    $class = $event->status === 'active' ? 'success' : ($event->status === 'upcoming' ? 'warning' : 'secondary');
                    return '<span class="badge bg-' . $class . '">' . ucfirst($event->status) . '</span>';
                })
                ->addColumn('time_remaining', function ($event) {
                    return $event->time_remaining ?? 'N/A';
                })
                ->addColumn('action', function ($event) {
                    return $this->view('event.action', compact('event'));
                })
                ->rawColumns(['image_preview', 'status_badge', 'action'])
                ->make(true);
        }

        return $this->view('event.index');
    }

    public function create()
    {
        return $this->view('event.create');
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();
        
        // Extract image file before passing to repository
        $imageFile = $request->file('image');
        unset($data['image']);
        
        if ($imageFile) {
            $data['image'] = $imageFile;
        }

        $this->eventRepository->createEvent($data);

        return redirect()->route('admin.event.index')
            ->with('success', 'Event created successfully!');
    }

    public function show($id)
    {
        $event = $this->eventRepository->findOrFail($id, true);
        return $this->view('event.show', compact('event'));
    }

    public function edit($id)
    {
        $event = $this->eventRepository->findOrFail($id);
        return $this->view('event.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $data = $request->validated();
        
        // Extract image file before passing to repository
        $imageFile = $request->file('image');
        unset($data['image']);
        
        if ($imageFile) {
            $data['image'] = $imageFile;
        }

        $this->eventRepository->updateEvent($data, $id);

        return redirect()->route('admin.event.index')
            ->with('success', 'Event updated successfully!');
    }

    public function destroy($id)
    {
        $this->eventRepository->softDelete($id);

        return response()->json(['success' => 'Event deleted successfully!']);
    }

    public function forceDelete($id)
    {
        $this->eventRepository->forceDelete($id);

        return response()->json(['success' => 'Event permanently deleted!']);
    }

    public function restore($id)
    {
        $this->eventRepository->restore($id);

        return response()->json(['success' => 'Event restored successfully!']);
    }

    public function toggleStatus($id)
    {
        $this->eventRepository->toggleStatus($id);

        return response()->json(['success' => 'Event status updated successfully!']);
    }
}
