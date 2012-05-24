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
                
                $this->_saveSubscriber($subscriber);
                
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('PlaygroundMainBundle_homepage'));
            }
        }

        return $this->render('PlaygroundMainBundle:Main:index.html.twig', array('form' => $form->createView(), 'errors' => $form->getErrors()));
    }

    private function _notifyMe(Subscriber $subscriber)
    {
        $notifyMeBody = $this->renderView('PlaygroundMainBundle:Main:notifyMeEmail.html.twig', array('subscriber' => $subscriber));
        $subscriberNotifBody = $this->renderView('PlaygroundMainBundle:Main:notifySubscriber.html.twig', array('subscriber' => $subscriber));

        $notifier = $this->get('playground_main.notification_sender');
        // notify me
        $notifier->send($this->get('mailer'), "New Subscriber", $notifyMeBody, 'info@nashlesigon.com');

        // notify the subscriber
        $notifier->send($this->get('mailer'), "Thank you for your subscription", $subscriberNotifBody, $subscriber->getEmailAddress());
    }

    private function _saveSubscriber(Subscriber $subscriber)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $emailValidator = $this->get('playground_main.custom_email_validator');
        if($emailValidator->isValid($subscriber->getEmailAddress(), $em))
        {
            $em->persist($subscriber);
            $em->flush();
            $this->get('session')->setFlash('notice', 'Thank you! I will let you know when this site is ready.');
            $this->_notifyMe($subscriber);
        }
        else 
        {
            $this->get('session')->setFlash('notice', 'The email address you provided has already subscribed to us.');
        }
    }
}