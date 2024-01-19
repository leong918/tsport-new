<?php

namespace App\Http\Controllers\API;

use App\Exceptions\GeneralException;
use App\Http\Requests\API\UserLoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(UserLoginRequest $request)
    {
        $user = $this->userRepository->getUserByUsername($request->username);
        if (!$user) {
            throw new GeneralException('USER_NOT_FOUND');
        }

        // check password match
        if (Hash::check($request->password, $user->password)) {
            // generate new session_id
            $api_token = $this->userRepository->updateSession($user->id);
            if ((bool) $api_token) {
                $user->api_token = $api_token;

                return $this->response(['data' => $user]);
            }
        } else {
            throw new GeneralException('INVALID_PASSWORD');
        }

        throw new GeneralException('LOGIN_FAILED');
    }
}
