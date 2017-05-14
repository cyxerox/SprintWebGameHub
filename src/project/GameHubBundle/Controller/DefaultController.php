<?php

namespace project\GameHubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('projectGameHubBundle:Default:index.html.twig');
    }
}
