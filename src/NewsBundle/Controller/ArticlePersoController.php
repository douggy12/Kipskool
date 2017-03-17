<?php

namespace NewsBundle\Controller;

use NewsBundle\Entity\ArticlePerso;
use NewsBundle\Entity\CommentaireArticlePerso;
use NewsBundle\Entity\Perso;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Articleperso controller.
 * @ParamConverter("articlePerso", options={"mapping": {"article_perso_id" : "id"}})
 * @Route("article_perso")
 */
class ArticlePersoController extends Controller
{

    /**
     * Creates a new articlePerso entity.
     * @ParamConverter("perso", options={"mapping" : {"perso_id" : "id"}})
     * @Route("/article_perso_new/perso/{perso_id}", name="articleperso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Perso $perso)
    {
        $articlePerso = new ArticlePerso();
        $articlePerso->setPerso($perso);
        $articlePerso->setAuteur($this->getUser());
        $form = $this->createForm('NewsBundle\Form\ArticlePersoType', $articlePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articlePerso);
            $em->flush($articlePerso);

            return $this->redirectToRoute('perso_show', array('perso_id' => $perso->getId()));
        }

        return $this->render('articleperso/new.html.twig', array(
            'perso' => $perso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a articlePerso entity.
     *
     * @Route("/{article_perso_id}", name="articleperso_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, ArticlePerso $articlePerso)
    {
        $commentaireArticlePerso = new CommentaireArticlePerso();
        $commentaireArticlePerso->setArticle($articlePerso);
        $form = $this->createForm('NewsBundle\Form\CommentaireArticlePersoType', $commentaireArticlePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaireArticlePerso);
            $em->flush($commentaireArticlePerso);

            return $this->redirectToRoute('articleperso_show', array(
                'id_perso' => $articlePerso->getPerso()->getId(),
                'article_perso_id' => $articlePerso->getId()
            ));
        }

        return $this->render('articleperso/show.html.twig', array(
            'article' => $articlePerso,
            'perso' => $articlePerso->getPerso(),
            'commentaireArticlePerso' => $commentaireArticlePerso,
            'edit_form' => $form->createView(),

        ));
    }

    /**
     * Displays a form to edit an existing articlePerso entity.
     *

     * @Route("/{article_perso_id}/edit", name="articleperso_edit")
     *
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ArticlePerso $articlePerso)
    {

        $editForm = $this->createForm('NewsBundle\Form\ArticlePersoType', $articlePerso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articleperso_show', array('article_perso_id' => $articlePerso->getId()));
        }

        return $this->render('articleperso/edit.html.twig', array(
            'article' => $articlePerso,
            'perso' => $articlePerso->getPerso(),
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a articlePerso entity.
     *
     * @Route("/{article_perso_id}/delete", name="articleperso_delete")
     * @Method("GET")
     */
    public function deleteAction(ArticlePerso $articlePerso)
    {



            $em = $this->getDoctrine()->getManager();
            $em->remove($articlePerso);
            $em->flush();


        return $this->redirectToRoute('perso_show', array(
            "perso_id" => $articlePerso->getPerso()->getId()
        ));
    }


}
