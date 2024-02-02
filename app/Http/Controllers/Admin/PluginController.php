<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Admin\InstallPluginRequest;
use App\Repositories\PluginRepository;

class PluginController extends BaseController
{
    private PluginRepository $pluginRepository;

    public function __construct(PluginRepository $pluginRepository)
    {
        $this->pluginRepository = $pluginRepository;
    }

    public function index()
    {
        return $this->view('plugin.index');
    }

    public function install(InstallPluginRequest $request)
    {
        try {
            $plugin = $request->file('plugin');
            $this->pluginRepository->installPlugin($plugin);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
