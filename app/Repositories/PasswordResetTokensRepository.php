<?php

namespace App\Repositories;

use App\Models\PasswordResetTokens;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PasswordResetTokensRepository extends BaseRepository
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
        return PasswordResetTokens::class;
    }

    public function getListing()
    {
        return PasswordResetTokens::query()->orderBy('created_at', 'desc');
    }

    public function createRecord(array $input)
    {

        $model = new PasswordResetTokens();
        $model->fill($input);
        $model->save();
    }

    public function findRecordByToken($token){
        return PasswordResetTokens::where('token', $token)->first();
    }
}
