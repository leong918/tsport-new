<?php

namespace App\Http\Controllers\Web;

use App\Repositories\UserRepository;
use App\Http\Requests\Form\user\UserUpdateInfoRequest;
use Illuminate\Support\Facades\Hash;

class AccountController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function accountDetails()
    {
        $user_id = auth()->user()->id;
        $user = $this->userRepository->find($user_id);

        return $this->view('account.account_details', compact('user'));
    }
    public function accountAddress()
    {
        return $this->view('account.account_address');
    }
    public function accountOrder()
    {
        return $this->view('account.account_order');
    }
    public function accountOrderDetail()
    {
        return $this->view('account.account_order_detail');
    }
    public function accountPoints()
    {
        return $this->view('account.account_point');
    }
    public function doUpdateUserAccount(UserUpdateInfoRequest $request, int $user_id)
    {
        $data = $request->all();
        $user = $this->userRepository->find($user_id);
        if ($data['current_password']) {
            if (!Hash::check($data['current_password'], $user->password)) {
                throw new \Exception('Password Incorrect!');
            }
            if (Hash::check($data['password'], $user->password)) {
                throw new \Exception('New Password Cannot Same With Current Password!');
            }
        }
        $this->userRepository->updateUser($data, $user->id);
    }
}
