<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\articleEcole;
use Kipskool\Bundle\NewsBundle\Entity\commentaireArticleEcole;
use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commentairearticleecole controller.
 *
 * @Route("ecole")
 */
class commentaireArticleEcoleController extends Controller
{




    /**
     * Displays a form to edit an existing commentaireArticleEcole entity.
     *
     * @Route("/{id}/article/{article_id}/commentaire/{comment_id}/edit", name="commentairearticleecole_edit")
     * @ParamConverter("articleEcole", options={"mapping":{"article_id" : "id"}})
     * @ParamConverter("commentaireArticleEcole", options={"mapping":{"comment_id" : "id"}})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ecole $ecole, articleEcole $articleEcole, commentaireArticleEcole $commentaireArticleEcole)
    {
        $deleteForm = $this->createDeleteForm($commentaireArticleEcole);
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\commentaireArticleEcoleType', $commentaireArticleEcole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articleecole_show', array(
                'article_id' => $articleEcole->getId(),
                'id' => $ecole->getId(),
            ));
        }

        return $this->render('commentairearticleecole/edit.html.twig', array(
            'ecole' => $ecole,
            'articleEcole' => $articleEcole,
            'commentaireArticleEcole' => $commentaireArticleEcole,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a commentaireArticleEcole entity.
     *
     * @Route("/{id}/article/{article_id}/commentaire/{comment_id}/delete", name="commentairearticleecole_delete")
     * @ParamConverter("articleEcole", options={"mapping":{"article_id" : "id"}})
     * @ParamConverter("commentaireArticleEcole", options={"mapping":{"comment_id" : "id"}})
     * @Method("GET")
     */
    public function deleteAction(Ecole $ecole, articleEcole $articleEcole, commentaireArticleEcole $commentaireArticleEcole)
    {



            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaireArticleEcole);
            $em->flush();


        return $this->redirectToRoute('articleecole_show', array(
            'id' => $ecole->getId(),
            'article_id' => $articleEcole->getId()
        ));
    }


}
