<?php

namespace App\Http\Controllers\Web;

use App\Repositories\UserRepository;
use App\Repositories\CountryRepository;
use App\Http\Requests\Form\User\UserUpdateInfoRequest;
use App\Http\Requests\Form\User\UserUpdateAddressRequest;
use Illuminate\Support\Facades\Hash;

class AccountController extends BaseController
{
    private UserRepository $userRepository;
    private CountryRepository $countryRepository;

    public function __construct(UserRepository $userRepository, CountryRepository $countryRepository)
    {
        $this->userRepository = $userRepository;
        $this->countryRepository = $countryRepository;
    }

    public function accountDetails()
    {
        $user_id = auth()->user()->id;
        $user = $this->userRepository->find($user_id);

        return $this->view('account.account_details', compact('user'));
    }
    public function accountAddress()
    {
        $user_id = auth()->user()->id;
        $user = $this->userRepository->find($user_id);
        $countryDropdown = $this->countryRepository->dropdown();
        return $this->view('account.account_address', compact('user','countryDropdown'));
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
    public function doUpdateUserAddress(UserUpdateAddressRequest $request, int $user_id)
    {
        $data = $request->all();
        $country = $this->countryRepository->find($data['country_id']);
        $data['country'] = $country->name;
        $this->userRepository->updateUser($data, $user_id);
    }
}
