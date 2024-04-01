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
        $installed_plugins = $this->pluginRepository->getInstalledPlugin();
        $uninstalled_plugins = $this->pluginRepository->getUninstalledPlugin();

        return $this->view('plugin.index', compact('installed_plugins', 'uninstalled_plugins'));
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

    public function reinstall($name)
    {
        try {
            $this->pluginRepository->reinstallPlugin($name);

            return $this->response();
        } catch (\Exception $e) {
            return $this->response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    public function uninstall($id)
    {
        try {
            $this->pluginRepository->uninstallPlugin($id);

            return $this->response();
        } catch (\Exception $e) {
            return $this->response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id)
    {
        $this->pluginRepository->deleteById($id);
        return $this->response();
    }
}
