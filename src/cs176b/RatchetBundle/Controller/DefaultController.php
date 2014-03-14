<?php

namespace cs176b\RatchetBundle\Controller;

use cs176b\RatchetBundle\Form\Type\ChatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use cs176b\RatchetBundle\Chat\RatchetChat as Chat;
use \ZMQContext;
use \ZMQ;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new ChatType());

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                $context = new ZMQContext();
                $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
                $socket->connect("tcp://localhost:5555");

                $socket->send(json_encode($form->getData()));

                $form = $this->createForm(new ChatType()); //clear form
            }

        }

        return array('form' => $form->createView());

    }

    /**
     * @Route("/test")
     * @Template()
     */
    public function testAction()
    {
        return array('test' => 'test');

    }
}
