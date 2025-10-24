<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Streaming Server Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for live streaming servers (RTMP, HLS, FLV)
    |
    */

    // HTTP-FLV streaming endpoint
    'flv_endpoint' => env('STREAMING_FLV_ENDPOINT', 'http://localhost:8080'),

    // HLS streaming endpoint
    'hls_endpoint' => env('STREAMING_HLS_ENDPOINT', 'http://localhost:8080'),

    // RTMP server for OBS
    'rtmp_server' => env('STREAMING_RTMP_SERVER', 'rtmp://localhost:1935/live'),

    // Streaming base path
    'stream_path' => env('STREAMING_PATH', '/live'),

];
