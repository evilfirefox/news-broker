<?php

namespace Vague\NewsBrokerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VagueNewsBrokerBundle:Default:index.html.twig', array());
    }
}
