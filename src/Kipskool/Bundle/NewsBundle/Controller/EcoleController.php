<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\articleEcole;
use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ecole controller.
 *
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
     * @Route("/{id}", name="ecole_show")
     * @Method("GET")
     */
    public function showAction(Ecole $ecole)
    {


        return $this->render('ecole/show.html.twig', array(
            'ecole' => $ecole,

        ));
    }
    /**
     * Creates a new articleEcole entity for the active ecole.
     *
     * @Route("/{id}/new", name="addArticle")
     * @Method({"GET", "POST"})
     */
    public function addArticle(Request $request, Ecole $ecole)
    {
        $articleEcole = new articleEcole();
        $articleEcole->setEcole($ecole);

        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\articleEcoleType', $articleEcole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articleEcole);
            $em->flush($articleEcole);

            return $this->redirectToRoute('ecole_show', array('id' => $ecole->getId()));
        }

        return $this->render('articleecole/new.html.twig', array(
            'articleEcole' => $articleEcole,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a articleEcole entity.
     *
     * @ParamConverter("articleEcole", options={"mapping": {"article_id": "id"}})

     * @Route("/{id}/article/{article_id}", name="articleecole_show")
     * @Method("GET")
     *
     */
    public function showArticle( Ecole $ecole, articleEcole $articleEcole)
    {


        return $this->render('articleecole/show.html.twig', array(
            'articleEcole' => $articleEcole,
            'ecole' => $ecole,

        ));
    }

}
