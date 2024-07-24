<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository extends BaseRepository
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
        return Admin::class;
    }

    public function createAccount(array $input)
    {
        $model = new Admin();
        $model->fill($input);
        $model->password = $input['password'];
        $model->save();
    }

    public function updateAccount(array $input, int $id)
    {
        if (!isset($input['password']) || !$input['password']) {
            unset($input['password']);
        }
        $model = Admin::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function getListing()
    {
        return Admin::query()->orderBy('created_at', 'desc');
    }

    public function toggleStatus(int $id)
    {
        $model = Admin::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
