<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Kipskool\Bundle\NewsBundle\Entity\Promo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Promo controller.
 *
 * @Route("/")
 */
class PromoController extends Controller
{
    /**
     * Creates a new promo entity.
     *
     * @ParamConverter("ecole", options={"mapping":{"ecole_id":"id"}})
     * @Route("ecole/{ecole_id}/promo/new", name="promo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Ecole $ecole)
    {
        $promo = new Promo();
        $promo->setEcole($ecole);
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\PromoType', $promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($promo);
            $em->flush($promo);

            return $this->redirectToRoute('promo_show', array(
                'ecole_id'=>$ecole->getId(),
                'id' => $promo->getId()
                ));
        }

        return $this->render('promo/new.html.twig', array(
            'ecole' => $ecole,
            'promo' => $promo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a promo entity.
     *
     * @ParamConverter("ecole", options={"mapping":{"ecole_id":"id"}})
     * @Route("ecole/{ecole_id}/promo/{id}", name="promo_show")
     * @Method("GET")
     */
    public function showAction(Ecole $ecole, Promo $promo)
    {
        return $this->render('promo/show.html.twig', array(
            'promo' => $promo,
            'ecole' => $ecole,
        ));
    }

    /**
     * Displays a form to edit an existing promo entity.
     *
     * @ParamConverter("ecole", options={"mapping":{"ecole_id":"id"}})
     * @Route("ecole/{ecole_id}/promo/{id}/edit", name="promo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Promo $promo, Ecole $ecole)
    {
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\PromoType', $promo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promo_show', array(
                'ecole_id' => $ecole->getId(),
                'id' => $promo->getId()
            ));
        }

        return $this->render('promo/edit.html.twig', array(
            'promo' => $promo,
            'ecole' =>$ecole,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a promo entity.
     *
     * @ParamConverter("ecole", options={"mapping":{"ecole_id":"id"}})
     * @Route("ecole/{ecole_id}/promo/{id}/delete", name="promo_delete")
     * @Method("GET")
     */
    public function deleteAction(Ecole $ecole, Promo $promo)
    {
        dump($promo);
            $em = $this->getDoctrine()->getManager();
            $em->remove($promo);
            $em->flush();


        return $this->redirectToRoute('ecole_show', array(
            'id'=> $ecole->getId()
        ));
    }






}
