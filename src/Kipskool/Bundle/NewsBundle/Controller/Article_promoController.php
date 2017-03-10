<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Commentaire_article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Promo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Article_promo controller.
 *
 * @Route("article_promo")
 */
class Article_promoController extends Controller
{
    /**
     * Creates a new article_promo entity.
     *
     * @Route("/{id}/new", name="addArticlePromo")
     * @Method({"GET", "POST"})
     */
    public function newArtcicleAction(Request $request, Promo $promo)
    {
        $article_promo = new Article_promo();
        $article_promo->setPromo($promo);
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Article_promoType', $article_promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article_promo);
            $em->flush($article_promo);

            return $this->redirectToRoute('promo_show', array('id' => $promo->getId()));
        }

        return $this->render('article_promo/new.html.twig', array(
            'article_promo' => $article_promo,
            'promo'=>$promo,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a article_promo entity.
     *
     * @ParamConverter("articlePromo", options={"mapping":{"articlepromo_id":"id"}})
     * @Route("/{id}/article/{articlepromo_id}", name="articlePromoShow")
     * @Method({"GET", "POST"})
     */
    public function showArticleAction(Request $request, Promo $promo, Article_promo $articlePromo)
    {
        $commentaire_article_promo = new Commentaire_article_promo();
        $commentaire_article_promo->setArticlePromo($articlePromo);
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Commentaire_article_promoType', $commentaire_article_promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire_article_promo);
            $em->flush($commentaire_article_promo);

            return $this->redirectToRoute('articlePromoShow', array(
                'id'=>$promo->getId(),
                'articlepromo_id' => $articlePromo->getId()
            ));
        }

        return $this->render('article_promo/show.html.twig', array(
            'articlePromo' => $articlePromo,
            'promo'=>$promo,
            'commentaire_article_promo' => $commentaire_article_promo,
            'form' => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing article_promo entity.
     *
     * @ParamConverter("articlePromo", options={"mapping":{"articlepromo_id":"id"}})
     * @Route("/{id}/article/{articlepromo_id}/edit", name="articlePromoEdit")
     * @Method({"GET", "POST"})
     */
    public function editArticleAction(Request $request, Promo $promo, Article_promo $articlePromo)
    {
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Article_promoType', $articlePromo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promo_show', array('id' => $promo->getId()));
        }

        return $this->render('article_promo/edit.html.twig', array(
            'articlePromo' => $articlePromo,
            'promo'=>$promo,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a article_promo entity.
     *
     * @ParamConverter("articlePromo", options={"mapping":{"article_promo_id":"id"}})
     * @Route("/{id}/article/{article_promo_id}/delete", name="article_promo_delete")
     * @Method("GET")
     */
    public function deleteAction(Promo $promo, Article_promo $article_promo)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article_promo);
            $em->flush();

        return $this->redirectToRoute('promo_show', array('id' => $promo->getId()));
    }

}
