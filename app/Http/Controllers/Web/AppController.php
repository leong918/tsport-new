<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends BaseController
{

    public function __construct() {}

    public function index()
    {
        return $this->view('index');
    }

    public function aboutUs()
    {
        return $this->view('about-us');
    }
}
