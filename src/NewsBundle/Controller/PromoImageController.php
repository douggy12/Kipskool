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
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\jmqdl2016.jpg'),
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\IT Start LM 01 2016.jpg'),
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\CDPN LM 02 2016.jpg'),
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\adm2016.jpg'),
            new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\Staff.jpg'),

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
