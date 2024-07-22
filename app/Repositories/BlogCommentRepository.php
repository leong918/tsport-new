<?php

namespace App\Repositories;

use App\Models\BlogComment;
use App\Traits\FileUpload;

class BlogCommentRepository extends BaseRepository
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
        return BlogComment::class;
    }

    public function getBlogComment($id)
    {
        $model = BlogComment::find($id);

        return $model;
    }

    // public function getListing(array $form_data)
    // {
    //     $models = BlogComment::query()->orderBy('created_at', 'desc')
    //         ->orderBy('sort', 'desc');

    //     foreach (array_filter($form_data, 'filter') as $key => $value) {
    //         if ($key === 'name') {
    //             $models->where($key, 'like', "%{$value}%");
    //         } else {
    //             $models->where($key, $value);
    //         }
    //     }

    //     return $models;
    // }

    // public function createBlog(array $input)
    // {
    //     $input['published_at'] = $input['published_at'] ? Carbon::createFromFormat('Y-m-d', $input['published_at'])->startOfDay()->format('Y-m-d H:i:s') : null;

    //     if (isset($input['image'])) {
    //         $this->upload_path = 'blog_description';
    //         $this->uploadFile($input['image']);

    //         $input['image'] = $this->uploaded_filename;
    //     } else {
    //         $input['image'] = $input['original_image'];
    //     }

    //     $model = new Blog();
    //     $model->name = $input['language']['en']['name'];
    //     $model->fill($input);
    //     $model->save();

    //     $blogDescriptionRepository = new BlogDescriptionRepository(new Container());
    //     $blogDescriptionRepository->createBlogDescription($input, $model->id);
    // }

    // public function updateBlog(array $input, int $id)
    // {
    //     $input['published_at'] = $input['published_at'] ? Carbon::createFromFormat('Y-m-d', $input['published_at'])->startOfDay()->format('Y-m-d H:i:s') : null;

    //     $model = Blog::findOrFail($id);

    //     if (isset($input['image'])) {
    //         $this->upload_path = 'blog_description';
    //         $this->uploadFile($input['image']);

    //         $input['image'] = $this->uploaded_filename;
    //     } else {
    //         $input['image'] = $input['original_image'];
    //     }

    //     $model->name = $input['language']['en']['name'];
    //     $model->fill($input);
    //     $model->save();

    //     $blogDescriptionRepository = new BlogDescriptionRepository(new Container());
    //     $blogDescriptionRepository->createBlogDescription($input, $model->id);
    // }

    // public function toggleStatus(int $id)
    // {
    //     $model = Blog::find($id);
    //     $model->status = !$model->status;
    //     $model->save();

    //     return $model;
    // }
}
