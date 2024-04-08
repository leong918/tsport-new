<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Container\Container;

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

    public function getListing()
    {
        return User::query()->orderBy('created_at', 'desc');
    }

    public function createUser(array $input)
    {
        $input['dob'] = Carbon::createFromFormat('d/m/Y', $input['dob'])->startOfDay();
        $model = new User();
        $model->fill($input);
        $model->save();

        return $model;
    }

    public function updateUser(array $input, int $id)
    {
        if (isset($input['password']) && trim($input['password']) === '') {
            unset($input['password']);
        }
        $input['dob'] = Carbon::createFromFormat('d/m/Y', $input['dob'])->startOfDay();
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
    public function getUserByEmail(string $email, string $phone_no = null)
    {
        if ($phone_no) {
            return User::where(['email' => $email, 'phone_no' => $phone_no, 'status' => 1])->first();
        }

        return User::where(['email' => $email, 'status' => 1])->first();
    }

    public function toggleStatus(int $id)
    {
        $model = User::find($id);
        $model->status = !$model->status;
        $model->save();
    }

    public function getAddressData($user_id)
    {
        return User::select(
            'country_id',
            'address_first_name as first_name',
            'address_last_name as last_name',
            'company_name',
            'address_phone_no as phone_no',
            'address_email as email',
            'country',
            'postcode',
            'state',
            'city',
            'address'
        )->find($user_id)->toArray();
    }

    public function calculateDiscountPoint($user_id, $point_session, $max_point_redemption)
    {
        $data = array();
        $data['point_redemption'] = 0;
        $data['point_used'] = 0;

        $settingRepository = new SettingRepository(new Container());
        if ($user_id && $point_session) {
            $user = User::find($user_id);
            $point_redemption_ratio = $settingRepository->getValueByKey('point_redemption_ratio');
            $point_redemption = round($user->point * (int) $point_redemption_ratio, 2);

            $data['point_redemption'] = $point_redemption > $max_point_redemption ? $max_point_redemption : $point_redemption;
            $data['point_used'] = $user->point;
        }

        return $data;
    }

    public function deductFullPoint($order)
    {
        $user = User::find($order->user_id);
        $user->point = 0;
        $user->save();
    }

    public function returnFullPoint($order)
    {
        $user = User::find($order->user_id);
        $user->point += $order->point_used;
        $user->save();
    }

    public function addOrderPoint($order)
    {
        $user = User::find($order->user_id);
        $user->point += $order->point_earned;
        $user->save();

        $pointLogRepository = new PointLogRepository(new Container());
        $pointLogData['user_id'] = $user->id;
        $pointLogData['sales_order_id'] = $order->id;
        $pointLogData['point'] = $order->point_earned;
        $pointLogData['type'] = 'IN';
        $pointLogData['remark'] = 'Add point from order ' . $order->sales_order_id;
        $pointLogData['expired_at'] = Carbon::now()->addMonths(6);
        $pointLogRepository->create($pointLogData);
    }

    public function addReviewPoint($user_id, $review_id)
    {
        $settingRepository = new SettingRepository(new Container());
        $review_point = $settingRepository->getValueByKey('review_point');

        $user = User::find($user_id);
        $user->point += $review_point;
        $user->save();

        $pointLogRepository = new PointLogRepository(new Container());
        $pointLogData['user_id'] = $user->id;
        $pointLogData['point'] = $review_point;
        $pointLogData['type'] = 'IN';
        $pointLogData['remark'] = 'Earned Point by Review. ID: ' . $review_id;
        $pointLogRepository->create($pointLogData);
    }

    public function getUserByLevelValidity()
    {
        return User::where('status', 1)
            ->where('level_id', '!=', '1')
            ->whereDate('level_validity', Carbon::today()->subDay())
            ->get();
    }
}
