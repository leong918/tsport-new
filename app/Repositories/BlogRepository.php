<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Container\Container;
use Carbon\Carbon;
use App\Traits\FileUpload;

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
        $models = Blog::query()->orderBy('created_at', 'desc')
            ->orderBy('sort', 'desc');

        return $models;
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Blog::where('status', 1)
            ->whereHas('blogCategory')
            ->orderBy('created_at', 'desc')
            ->get(), $key, 'name');
    }

    public function getBlogByCategory($blog_category_id)
    {
        return Blog::where([
            'status' => 1,
            'blog_category_name' => $blog_category_id
            ])
            ->orderBy('sort', 'desc')
            ->orderBy('published_at', 'desc')
            ->get();
    }

    public function getFirstBlogByCategory($blog_category_id)
    {
        return Blog::where([
            'status' => 1,
            'blog_category_name' => $blog_category_id
            ])
            ->orderBy('sort', 'desc')
            ->orderBy('published_at', 'desc')
            ->first();
    }

    public function getActiveBlog($id)
    {
        return Blog::where('status', 1)
            ->find($id);
    }

    public function createBlog(array $input)
    {
        $input['published_at'] = $input['published_at'] ? Carbon::createFromFormat('Y-m-d', $input['published_at'])->startOfDay()->format('Y-m-d H:i:s') : null;

        if (isset($input['image'])) {
            $this->upload_path = 'blog_description';
            $this->uploadFile($input['image']);

            $input['image'] = $this->uploaded_filename;
        } else {
            $input['image'] = $input['original_image'];
        }

        $model = new Blog();
        $model->name = $input['language']['en']['name'];
        $model->fill($input);
        $model->save();

        $blogDescriptionRepository = new BlogDescriptionRepository(new Container());
        $blogDescriptionRepository->createBlogDescription($input, $model->id);
    }

    public function updateBlog(array $input, int $id)
    {
        $input['published_at'] = $input['published_at'] ? Carbon::createFromFormat('Y-m-d', $input['published_at'])->startOfDay()->format('Y-m-d H:i:s') : null;

        $model = Blog::findOrFail($id);

        if (isset($input['image'])) {
            $this->upload_path = 'blog_description';
            $this->uploadFile($input['image']);

            $input['image'] = $this->uploaded_filename;
        } else {
            $input['image'] = $input['original_image'];
        }

        $model->name = $input['language']['en']['name'];
        $model->fill($input);
        $model->save();

        $blogDescriptionRepository = new BlogDescriptionRepository(new Container());
        $blogDescriptionRepository->createBlogDescription($input, $model->id);
    }

    public function toggleStatus(int $id)
    {
        $model = Blog::find($id);
        $model->status = !$model->status;
        $model->save();

        return $model;
    }
}
