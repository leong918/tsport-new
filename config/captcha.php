<?php

return [
    'characters' => [
        '1', '2', '3', '4', '6', '7', '8', '9',
    ],
    'default' => [
        'length' => 9,
        'width' => 120,
        'height' => 50,
        'quality' => 90,
        'math' => false,
        'expire' => 60,
        'encrypt' => false,
    ],
    'math' => [
        'length' => 9,
        'width' => 120,
        'height' => 50,
        'quality' => 90,
        'math' => true,
    ],

    'flat' => [
        'length' => 4,
        'width' => 160,
        'height' => 50,
        'quality' => 50,
        'lines' => -1,
        'bgImage' => false,
        'bgColor' => '#ABD5D6',
        'fontColors' => ['#084080'],
        'contrast' => 0,
    ],
    'mini' => [
        'length' => 3,
        'width' => 60,
        'height' => 32,
    ],
    'inverse' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'sensitive' => true,
        'angle' => 12,
        'sharpen' => 10,
        'blur' => 2,
        'invert' => true,
        'contrast' => -5,
    ]
];
