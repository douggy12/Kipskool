<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="Home")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}
