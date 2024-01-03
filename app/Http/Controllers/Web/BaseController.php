<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    private $dir = 'web';

    protected function view(string $view, array $data = [])
    {
        return view("{$this->dir}.{$view}", $data);
    }

    protected function renderView(string $view, array $data = [])
    {
        return view("{$this->dir}.{$view}", $data)->render();
    }
}
