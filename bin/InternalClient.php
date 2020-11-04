<?php
require dirname(__DIR__) . '/vendor/autoload.php';

class InternalClient extends Thruway\Peer\Client
{
     public function __construct()
    {
        parent::__construct("realm1");
    }

    public function onSessionStart($session, $transport)
    {
         echo "--------------- Hello from InternalClient ------------\n";
        $session->register('com.example.getphpversion', [$this, 'getPhpVersion']);
    }

    public function getPhpVersion()
    {
        return [phpversion()];
    }
}
