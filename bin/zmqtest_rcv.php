<?php
$context = new ZMQContext(1);
// クライアントとの通信ソケット
$responder = new ZMQSocket($context, ZMQ::SOCKET_REP);
$responder->bind("tcp://*:5555");
while (true) {
// クライアントカアラのリクエストを待機
$request = $responder->recv();
printf ("Received request: [%s]\n", $request);
// 何らかの処理
sleep (1);
// クライアントに応答
$responder->send("World");
}