<?php
return [
    'JRedis'  => [
        'scheme'   => 'tcp',
        'host'     => env('CACHE.host', '127.0.0.1'),
        'port'     => env('CACHE.port', '6379'),
        'user'     => env('CACHE.USERNAME', 'root'),
        'auth'     => env('CACHE.password', ''),
        'database' => env('CACHE.select', 1),
        'version'  => env('CACHE.version', 3),
    ],
    'ApiSign' => [
        'timeReduce' => 115, // 时间误差，如果超出误差，签名失效
    ],
    'JwtS'    => [
        'nbf'      => env('jwt.nbf', 0),
        'exp_time' => env('jwt.exp_time', 7200),
        'key'      => env('jwt.KEY', '2XkKZqeqeyZ0mVW'),
        'alg'      => env('jwt.alg', 'HS256'),
    ],
    'FastDfs' => [
        'baseUrl' => env('DFS.baseUrl', 'http://uploads.c.jiaodong.cn/'),     //服务器基地址
    ],
    'Aws'     => [
        'BUCKET'                  => env('BUCKET', 'yanhuorongmei'),
        'version'                 => env('BUCKET', 'latest'),
        'region'                  => env('AWS_REGION', 'cn-north-1'),
        'endpoint'                => env('AWS_ENDPOINT', 'http://192.168.10.7:9001'),
        'use_path_style_endpoint' => env('use_path_style_endpoint', true),
        'credentials'             => [
            'key'    => env('AWS_KEY', 'BWYGJIHPd9E8Pvub'),
            'secret' => env('AWS_SECRET', 'K8Kukjfa9JIG5mTUrqMIcNzOD6pDgUcE'),
        ],
        // You can override settings for specific services
        'Ses'                     => [
            'region' => env('AWS_SES_REGION', 'cn-north-1'),
        ],
    ],
];