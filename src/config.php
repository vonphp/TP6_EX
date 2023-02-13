<?php
return [
    'JRedis'  => [
        'scheme'   => 'tcp',
        'host'     => env('CACHE.host', '127.0.0.1'),
        'port'     => env('CACHE.port', '6379'),
        'auth' => env('CACHE.password', ''),
        'database'     => env('CACHE.select', 1),
    ],
    'ApiSign' => [
        'timeReduce' => 115, // 时间误差，如果超出误差，签名失效
    ],
    'Upload'  => [
        'sdk_ver'    => '7.6.0',
        'block_size' => 4194304, //4*1024*1024 分块上传块大小，该参数为接口规格，不能修改
        'up_host'    => 'http://attatch.c.jiaodong.cn/jd_attatch_serv/public/index.php/api/',
    ],
    'JwtS' => [],
    'FastDfs' => [
        'baseUrl' => env('DFS.baseUrl', 'http://uploads.c.jiaodong.cn/'),     //服务器基地址
    ]
];