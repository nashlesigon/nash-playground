<?php

namespace Playground\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Playground\MainBundle\Entity\Subscriber;
use Playground\MainBundle\Form\SubscriberType;

class MainController extends Controller
{
    public function indexAction()
    {
        $subscriber = new Subscriber();
        $form = $this->createForm(new SubscriberType(), $subscriber);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $now = new \DateTime("now");
                $subscriber->setDateAdded($now);
                
                $em = $this->getDoctrine()->getEntityManager();
                
                $emailValidator = $this->get('playground_main.custom_email_validator');
                if($emailValidator->isValid($subscriber->getEmailAddress(), $em))
                {
                    $em->persist($subscriber);
                    $em->flush();
                    $this->get('session')->setFlash('notice', 'Thank you! I will let you know when this site is ready.');
                }
                else 
                {
                    $this->get('session')->setFlash('notice', 'The email address you provided has already subscribed to us.');
                }
                
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('PlaygroundMainBundle_homepage'));
            }

            // var_dump($form->getErrors());
            // exit;
        }

        return $this->render('PlaygroundMainBundle:Main:index.html.twig', array('form' => $form->createView(), 'errors' => $form->getErrors()));
    }


}