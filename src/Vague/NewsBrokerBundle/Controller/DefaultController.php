<?php

namespace Vague\NewsBrokerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VagueNewsBrokerBundle:Default:index.html.twig', array());
    }

    public function rssAction($key)
    {
        $broker = $this->get('nwb.service.broker');
        $result = $broker->process($key);
        return $this->render('VagueNewsBrokerBundle:Default:rss.html.twig', array('data' => $result,));
    }
}
