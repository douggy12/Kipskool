<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Commentaire_article_promo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commentaire_article_promo controller.
 *
 * @Route("commentaire_article_promo")
 */
class Commentaire_article_promoController extends Controller
{
    /**
     * Displays a form to edit an existing commentaire_article_promo entity.
     *
     * @Route("/{id}/edit", name="commentaire_article_promo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Commentaire_article_promo $commentaire_article_promo)
    {
        $deleteForm = $this->createDeleteForm($commentaire_article_promo);
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Commentaire_article_promoType', $commentaire_article_promo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentaire_article_promo_edit', array('id' => $commentaire_article_promo->getId()));
        }

        return $this->render('commentaire_article_promo/edit.html.twig', array(
            'commentaire_article_promo' => $commentaire_article_promo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentaire_article_promo entity.
     *
     * @Route("/{id}", name="commentaire_article_promo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Commentaire_article_promo $commentaire_article_promo)
    {
        $form = $this->createDeleteForm($commentaire_article_promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaire_article_promo);
            $em->flush();
        }

        return $this->redirectToRoute('commentaire_article_promo_index');
    }

    /**
     * Creates a form to delete a commentaire_article_promo entity.
     *
     * @param Commentaire_article_promo $commentaire_article_promo The commentaire_article_promo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commentaire_article_promo $commentaire_article_promo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentaire_article_promo_delete', array('id' => $commentaire_article_promo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
