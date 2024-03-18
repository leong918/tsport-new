<?php

namespace App\Plugins\SalesOrder;

use App\Plugins\ConfigDefault;
use App\Repositories\PluginRepository;
use App\Repositories\AdminMenuRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderRepository;
use Illuminate\Container\Container;

class AppConfig extends ConfigDefault
{
    private $salesOrderRepository;

    public function __construct()
    {
        //Read config from config.json
        $config = file_get_contents(__DIR__ . '/config.json');
        $config = json_decode($config, true);
        $this->configGroup = $config['configGroup'];
        $this->configKey = $config['configKey'];
        $this->pathPlugin = $this->configGroup . '/' . $this->configKey;
        $this->title = $config['title'];
        $this->code = $config['code'];

        $this->salesOrderRepository = new SalesOrderRepository(new Container);
        $this->pluginRepository = new PluginRepository(new Container);
        $this->adminMenuRepository = new AdminMenuRepository(new Container);
    }

    public function install()
    {
        $checkMenu = $this->adminMenuRepository->getMenuByKey($this->configKey);
        if (!$checkMenu) {
            $parent_data = [
                'parent_id' => null,
                'title' => 'Order Manager',
                'icon' => 'fa-solid fa-cart-shopping',
                'url' => null,
                'type' => 'shop',
                'sort' => 1,
                'status' => 1
            ];
            $parent_sidebar = $this->adminMenuRepository->create($parent_data);

            $child_data = [
                'parent_id' => $parent_sidebar->id,
                'title' => 'Order',
                'icon' => null,
                'url' => 'admin.sales_order.index',
                'type' => 'shop',
                'sort' => 1,
                'status' => 1,
                'key' => $this->configKey,
            ];
            $this->adminMenuRepository->create($child_data);
        }

        $pluginData = [
            'key' => $this->configKey,
            'group' => $this->configGroup,
        ];

        $this->pluginRepository->create($pluginData);

        return $this->salesOrderRepository->installExtension();
    }

    public function uninstall()
    {
        $this->pluginRepository->makeModel()->where('key', $this->configKey)->delete();
        $this->adminMenuRepository->makeModel()->where('key', $this->configKey)->delete();
        $this->salesOrderRepository->uninstallExtension($this->code);

        return ['error' => 0, 'msg' => ''];
    }

    public function config()
    {
        //redirect to url config of plugin
        return redirect()->route('admin.sales_order.index');
    }

    public function getData()
    {
        $arrData = [
            'title' => $this->title,
            'key' => $this->configKey,
            'pathPlugin' => $this->pathPlugin
        ];

        return $arrData;
    }
}
