<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Commentaire_article_promo;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commentaire_article_promo controller.
 * @ParamConverter("commentaire_article_promo", options={"mapping" : {"commentaire_article_promo_id" : "id"}})
 * @Route("promo_comment")
 */
class Commentaire_article_promoController extends Controller
{
    /**
     * Displays a form to edit an existing commentaire_article_promo entity.
     *
     * @Route("/{commentaire_article_promo_id}/edit", name="commentaire_article_promo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Commentaire_article_promo $commentaire_article_promo)
    {

        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Commentaire_article_promoType', $commentaire_article_promo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_promo_show', array(
                'promo_id'=>$commentaire_article_promo->getArticlePromo()->getPromo()->getId(),
                'article_promo_id' => $commentaire_article_promo->getArticlePromo()->getId(),
                ));
        }

        return $this->render('commentaire_article_promo/edit.html.twig', array(
            'promo'=>$commentaire_article_promo->getArticlePromo()->getPromo(),
            'article_promo'=>$commentaire_article_promo->getArticlePromo(),
            'commentaire_article_promo' => $commentaire_article_promo,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a commentaire_article_promo entity.
     *
     * @Route("/{commentaire_article_promo_id}/delete", name="commentaire_delete")
     * @Method("GET")
     */
    public function deleteAction(Commentaire_article_promo $commentaire_article_promo)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaire_article_promo);
            $em->flush();

        return $this->redirectToRoute('article_promo_show', array(
            'promo_id'=>$commentaire_article_promo->getArticlePromo()->getPromo()->getId(),
            'article_promo_id'=>$commentaire_article_promo->getArticlePromo()->getId()
        ));
    }

}
