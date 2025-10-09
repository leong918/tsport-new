<?php

namespace App\Repositories;

use App\Models\User;
use App\Utils\RandomGenerator;

class UserRepository extends BaseRepository
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
        return User::class;
    }

    public function createAccount(array $input)
    {
        $generator = new RandomGenerator();
        do {
            $code = $generator->generate();
        } while (User::where('referral_code', $code)->exists());

        $model = new User();
        $model->fill($input);
        $model->referral_code = $code;
        $model->password = $input['password'];
        $model->save();
        
        return $model;
    }

    public function updateAccount(array $input, int $id)
    {
        if (!isset($input['password']) || !$input['password']) {
            unset($input['password']);
        }
        $model = User::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function getListing()
    {
        return User::query()->orderBy('created_at', 'desc');
    }

    public function toggleStatus(int $id)
    {
        $model = User::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
