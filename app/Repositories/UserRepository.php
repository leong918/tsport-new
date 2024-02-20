<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository
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
        return User::class;
    }

    public function getListing()
    {
        return User::query()->orderBy('created_at', 'desc');
    }

    public function createUser(array $input)
    {
        // $input['dob']= Carbon::createFromFormat('d/m/Y', $input['dob']);
        // $input['dob'] = Carbon::parse($input['dob']);

        $model = new User();
        $model->birth_month = $input['birth_month'];
        $model->fill($input);
        $model->save();
    }

    public function updateUser(array $input, int $id)
    {
        //$input['dob']= Carbon::createFromFormat('d/m/Y', $input['dob']);
        //$input['dob'] = Carbon::parse($input['dob']);

        if (trim($input['password']) === '') {
            unset($input['password']);
        }

        $model = User::findOrFail($id);
        $model->fill($input);
        $model->save();
    }

    public function updateSession($user_id)
    {
        $new_api_token = (string) Str::uuid();
        $user = User::find($user_id);
        $user->api_token = hash('sha256', $new_api_token);
        $user->login_at = Carbon::now();
        $user->save();

        return $new_api_token;
    }

    public function getUserByUsername($username)
    {
        return User::where(['username' => $username, 'status' => 1])
            ->select(
                'id',
                'api_token',
                'name',
                'email',
                'created_at',
                'password',
                'login_at'
            )
            ->first();
    }

    public function toggleStatus(int $id)
    {
        $model = User::find($id);
        $model->status = !$model->status;
        $model->save();
    }
}
