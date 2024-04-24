<?php

namespace App\Repositories;

use App\Models\BlogDescription;
use App\Traits\FileUpload;

class BlogDescriptionRepository extends BaseRepository
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
        return BlogDescription::class;
    }

    public function getListing()
    {
        return BlogDescription::query()->orderBy('created_at', 'desc');
    }

    public function createBlogDescription(array $input, int $blog_id)
    {
        BlogDescription::where('blog_id', $blog_id)->delete();

        foreach ($input['language'] as $key => $language) {
            $data['blog_id'] = $blog_id;
            $data['language'] = $key;
            $data['name'] = $input['name'];
            $data['content'] = $language['content'];

            if (isset($language['image'])) {
                $this->upload_path = 'blog_detail';
                $this->uploadFile($language['image']);

                $data['image'] = $this->uploaded_filename;
            } else {
                $data['image'] = $language['original_image'];
            }

            $model = new BlogDescription();
            $model->fill($data);
            $model->save();
        }
    }
}
