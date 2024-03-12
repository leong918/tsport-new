<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Traits\FileUpload;
use Illuminate\Container\Container;

class TagRepository extends BaseRepository
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
        return Tag::class;
    }

    public function getListing()
    {
        return Tag::query()->orderBy('created_at', 'desc');
    }

    public function dropdown(string $key = 'id')
    {
        return formalizeDropdown(Tag::all(), $key, 'name');
    }

    public function createTag(array $input)
    {
        // $this->verifyDescription($input);

        //image
        // $this->upload_path = 'tag';
        // $this->uploadFile($input['image']);

        $model = new Tag();
        $model->fill($input);
        // $model->image = $this->uploaded_filename;
        $model->save();

        // $TagDescriptionRepository = new TagDescriptionRepository(new Container());
        // $TagDescriptionRepository->createTagDescription($input, $model->id);
    }

    public function updateTag(array $input, int $id)
    {
        $model = Tag::findOrFail($id);
        $model->fill($input);

        // if(isset($input['image'])){
        //     //image
        //     $this->upload_path = 'Tag';
        //     $this->uploadFile($input['image']);  
        //     $model->image = $this->uploaded_filename;
        // }

        $model->save();

        // $TagDescriptionRepository = new TagDescriptionRepository(new Container());
        // $TagDescriptionRepository->createTagDescription($input, $model->id);
    }

    public function toggleStatus(int $id)
    {
        $model = Tag::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    // private function verifyDescription($input)
    // {
    //     foreach ($input['language'] as $key => $language) {
    //         $lang = ($key == 'cn' ? 'Chinese' : 'English');

    //         if (isset($language['name']) == false) {
    //             throw new \Exception(__('Name for '.$lang.' cannot be empty!'));
    //         }
    //         if (isset($language['description']) == false) {
    //             throw new \Exception(__('Description for '.$lang.' cannot be empty!'));
    //         }
    //     }
    // }
}
