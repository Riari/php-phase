<?php

return [
    'connections' => [
        'default_mysql' => [
            'driver' => 'mysql',
            'host' => 'phase-mysql',
            'database' => 'phase',
            'username' => 'phase',
            'password' => 'secret'
        ]
    ],

    'default_connection' => 'default_mysql'
];