<?php

namespace App\Repositories;

use App\Models\BlogComment;

class BlogCommentRepository extends BaseRepository
{
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
        return BlogComment::class;
    }

    public function getListing()
    {
        return BlogComment::query()->orderBy('created_at', 'desc');
    }

    public function toggleStatus(int $id)
    {
        $model = BlogComment::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    public function getBlogComment(int $blog_id)
    {
        return BlogComment::where('blog_id',$blog_id);
    }
}
