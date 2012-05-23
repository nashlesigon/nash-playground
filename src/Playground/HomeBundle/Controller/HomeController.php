<?php

namespace Playground\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomeController extends Controller
{
    public function indexAction()
    {
        if(in_array($this->get('kernel')->getEnvironment(), array('test', 'dev'))) {
            return $this->render('PlaygroundHomeBundle:Home:index.html.twig');
        }

        return $this->redirect($this->generateUrl('PlaygroundMainBundle_homepage'));
        
    }
}