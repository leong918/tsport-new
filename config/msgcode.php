<?php

return [

    'response_status' => [
        // HTTP_INTERNAL_SERVER_ERROR
        '500' => [
            'ERROR' => 'Error encountered'
        ],
    
        // HTTP_OK
        '200' => [
            'OK' => 'Success',
            'USER_NOT_FOUND' => 'User not found',
        ],
    
        // HTTP_BAD_REQUEST
        '400' => [
            'INVALID_DATA_INPUT' => 'Invalid data pass to server',
            'VALIDATION_ERROR' => 'Validation error',
        ],
    
        // HTTP_UNAUTHORIZED
        '401' => [
    
        ],
    
        // HTTP_FORBIDDEN
        '403' => [
    
        ]
    ],
    'msg_code_name' => 'msg_code',
    'msg_name' => 'msg',

];
