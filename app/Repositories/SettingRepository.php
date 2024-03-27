<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Traits\FileUpload;

class SettingRepository extends BaseRepository
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
        return Setting::class;
    }

    public function getListing()
    {
        return Setting::query()->orderBy('created_at', 'desc');
    }

    public function updateValueByKey($key, $value)
    {
        $value = is_array($value) ? json_encode($value) : $value;

        Setting::updateOrCreate(
            [
                'key' => $key
            ],
            [
                'value' => $value
            ],
        );
    }

    public function getValueByKey($key)
    {
        $setting = Setting::where([
            'key' => $key,
        ])->first();
        if ($setting) {
            return $setting->value;
        }
        return '';
    }
}
