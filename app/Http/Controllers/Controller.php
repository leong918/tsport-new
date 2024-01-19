<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use VVinners\Vapi\Api;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response($data = [], $code = 'OK')
    {
        $api = new Api();
        return $api->response($data, $code);
    }
}
