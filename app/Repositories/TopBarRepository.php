<?php

namespace App\Repositories;

use App\Models\TopBar;

class TopBarRepository extends BaseRepository
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
        return TopBar::class;
    }

    public function getListing()
    {
        return TopBar::query()->orderBy('created_at', 'desc');
    }

    public function createTopBar(array $input)
    {
        $model = new TopBar();
        $model->fill($input);

        $input['status'] == 1 ? TopBar::where('status', 1)->update(['status' => 0]) : null;
        
        $model->save();
    }

    public function updateTopBar(array $input, int $id)
    {
        $model = TopBar::findOrFail($id);
        $model->fill($input);

        $input['status'] == 1 ? TopBar::where('status', 1)->whereNot('id', $id)->update(['status' => 0]) : null;

        $model->save();
    }

    public function toggleStatus(int $id)
    {
        $model = TopBar::find($id);
        $model->status = !$model->status;

        $model->status == true ? TopBar::where('status', 1)->update(['status' => 0]) : null;

        $model->save();
    }

}
