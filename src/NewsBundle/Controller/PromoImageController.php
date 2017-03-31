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
        $image1 = new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\jmqdl2016.jpg');

        $promos = $em->getRepository('NewsBundle:Promo')->findAll();

        foreach ($promos as $promo)
        {
            $promo->setAvatar($image1);
            $promo->setAvatarName('jmqdl2016.jpg');
            $em->persist($promo);
            $em->flush();
        }

        return new Response("loading OK !");
    }
}
