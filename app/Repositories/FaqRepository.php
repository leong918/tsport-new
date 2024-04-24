<?php

namespace App\Repositories;

use App\Models\Faq;

class FaqRepository extends BaseRepository
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
        return Faq::class;
    }

    public function getListing()
    {
        return Faq::query()->orderBy('sort', 'asc');
    }

    public function createFaq(array $input)
    {
        $model = new Faq();
        $model->fill($input);
        $model->save();
    }

    public function updateFaq(array $input, int $id)
    {
        $model = Faq::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function toggleStatus(int $id)
    {
        $model = Faq::find($id);
        $model->status = !$model->status;
        $model->save();
    }

}
