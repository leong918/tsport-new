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

    public function mission()
    {
        return $this->view('mission');
    }

    public function ourPartner()
    {
        return $this->view('our-partner');
    }

    public function founder()
    {
        return $this->view('founder');
    }

    public function whatDoWeDo()
    {
        return $this->view('what-do-we-do');
    }
}
