<?php

namespace cs176b\RatchetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use cs176b\RatchetBundle\Chat\RatchetChat as Chat;

class DefaultController
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {


        return array('name' => 'name');
    }
}
