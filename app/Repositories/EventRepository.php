<?php

namespace App\Repositories;

use App\Models\Event;
use App\Traits\FileUpload;

class EventRepository extends BaseRepository
{
    use FileUpload;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'status',
        'is_active'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     */
    public function model()
    {
        return Event::class;
    }

    /**
     * Get events listing with optional trashed records
     *
     * @param bool $withTrashed
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getListing($withTrashed = false)
    {
        $query = Event::query();
        
        if ($withTrashed) {
            $query->withTrashed();
        }
        
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Create event with image handling
     *
     * @param array $input
     * @return Event
     */
    public function createEvent(array $input)
    {
        // Handle image upload
        if (isset($input['image'])) {
            $this->upload_path = 'events';
            $this->uploadFile($input['image']);
            $input['image'] = $this->uploaded_filename;
        }

        return $this->create($input);
    }

    /**
     * Update event with image handling
     *
     * @param array $input
     * @param int $id
     * @return Event
     */
    public function updateEvent(array $input, int $id)
    {
        $event = $this->findOrFail($id);

        // Handle image upload
        if (isset($input['image'])) {
            $this->upload_path = 'events';
            $this->overwriteFile($input['image'], $event->image);
            $input['image'] = $this->uploaded_filename;
        }

        return $this->update($input, $id);
    }

    /**
     * Find event or fail
     *
     * @param int $id
     * @param bool $withTrashed
     * @return Event
     */
    public function findOrFail(int $id, bool $withTrashed = false)
    {
        $query = Event::query();
        
        if ($withTrashed) {
            $query->withTrashed();
        }
        
        return $query->findOrFail($id);
    }

    /**
     * Soft delete event
     *
     * @param int $id
     * @return bool
     */
    public function softDelete(int $id)
    {
        $event = $this->findOrFail($id);
        return $event->delete();
    }

    /**
     * Force delete event with image cleanup
     *
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id)
    {
        $event = $this->findOrFail($id, true);
        
        // Delete image if exists
        if ($event->image) {
            $this->upload_path = 'events';
            $this->deleteFile($event->image);
        }
        
        return $event->forceDelete();
    }

    /**
     * Restore soft deleted event
     *
     * @param int $id
     * @return bool
     */
    public function restore(int $id)
    {
        $event = $this->findOrFail($id, true);
        return $event->restore();
    }

    /**
     * Delete event with image cleanup
     *
     * @param int $id
     * @return bool
     */
    public function deleteEvent(int $id)
    {
        $event = $this->findOrFail($id);

        // Delete image if exists
        if ($event->image) {
            $this->upload_path = 'events';
            $this->deleteFile($event->image);
        }

        return $event->forceDelete();
    }

    /**
     * Toggle event active status
     *
     * @param int $id
     * @return Event
     */
    public function toggleStatus(int $id)
    {
        $event = $this->findOrFail($id);
        $event->is_active = !$event->is_active;
        $event->save();
        
        return $event;
    }

    /**
     * Get active events
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getActiveEvents()
    {
        return Event::active();
    }

    /**
     * Get events by status
     *
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getEventsByStatus(string $status)
    {
        return Event::byStatus($status);
    }

    /**
     * Get ongoing events
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOngoingEvents()
    {
        return Event::all()->filter(function ($event) {
            return $event->isOngoing();
        });
    }

    /**
     * Get upcoming events
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUpcomingEvents()
    {
        return Event::all()->filter(function ($event) {
            return $event->isUpcoming();
        });
    }

    /**
     * Get event status text
     *
     * @param Event $event
     * @return string
     */
    public function getEventStatusText($event)
    {
        if ($event->hasEnded()) {
            return '已结束';
        } elseif ($event->isOngoing()) {
            return '进行中';
        } else {
            return '即将开始';
        }
    }

    /**
     * Get formatted active events for display
     *
     * @return array
     */
    public function getFormattedActiveEvents()
    {
        return $this->getActiveEvents()
            ->orderBy('start_time', 'asc')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'status' => $this->getEventStatusText($event),
                    'image' => $event->image_url,
                    'timer' => $event->time_remaining,
                ];
            })
            ->toArray();
    }
}
