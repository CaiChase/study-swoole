<?php

// 0.0.0.0 表示监听所有
$http = new swoole_http_server("0.0.0.0", 8080);

// 访问静态资源地址，类似nginx的反向代理
$http->ser([
    'enable_statis_handler' => true,
    'document_root' => "/data/www/swoole/static", //静态资源的存放路径
]);

$http->on('request', function ($request, $response) {
    // 获取请求数据
    $param = json_encode($request->get);
    // 设置响应头，cookie等，使用$response方法,如 $response->cookie();
    $response->end("<h1>Hello Swoole. http_server. #".$param."</h1><br>");
});
$http->start();
