<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Traits\FileUpload;
use Carbon\Carbon;

class BlogRepository extends BaseRepository
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
        return Blog::class;
    }

    public function getListing()
    {
        return Blog::query()->orderBy('created_at', 'desc');
    }

    public function createBlog(array $input)
    {
        $input['published_at'] = $input['published_at']
        ? Carbon::createFromFormat('Y-m-d', $input['published_at'])->startOfDay()->format('Y-m-d H:i:s')
        : null;

        // Handle thumbnail
        if (isset($input['thumbnail'])) {
            $this->upload_path = 'blog';
            $this->uploadFile($input['thumbnail']);

            $input['thumbnail'] = $this->uploaded_filename;
        } else {
            $input['thumbnail'] = $input['original_thumbnail'];
        }

        $model = new Blog();
        $model->fill($input);
        $model->save();
    }

    public function updateBlog(array $input, int $id)
    {
        $input['published_at'] = $input['published_at']
        ? Carbon::createFromFormat('Y-m-d', $input['published_at'])->startOfDay()->format('Y-m-d H:i:s')
        : null;

        // Handle thumbnail
        if (isset($input['thumbnail'])) {
            $this->upload_path = 'blog';
            $this->overwriteFile($input['thumbnail'], $input['original_thumbnail']);

            $input['thumbnail'] = $this->uploaded_filename;
        } else {
            $input['thumbnail'] = $input['original_thumbnail'];
        }

        $model = Blog::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function deleteBlog(int $id)
    {
        $model = Blog::findOrFail($id);

        $this->upload_path = 'blog';
        $this->deleteFile($model->thumbnail);

        $model->deleteTranslations();
        $model->delete();
    }

    public function toggleStatus(int $id)
    {
        $model = Blog::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
