<?php

use Illuminate\Support\Str;
use App\Models\Plugin;

/**
 * Only applied for CONST status get from model
 *
 * @param array $const_array
 *
 * @return array
 */
function renderSelect(array $const_array): array
{
    $const_array = array_flip($const_array);
    foreach ($const_array as $key => $value) {
        $const_array[$key] = $value;
    }
    return $const_array;
}

function renderModelData(array $const_array, string $array_value)
{
    $const_array = array_flip($const_array);
    return $const_array[$array_value];
}

function filter($data)
{
    return ($data !== null);
}

function getPublicIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    $ip = $remote;
    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    }

    return $ip;
}

function unzipFile(string $pathToSource, string $pathSaveTo)
{
    $zip = new \ZipArchive();
    if ($zip->open(str_replace("//", "/", $pathToSource)) === true) {
        $zip->extractTo($pathSaveTo);
        return $zip->close();
    }
    return false;
}

function getPluginNamespace(string $key)
{
    $key = Str::camel($key);
    $key = ucfirst($key);

    return '\App\Plugins\\' . $key;
}

function checkExistPlugin(string $key)
{
    return Plugin::where('key', $key)->first();
}

function formalizeDropdown($data, $key, $value, $subValue = null)
{
    $result = [];
    for ($i = 0; $i < count($data); $i++) {
        if ($subValue) {
            $result[$data[$i]->$key] = $data[$i]->$value . ' (' . $data[$i]->$subValue . ')';
        } else {
            $result[$data[$i]->$key] = $data[$i]->$value;
        }
    }
    return $result;
}

function generateRandomString($length = 10, $number_only = null)
{
    if (!$number_only)
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    else
        $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
