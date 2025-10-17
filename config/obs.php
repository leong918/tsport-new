<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OBS Streaming Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options for OBS streaming integration
    |
    */

    // Default OBS server URL
    'server_url' => env('OBS_SERVER_URL', null), // Will be generated dynamically if null

    // OBS WebSocket connection settings
    'websocket' => [
        'host' => env('OBS_WEBSOCKET_HOST', 'localhost'),
        'port' => env('OBS_WEBSOCKET_PORT', 4444),
        'password' => env('OBS_WEBSOCKET_PASSWORD', ''),
    ],

    // Stream quality presets
    'quality_presets' => [
        'low' => [
            'resolution' => '854x480',
            'fps' => 30,
            'bitrate' => 1000,
        ],
        'medium' => [
            'resolution' => '1280x720',
            'fps' => 30,
            'bitrate' => 2500,
        ],
        'high' => [
            'resolution' => '1920x1080',
            'fps' => 60,
            'bitrate' => 6000,
        ],
    ],

    // Default scene configuration
    'default_scene' => [
        'name' => 'Live Match Scene',
        'sources' => [
            [
                'name' => 'Match Video',
                'type' => 'ffmpeg_source',
                'settings' => []
            ],
            [
                'name' => 'Match Overlay',
                'type' => 'image_source',
                'settings' => []
            ]
        ]
    ],

    // RTMP stream settings
    'rtmp' => [
        'application' => env('RTMP_APPLICATION', 'live'),
        'allow_play' => true,
        'live' => true,
        'meta' => true,
    ],

    // Recording settings
    'recording' => [
        'enabled' => env('OBS_RECORDING_ENABLED', false),
        'format' => env('OBS_RECORDING_FORMAT', 'mp4'),
        'quality' => env('OBS_RECORDING_QUALITY', 'high'),
        'path' => env('OBS_RECORDING_PATH', storage_path('app/recordings')),
    ],

    // Stream authentication
    'auth' => [
        'required' => env('OBS_AUTH_REQUIRED', false),
        'secret_key' => env('OBS_AUTH_SECRET', ''),
    ],

    // Stream monitoring
    'monitoring' => [
        'health_check_interval' => 30, // seconds
        'max_reconnect_attempts' => 5,
        'viewer_count_update_interval' => 10, // seconds
    ],

    // Supported output formats
    'output_formats' => [
        'hls' => [
            'enabled' => true,
            'segment_duration' => 4,
            'playlist_length' => 5,
        ],
        'dash' => [
            'enabled' => false,
            'segment_duration' => 4,
        ],
        'rtmp' => [
            'enabled' => true,
        ],
    ],
];
