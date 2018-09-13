<?php

// 连接swoole tcp服务
$client = new swoole_client(SWOOLE_SOCK_TCP);

if (!$client->connect('127.0.0.1', 9501))
{
    exit('连接失败');
}

// php cli常量
fwrite(STDOUT, '请输入：');
$msg = trim(fgets(STDIN));

// 发送消息到tcp_server
$client->send($msg);

// 接收tcp_server返回的数据
$result = $client->recv();
echo $result. "\n";
