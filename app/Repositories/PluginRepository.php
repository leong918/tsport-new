<?php

namespace App\Repositories;

use App\Models\Plugin;
use Illuminate\Support\Facades\Storage;
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

                $configGroup = $config['configGroup'] ?? '';
                $configKey = $config['configKey'] ?? '';

                //Process if plugin config incorect
                if (!$configGroup || !$configKey) {
                    File::deleteDirectory(storage_path('tmp/' . $pathTemp));
                    return redirect()->back()->with('error', 'Error! Config format wrong.');
                }

                //Check plugin exist
                $pluginExist = Plugin::where('config_key', $configKey)->first();
                if ($pluginExist) {
                    File::deleteDirectory(storage_path('tmp/'.$pathTemp));
                    return redirect()->back()->with('error', 'Error! Plugin installed before.');
                }

                $pathPlugin = $configGroup . '/' . $configKey;

                //Valication Done
                try {
                    //Copy Directory from temporary path to real path
                    File::copyDirectory(storage_path('tmp/'.$pathTemp.'/'.$folderName.'/public'), public_path($pathPlugin));
                    File::copyDirectory(storage_path('tmp/'.$pathTemp.'/'.$folderName), app_path($pathPlugin));
                    File::deleteDirectory(storage_path('tmp/'.$pathTemp));

                    $configNamespace = getPluginNamespace($configKey) . '\AppConfig';
                    $response = (new $configNamespace)->install();
                    if (!is_array($response) || $response['error'] == 1) {
                        return redirect()->back()->with('error', $response['msg']);
                    }
                } catch (\Throwable $e) {
                    File::deleteDirectory(storage_path('tmp/'.$pathTemp));
                    return redirect()->back()->with('error', $e->getMessage());
                }
            } else {
                File::deleteDirectory(storage_path('tmp/'.$pathTemp));
                return redirect()->back()->with('error', 'Error! Config file not exist.');
            }
        } else {
            return redirect()->back()->with('error', 'Error! Plugin failed to unzip.');
        }

        $data = new Plugin();
        $data->key = $configKey;
        $data->group = $configGroup;
        $data->save();

        return redirect()->back()->with('success', 'Plugin Installed Successfully!');
    }

    private function uploadLocalFile($file, $filePath)
    {
        $fileName = $file->getClientOriginalName();
        return Storage::putFileAs($filePath, $file, $fileName, 'public');
    }
}
