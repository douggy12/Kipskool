<?php

namespace NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AdvertController extends Controller
{
    /**
     * @Route("/test")


     */
    public function indexAction()
    {
        $image = $this->get('image.image');
        $text = '...';
        if($image->isSpam($text)){
            throw new \Exception('votre message est un spam!');
        }

    }
}
