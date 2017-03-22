<?php

use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' => [
                    'host'     => 'http://localhost:8888/phpmyadmin/',
                    'user'     => 'root',
                    'password' => 'liuruogu',
                    'dbname'   => 'Restaurant',
                ]
            ],
        ],
    ],
];