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

    public function event()
    {
        return $this->view('event');
    }

    public function eventDetails()
    {
        return $this->view('event_details');
    }
}
