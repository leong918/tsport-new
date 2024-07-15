<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class DashboardController extends BaseController
{
    public function index(Request $request)
    {
        return $this->view('dashboard.index');
    }
}
