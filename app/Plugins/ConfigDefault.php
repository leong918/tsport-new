<?php

namespace App\Plugins;

abstract class ConfigDefault
{       
    public $configGroup;
    public $configKey;
    public $pathPlugin;
    public $title;
    public $code;

    public $pluginRepository;
    public $adminMenuRepository;

    /**
     * Install app
     */
    abstract public function install();

    /**
     * Uninstall app
     */
    abstract public function uninstall();

    /**
     * Get data app
     */
    abstract public function getData();
        
    /**
     * Config app
     */
    public function config()
    {
        return null;
    }
}
