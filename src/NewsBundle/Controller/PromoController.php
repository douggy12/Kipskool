<?php

namespace NewsBundle\Controller;


use NewsBundle\Entity\Ecole;
use NewsBundle\Entity\Promo;
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
        return $this->render('ViewPromo/page_promo.html.twig', array(
            'promo' => $promo,
            'ecole' => $promo->getEcole(),
        ));
    }







}
