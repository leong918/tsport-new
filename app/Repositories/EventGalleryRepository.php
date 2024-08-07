<?php

namespace App\Repositories;

use App\Models\EventGallery;
use App\Traits\FileUpload;

class EventGalleryRepository extends BaseRepository
{
    use FileUpload;

    /**
     * @var array
     */
    protected $fieldSearchable = [];

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
        return EventGallery::class;
    }

    public function getListing()
    {
        return EventGallery::query()->orderBy('created_at', 'desc');
    }

    public function createEventGallery($input, int $event_id)
    {
        $data['event_id'] = $event_id;
        $data['url'] = $input;
        $model = new EventGallery();

        $model->fill($data);
        $model->save();
    }

    public function deleteGalleryByEventId($event_id)
    {
        EventGallery::where('event_id', $event_id)->delete();
    }
}
