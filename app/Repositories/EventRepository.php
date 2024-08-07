<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Container\Container;
use Carbon\Carbon;
use App\Traits\FileUpload;

class EventRepository extends BaseRepository
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
        return Event::class;
    }

    public function getListing()
    {
        $models = Event::query()->where('status', 1)->orderBy('created_at', 'desc')
            ->orderBy('sort', 'desc');

        return $models;
    }

    public function getById($id){
        return Event::findOrFail($id);
    }

    public function getLatestEvent($type){
        $limit_num = $type === 'news' ? 3 : 1;

        return Event::where(['type' => $type, 'status' => 1])->orderBy('published_at', 'desc')->limit($limit_num)->get();
    }

    public function createEvent($data)
    {
        $data['published_at'] = $data['published_at'] ? Carbon::createFromFormat('Y-m-d', $data['published_at'])->startOfDay()->format('Y-m-d H:i:s') : null;
        $eventDescriptionRepository = new EventDescriptionRepository(new Container());
        $eventGalleryRepository = new EventGalleryRepository(new Container());

        $model = new Event();
        $model->name = $data['language']['en']['name'];
        $model->fill($data);
        $model->save();

        if (isset($data['image']) && count($data['image'])) {
            $this->upload_path = 'event';

            $eventGalleryRepository->deleteGalleryByEventId($model->id);
            foreach ($data['image'] as $img) {
                $this->uploadFile($img);
                $img = $this->uploaded_filename;
                $eventGalleryRepository->createEventGallery($img, $model->id);
            }
        }

        $eventDescriptionRepository->createEventDescription($data, $model->id);
    }

    public function updateEvent($data, $id)
    {
        $data['published_at'] = $data['published_at'] ? Carbon::createFromFormat('Y-m-d', $data['published_at'])->startOfDay()->format('Y-m-d H:i:s') : null;
        $eventDescriptionRepository = new EventDescriptionRepository(new Container());
        $eventGalleryRepository = new EventGalleryRepository(new Container());

        $model = Event::find($id);
        $model->name = $data['language']['en']['name'];
        $model->fill($data);
        $model->save();

        if (isset($data['image']) && count($data['image'])) {
            $this->upload_path = 'event';

            $eventGalleryRepository->deleteGalleryByEventId($model->id);
            foreach ($data['image'] as $img) {
                $this->uploadFile($img);
                $img = $this->uploaded_filename;
                $eventGalleryRepository->createEventGallery($img, $model->id);
            }
        }

        $eventDescriptionRepository->createEventDescription($data, $model->id);
        
    }

    public function toggleStatus(int $id)
    {
        $model = Event::find($id);
        $model->status = !$model->status;
        $model->save();

        return $model;
    }
}
