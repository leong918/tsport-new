<?php

namespace App\Repositories;

use App\Models\EventDescription;
use App\Traits\FileUpload;

class EventDescriptionRepository extends BaseRepository
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
        return EventDescription::class;
    }

    public function getListing()
    {
        return EventDescription::query()->orderBy('created_at', 'desc');
    }

    public function createEventDescription(array $input, int $event_id)
    {
        $old_model = EventDescription::where('event_id', $event_id);
        $old_model->delete();

        foreach ($input['language'] as $key => $language) {
            $data['event_id'] = $event_id;
            $data['language'] = $key;
            $data['name'] = $language['name'];

            $model = new EventDescription();
            $model->fill($data);
            $model->save();
        }
    }
}
