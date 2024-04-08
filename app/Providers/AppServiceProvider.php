<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Alert;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // dynamic initiate alias based on model files
        $loader = AliasLoader::getInstance();
        $models = $this->getAllModels();
        foreach ($models as $model) {
            $loader->alias($model, "\App\Models\\${model}");
        }

        // define component in blade
        Blade::component('alert', Alert::class);

        // load plugin provider
        try {
            foreach (glob(app_path() . '/Plugins/*/Provider.php') as $filename) {
                require_once $filename;
            }
        } catch (\Throwable $e) {
            $msg = 'Message: ' . $e->getMessage() . ' - Line: ' . $e->getLine() . ' - File: ' . $e->getFile();
            echo $msg;
            exit;
        }
    }

    private function getAllModels()
    {
        $path = app_path() . '/Models';
        return $this->getModels($path);
    }

    private function getModels($path)
    {
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') {
                continue;
            }
            $filename = $path . '/' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, $this->getModels($filename));
            } else {
                $out[] = basename(substr($filename, 0, -4));
            }
        }
        return $out;
    }
}
