<?php

namespace App\Repositories;

use App\Models\BrandDescription;
use App\Traits\FileUpload;

class BrandDescriptionRepository extends BaseRepository
{
    use FileUpload;

    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return BrandDescription::class;
    }

    public function getListing()
    {
        return BrandDescription::query()->orderBy('created_at', 'desc');
    }

    public function createBrandDescription(array $input, int $brand_id)
    {
        BrandDescription::where('brand_id', $brand_id)->delete();

        foreach ($input['language'] as $key => $language) {
            $data['brand_id'] = $brand_id;
            $data['language'] = $key;
            $data['name'] = $input['name'];
            $data['description'] = $language['description']; 

            $model = new BrandDescription();
            $model->fill($data);
            $model->save();
        }
    }
}
