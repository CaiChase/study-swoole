<?php

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9501); 

// 设置参数
$serv->set([
    'worker_num' => 1, // worker进程数
    'max_request' => 1000, // 支持最大请求数量
]);

/*
 * 监听连接进入事件
 * $fd  客户端连接的唯一标识
 * $reactor_id 线程id
 */
$serv->on('connect', function ($serv, $fd, $from_id) {  
    echo "Client: Connect. fd-{$fd}, reactor_id-{$from_id}\n";
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: form-{$from_id},fd-{$fd},".$data);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start(); 
