<?php

namespace App\Plugins\ProductReview;

use App\Plugins\ConfigDefault;
use App\Repositories\PluginRepository;
use App\Repositories\AdminMenuRepository;
use App\Plugins\ProductReview\Repositories\ProductReviewRepository;
use Illuminate\Container\Container;

class AppConfig extends ConfigDefault
{
    private $productReviewRepository;

    public function __construct() {
        //Read config from config.json
        $config = file_get_contents(__DIR__.'/config.json');
        $config = json_decode($config, true);
    	$this->configGroup = $config['configGroup'];
        $this->configKey = $config['configKey'];
        $this->pathPlugin = $this->configGroup . '/' . $this->configKey;
        $this->title = $config['title'];
        $this->code = $config['code'];

        $this->productReviewRepository = new ProductReviewRepository(new Container);
        $this->pluginRepository = new PluginRepository(new Container);
        $this->adminMenuRepository = new AdminMenuRepository(new Container);
    }

    public function install()
    {
        $checkMenu = $this->adminMenuRepository->getMenuByKey($this->configKey);
        if (!$checkMenu) {
            $data = [
                'parent_id' => 2,
                'title' => 'Product Review',
                'icon' => null,
                'url' => 'admin.product_review.index',
                'type' => 'shop',
                'sort' => 4,
                'status' => 1,
                'key' => $this->configKey,
            ];
            $this->adminMenuRepository->create($data);
        }

        $pluginData = [
            'key' => $this->configKey,
            'group' => $this->configGroup,
        ];

        $this->pluginRepository->create($pluginData);

        return $this->productReviewRepository->installExtension($this->code);
    }

    public function uninstall()
    {
        $this->pluginRepository->makeModel()->where('key', $this->configKey)->delete();
        $this->adminMenuRepository->makeModel()->where('key', $this->configKey)->delete();
        $this->productReviewRepository->uninstallExtension($this->code);

        return ['error' => 0, 'msg' => ''];
    }

    public function config()
    {
        //redirect to url config of plugin
        return redirect()->route('admin.product_review.index');
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
