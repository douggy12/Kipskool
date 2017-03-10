<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Commentaire_article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Promo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commentaire_article_promo controller.
 *
 * @Route("ecole/promo")
 */
class Commentaire_article_promoController extends Controller
{
    /**
     * Displays a form to edit an existing commentaire_article_promo entity.
     *
     * @ParamConverter("Commentaire_article_promo", options={"mapping":{"commentaire_article_id":"id"}})
     * @ParamConverter("Article_promo", options={"mapping":{"article_id":"id"}})
     * @Route("/{id}/article/{article_promo_id}/comment/{commentaire_article_id}/edit", name="commentaire_article_promo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request,Promo $promo, Article_promo $article_promo, Commentaire_article_promo $commentaire_article_promo)
    {
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Commentaire_article_promoType', $commentaire_article_promo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_promo_show', array(
                'article_promo_id' => $commentaire_article_promo->getId(),
                'id'=>$promo->getId()
                ));
        }

        return $this->render('commentaire_article_promo/edit.html.twig', array(
            'promo'=>$promo,
            'article_promo'=>$article_promo,
            'commentaire_article_promo' => $commentaire_article_promo,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a commentaire_article_promo entity.
     *
     * @ParamConverter("Commentaire_article_promo", options={"mapping":{"commentaire_article_id":"id"}})
     * @ParamConverter("Article_promo", options={"mapping":{"article_id":"id"}})
     * @Route("/{id}/article/{article_promo_id}/comment/{commentaire_article_id}/delete", name="commentaire_delete")
     * @Method("GET")
     */
    public function deleteAction(Promo $promo, Article_promo $article_promo, Commentaire_article_promo $commentaire_article_promo)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaire_article_promo);
            $em->flush();

        return $this->redirectToRoute('article_promo_show', array(
            'article_promo_id'=>$article_promo->getId(),
            'id'=>$promo->getId()
        ));
    }

}
