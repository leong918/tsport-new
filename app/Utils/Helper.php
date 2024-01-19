<?php

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
        $const_array[$key] = __('constant.'.$value);
    }
    return $const_array;
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
