<?php

namespace Playground\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Playground\MainBundle\Form\SubscriberType;

class MainController extends Controller
{
    public function indexAction()
    {
        $form = $this->get('form.factory')->create(new SubscriberType());;
        // $form = $this->createForm(new SubscriberType(), $subscriber);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('PlaygroundMainBundle_homepage'));
            }
        }

        return $this->render('PlaygroundMainBundle:Main:index.html.twig', array('form' => $form->createView()));
    }

    public function subscribeAction()
    {

    }
}