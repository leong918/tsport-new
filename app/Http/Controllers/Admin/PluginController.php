<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Form\Admin\InstallPluginRequest;
use App\Repositories\PluginRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PluginController extends BaseController
{
    private PluginRepository $pluginRepository;

    public function __construct(PluginRepository $pluginRepository)
    {
        $this->pluginRepository = $pluginRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = $this->pluginRepository->getListing();

            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    return $this->view('plugin.action', compact('model'));
                })
                ->make(true);
        }

        return $this->view('plugin.index');
    }

    public function install(InstallPluginRequest $request)
    {
        try {
            $plugin = $request->file('plugin');
            $this->pluginRepository->installPlugin($plugin);

            return redirect(route('admin.plugin.index'))->with('success', "Successfully install plugin");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        $this->pluginRepository->deleteById($id);
        return $this->response();
    }
}
