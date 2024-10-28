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
        $old_model = BlogDescription::where('blog_id', $blog_id);
        $old_model->delete();

        foreach ($input['language'] as $key => $language) {
            $data['blog_id'] = $blog_id;
            $data['language'] = $key;
            $data['name'] = $language['name'];
            $data['description'] = $language['description'];
            $data['content'] = $language['content'];

            $model = new BlogDescription();
            $model->fill($data);
            $model->save();
        }
    }
}
