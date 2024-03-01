<?php

namespace App\Repositories;

use App\Models\BlogDetail;
use App\Traits\FileUpload;

class BlogDetailRepository extends BaseRepository
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
        return BlogDetail::class;
    }

    public function getListing()
    {
        return BlogDetail::query()->orderBy('created_at', 'desc');
    }

    public function createBlogDetail(array $input, int $blog_id)
    {
        BlogDetail::where('blog_id', $blog_id)->delete();
        
        foreach ($input['language'] as $key => $language) {
            $data['blog_id'] = $blog_id;
            $data['language'] = $key;
            $data['name'] = $language['name'];
            $data['content'] = $language['content']; 

            if(isset($language['image'])){
                $this->upload_path = 'blog_detail';
                $this->uploadFile($language['image']);

                $data['image'] = $this->uploaded_filename; 
            }else{
                $data['image'] = $language['original_image']; 
            }
            
            $model = new BlogDetail();
            $model->fill($data);
            $model->save();
        }
    }
}
