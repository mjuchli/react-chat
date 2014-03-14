<?php

namespace cs176b\RatchetBundle\Controller;

use cs176b\RatchetBundle\Form\Type\ChatType;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return array();

    }

    /**
     * @Route("/yetAnotherForm", name="form_message_create")
     * @Template()
     */
    public function yetAnotherFormAction(Request $request)
    {
        $form = $this->createForm(new ChatType());

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $formData = $form->getData();

                $name = $formData['name'];
                $message = $formData['message'];

                $this->postToQueue(array($name, $message));

                $form = $this->createForm(new ChatType()); //clear form
            }

        }

        return array('form' => $form->createView());

    }

    /**
     * @Route("/post", name="message_create")
     * @Template()
     */
    public function postAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $name = $request->request->get('name');
            $message = $request->request->get('message');

            $this->postToQueue(array($name, $message));

            return new Response($name.': '.$message);
        }

        return new Response('no message');

    }

    private function postToQueue($message){
        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
        $socket->connect("tcp://localhost:5555");
        $socket->send(json_encode($message));
    }


}
