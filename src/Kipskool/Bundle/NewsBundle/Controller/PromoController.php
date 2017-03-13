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
 * @ParamConverter("promo", options={"mapping" : {"promo_id" : "id"})
 * @Route("/promo/")
 */
class PromoController extends Controller
{
    /**
     * Creates a new promo entity.
     *
     * @ParamConverter("ecole", options={"mapping":{"ecole_id":"id"}})
     * @Route("new_promo/ecole/{ecole_id}", name="promo_new")
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
                'promo_id' => $promo->getId()
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

    /**
     * Displays a form to edit an existing promo entity.
     *
     * @Route("{promo_id}/edit", name="promo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Promo $promo)
    {
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\PromoType', $promo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promo_show', array(
                'ecole_id' => $promo->getEcole()->getId(),
                'promo_id' => $promo->getId()
            ));
        }

        return $this->render('promo/edit.html.twig', array(
            'promo' => $promo,
            'ecole' =>$promo->getEcole(),
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a promo entity.
     *
     * @Route("{promo_id}/delete", name="promo_delete")
     * @Method("GET")
     */
    public function deleteAction(Promo $promo)
    {
        dump($promo);
            $em = $this->getDoctrine()->getManager();
            $em->remove($promo);
            $em->flush();


        return $this->redirectToRoute('ecole_show', array(
            'ecole_id'=> $promo->getEcole()->getId()
        ));
    }






}
