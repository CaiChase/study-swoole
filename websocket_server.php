<?php

$server = new swoole_websocket_server("0.0.0.0", 9501);

// 此处可以设置一些参数
// $server->set([]);

// 监听websocket链接打开事件,非必须
$server->on('open', 'onOpen');
function onOpen($server, $request)
{
    echo "onOpen-fd:".$request->fd;
}

// 监听websocket消息事件
$server->on('message', function (swoole_websocket_server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();
