<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\ArticlePerso;
use Kipskool\Bundle\NewsBundle\Entity\CommentaireArticlePerso;
use Kipskool\Bundle\NewsBundle\Entity\Perso;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commentairearticleperso controller.
 * @ParamConverter("articlePerso", options={"mapping" : {"article_id" : "id"}})
 * @ParamConverter("commentaireArticlePerso", options={"mapping" : {"comment_id" : "id"}})
 * @Route("perso/{id}/article/{article_id}/comment/")
 */
class CommentaireArticlePersoController extends Controller
{

    /**
     * Displays a form to edit an existing commentaireArticlePerso entity.
     *
     * @Route("/{comment_id}/edit", name="commentairearticleperso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Perso $perso, ArticlePerso $articlePerso, CommentaireArticlePerso $commentaireArticlePerso)
    {

        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\CommentaireArticlePersoType', $commentaireArticlePerso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articleperso_show', array(
                'id' => $perso->getId(),
                'article_id' => $articlePerso->getId()

            ));
        }

        return $this->render('commentairearticleperso/edit.html.twig', array(
            'perso' => $perso,
            'articlePerso' => $articlePerso,
            'commentaireArticlePerso' => $commentaireArticlePerso,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a commentaireArticlePerso entity.
     *
     * @Route("/{comment_id}/delete", name="commentairearticleperso_delete")
     * @Method("GET")
     */
    public function deleteAction(Perso $perso, ArticlePerso $articlePerso,CommentaireArticlePerso $commentaireArticlePerso)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaireArticlePerso);
            $em->flush();


        return $this->redirectToRoute('articleperso_show', array(
            'id' => $perso->getId(),
            'article_id' => $articlePerso->getId()
        ));
    }

    /**
     * Creates a form to delete a commentaireArticlePerso entity.
     *
     * @param CommentaireArticlePerso $commentaireArticlePerso The commentaireArticlePerso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommentaireArticlePerso $commentaireArticlePerso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentairearticleperso_delete', array('id' => $commentaireArticlePerso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
