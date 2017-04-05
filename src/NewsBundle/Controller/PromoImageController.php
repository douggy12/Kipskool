<?php

namespace NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromoImageController extends Controller
{
    /**
     * @Route("loadpromoimage")
     */
    public function load()
    {
        $em = $this->getDoctrine()->getManager();
        $imagePool = array(
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\promo1.jpg'),
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\promo3.jpg'),
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\promo2.jpg'),
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\promo5.jpg'),
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\promo4.jpg'),

        );

        $promos = $em->getRepository('NewsBundle:Promo')->findAll();

        foreach ($promos as $id => $promo) {
            $promo->setAvatar($imagePool[$id]);
            $promo->setAvatarName($imagePool[$id]->getFilename());


        }
        $em->flush();

        return new Response("loading OK !");
    }
}
