<?php

namespace NewsBundle\Controller;


use NewsBundle\Entity\CommentaireArticlePerso;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commentairearticleperso controller.
 * @ParamConverter("commentaireArticlePerso", options={"mapping" : {"commentaire_article_perso_id" : "id"}})
 * @Route("perso_comment/")
 */
class CommentaireArticlePersoController extends Controller
{

    /**
     * Displays a form to edit an existing commentaireArticlePerso entity.
     *
     * @Route("/{commentaire_article_perso_id}/edit", name="commentairearticleperso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CommentaireArticlePerso $commentaireArticlePerso)
    {

        $editForm = $this->createForm('NewsBundle\Form\CommentaireArticlePersoType', $commentaireArticlePerso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articleperso_show', array(
                'perso_id' => $commentaireArticlePerso->getArticle()->getPerso()->getId(),
                'article_perso_id' => $commentaireArticlePerso->getArticle()->getId()

            ));
        }

        return $this->render('commentairearticleperso/edit.html.twig', array(
            'perso' => $commentaireArticlePerso->getArticle()->getPerso(),
            'articlePerso' => $commentaireArticlePerso->getArticle(),
            'commentaireArticlePerso' => $commentaireArticlePerso,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a commentaireArticlePerso entity.
     *
     * @Route("/{commentaire_article_perso_id}/delete", name="commentairearticleperso_delete")
     * @Method("GET")
     */
    public function deleteAction(CommentaireArticlePerso $commentaireArticlePerso)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaireArticlePerso);
            $em->flush();


        return $this->redirectToRoute('articleperso_show', array(
            'perso_id' => $commentaireArticlePerso->getArticle()->getPerso()->getId(),
            'article_perso_id' => $commentaireArticlePerso->getArticle()->getId()
        ));
    }

}
