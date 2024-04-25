<?php

namespace App\Repositories;

use App\Models\Slider;
use App\Traits\FileUpload;

class SliderRepository extends BaseRepository
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
        return Slider::class;
    }

    public function getListing()
    {
        return Slider::query()->orderBy('created_at', 'desc');
    }

    public function updateSlider(array $input)
    {
        $this->upload_path = 'slider';

        $slider = new Slider();
        $slider->url = isset($input['main_url']) ? $input['main_url'] : $input['sub_url'];

        if(isset($input['sub_slider_image'])){
            $this->uploadFile($input['sub_slider_image']);
            $slider->image = $this->uploaded_filename;
        } else {
            $this->uploadFile($input['main_slider_image']);
            $slider->image = $this->uploaded_filename;
            $this->uploadFile($input['mobile_image']);
            $slider->mobile_image = $this->uploaded_filename;
        }

        $slider->type = ($input['type'] == 'main') ? 'main' : 'sub';
        $slider->save();
    }

}
