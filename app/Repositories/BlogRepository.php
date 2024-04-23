<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Container\Container;
use Carbon\Carbon;

class BlogRepository extends BaseRepository
{
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

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Blog::all(), $key, 'name');
    }

    public function createBlog(array $input)
    {
        $this->verifyDescription($input);

        $input['published_at'] = $input['published_at'] ? Carbon::createFromFormat('Y-m-d g:i A', $input['published_at'])->format('Y-m-d H:i:s') : null;
        
        $model = new Blog();
        $model->fill($input);
        $model->save();

        $blogDescriptionRepository = new BlogDescriptionRepository(new Container());
        $blogDescriptionRepository->createBlogDescription($input, $model->id);
    }

    public function updateBlog(array $input, int $id)
    {
        $this->verifyDescription($input, true);
        
        $input['published_at'] = $input['published_at'] ? Carbon::createFromFormat('Y-m-d g:i A', $input['published_at'])->format('Y-m-d H:i:s') : null;

        $model = Blog::findOrFail($id);
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
    }

    public function verifyDescription($input, $update = false)
    {
        foreach ($input['language'] as $key => $language) {
            $lang = ($key == 'zh-CN' ? 'Chinese' : 'English');

            if (isset($language['image']) == false && $update == false) {
                throw new \Exception(__('Image for ' . $lang . ' cannot be empty!'));
            }
            if (isset($language['content']) == false) {
                throw new \Exception(__('Content for ' . $lang . ' cannot be empty!'));
            }
        }
    }
}
