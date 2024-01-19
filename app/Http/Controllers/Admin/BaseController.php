<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    private string $dir = 'admin';

    protected function view(string $view, array $data = [])
    {
        return view("{$this->dir}.{$view}", $data);
    }

    protected function renderView(string $view, array $data = [])
    {
        return view("{$this->dir}.{$view}", $data)->render();
    }
}
