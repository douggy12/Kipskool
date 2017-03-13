<?php

namespace Kipskool\Bundle\NewsBundle\Controller;


use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Ecole controller.
 * @ParamConverter("ecole", options={"mapping" : {"ecole_id" : "id"})
 * @Route("ecole")
 */
class EcoleController extends Controller
{
    /**
     * Lists all ecole entities.
     *
     * @Route("/", name="ecole_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ecoles = $em->getRepository('NewsBundle:Ecole')->findAll();

        return $this->render('ecole/index.html.twig', array(
            'ecoles' => $ecoles,
        ));
    }

    /**
     * Finds and displays a ecole entity.
     *
     * @Route("/{ecole_id}", name="ecole_show")
     * @Method("GET")
     */
    public function showAction(Ecole $ecole)
    {


        return $this->render('ecole/show.html.twig', array(
            'ecole' => $ecole,

        ));
    }


}
