<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\articleEcole;
use Kipskool\Bundle\NewsBundle\Entity\commentaireArticleEcole;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commentairearticleecole controller.
 * @ParamConverter("commentaireArticleEcole", options={"mapping" : {"commentaire_article_ecole_id" : "id"})
 * @Route("ecole_comment")
 */
class commentaireArticleEcoleController extends Controller
{




    /**
     * Displays a form to edit an existing commentaireArticleEcole entity.
     *
     * @Route("{commentaire_article_id}/edit", name="commentairearticleecole_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, commentaireArticleEcole $commentaireArticleEcole)
    {

        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\commentaireArticleEcoleType', $commentaireArticleEcole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articleecole_show', array(
                'article_id' => $commentaireArticleEcole->getArticleEcole()->getId(),
                'ecole_id' => $commentaireArticleEcole->getArticleEcole()->getEcole()->getId(),
            ));
        }

        return $this->render('commentairearticleecole/edit.html.twig', array(
            'ecole' => $commentaireArticleEcole->getArticleEcole()->getEcole(),
            'articleEcole' => $commentaireArticleEcole->getArticleEcole(),
            'commentaireArticleEcole' => $commentaireArticleEcole,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a commentaireArticleEcole entity.
     *
     * @Route("/{commentaire_article_ecole_id}/delete", name="commentairearticleecole_delete")
     * @Method("GET")
     */
    public function deleteAction(commentaireArticleEcole $commentaireArticleEcole)
    {



            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaireArticleEcole);
            $em->flush();


        return $this->redirectToRoute('articleecole_show', array(
            'ecole_id' => $commentaireArticleEcole->getArticleEcole()->getEcole()->getId(),
            'article_id' => $commentaireArticleEcole->getArticleEcole()->getId()
        ));
    }


}
