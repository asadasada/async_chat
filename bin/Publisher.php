<?php
require dirname(__DIR__) . '/vendor/autoload.php';
use Thruway\ClientSession;
use Thruway\Peer\Client;
use Thruway\Transport\PawlTransportProvider;
use Thruway\Connection;
use React\ZMQ\Context;

/**
*$pull->on
*@param Array $entryData
*/
$loop = \React\EventLoop\Factory::create();
$client = new Client('realm1', $loop);
$client->addTransportProvider(new PawlTransportProvider('ws://127.0.0.1:9090'));
$context = new React\ZMQ\Context($loop);
$pull = $context->getSocket(ZMQ::SOCKET_PULL);
$pull->bind('tcp://127.0.0.1:9101');
$loop->addPeriodicTimer(0.5, function () use ($client,$pull) {
   $session = $client->getSession();
   $loop = $client->getLoop();
   if ($session && ($session->getState() == \Thruway\ClientSession::STATE_UP)) {
    $pull->on('message',function(){echo "aho\n";});
    // $pull->on('message', function($entryData)use($session){$session->publish('com.myapp.message',$entryData, [], ["acknowledge" => false]);});
}
});
$client->start();