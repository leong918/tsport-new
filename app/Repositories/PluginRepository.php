<?php

namespace App\Repositories;

use App\Models\Plugin;
use Illuminate\Support\Facades\File;

class PluginRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     */
    public function model()
    {
        return Plugin::class;
    }

    public function installPlugin($plugin)
    {
        $pathTemp = time();
        $pathFile = $this->uploadLocalFile($plugin, $pathTemp);
        $unzip = unzipFile(storage_path('tmp/' . $pathFile), storage_path('tmp/' . $pathTemp));

        if ($unzip) {
            // to check config.json exist or not
            $checkConfig = glob(storage_path('tmp/' . $pathTemp) . '/*/config.json');

            if ($checkConfig) {
                $folderName = explode('/config.json', $checkConfig[0]);
                $folderName = explode('/', $folderName[0]);
                $folderName = end($folderName);

                $config = json_decode(file_get_contents($checkConfig[0]), true);
                $configGroup = $config['configGroup'] ?? '';
                $configKey = $config['configKey'] ?? '';

                //Process if plugin config incorect
                if (!$configGroup || !$configKey) {
                    File::deleteDirectory(storage_path('tmp/' . $pathTemp));
                    throw new \Exception('Error! Config format wrong.');
                }

                //Check plugin exist
                $pluginExist = Plugin::where('key', $configKey)->first();
                if ($pluginExist) {
                    File::deleteDirectory(storage_path('tmp/'.$pathTemp));
                    throw new \Exception('Error! Plugin exist.');
                }

                $pathPlugin = $configGroup . '/' . $configKey;

                //Validation Done
                try {
                    //Copy Directory from temporary path to real path
                    File::copyDirectory(storage_path('tmp/'.$pathTemp.'/'.$folderName.'/public'), public_path($pathPlugin));
                    File::copyDirectory(storage_path('tmp/'.$pathTemp.'/'.$folderName), app_path($pathPlugin));
                    File::deleteDirectory(storage_path('tmp/'.$pathTemp));

                    $configNamespace = getPluginNamespace($configKey) . '\AppConfig';
                    (new $configNamespace)->install();
                } catch (\Throwable $e) {
                    File::deleteDirectory(storage_path('tmp/'.$pathTemp));
                    throw new \Exception($e->getMessage());
                }
            } else {
                File::deleteDirectory(storage_path('tmp/'.$pathTemp));
                throw new \Exception('Error! Config file not exist.');
            }
        } else {
            throw new \Exception('Error! Plugin failed to unzip.');
        }

        throw new \Exception('Plugin Installed Successfully!');
    }

    private function uploadLocalFile($file, $filePath)
    {
        $fileName = $file->getClientOriginalName();
        return $file->storeAs($filePath, $fileName, 'tmp');
    }

    public function getActivePlugin($key)
    {
        return Plugin::where('key', $key)->first();
    }

    public function getListing()
    {
        return Plugin::query()->orderBy('created_at', 'desc');
    }

    public function deleteById($id)
    {
        $plugin = Plugin::find($id);

        $configNamespace = getPluginNamespace($plugin->key) . '\AppConfig';
        (new $configNamespace)->uninstall();

        $pathPlugin = $plugin->group . '/' . $plugin->key;
        File::deleteDirectory(public_path($pathPlugin));
        File::deleteDirectory(app_path($pathPlugin));

        $plugin->delete();
    }
}
