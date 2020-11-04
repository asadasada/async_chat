<?php
require dirname(__DIR__) . '/vendor/autoload.php';
$port = 8080;
$router = new Router();

$router->registerModule(new RatchetTransportProvider("127.0.0.1", $port));

// common realm ( realm1 )
$router->registerModule(
    new InternalClient()
);
$router->start();