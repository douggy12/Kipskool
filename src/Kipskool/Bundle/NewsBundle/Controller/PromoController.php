<?php

namespace Kipskool\Bundle\NewsBundle\Controller;


use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Kipskool\Bundle\NewsBundle\Entity\Promo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Promo controller.
 * @ParamConverter("promo", options={"mapping" : {"promo_id" : "id"}})
 * @Route("/promo/")
 */
class PromoController extends Controller
{

    /**
     * Finds and displays a promo entity.
     *
     * @Route("{promo_id}", name="promo_show")
     * @Method("GET")
     */
    public function showAction(Promo $promo)
    {
        return $this->render('promo/show.html.twig', array(
            'promo' => $promo,
            'ecole' => $promo->getEcole(),
        ));
    }







}
