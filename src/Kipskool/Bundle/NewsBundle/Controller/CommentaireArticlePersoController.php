<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\CommentaireArticlePerso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commentairearticleperso controller.
 *
 * @Route("commentairearticleperso")
 */
class CommentaireArticlePersoController extends Controller
{
    /**
     * Lists all commentaireArticlePerso entities.
     *
     * @Route("/", name="commentairearticleperso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commentaireArticlePersos = $em->getRepository('NewsBundle:CommentaireArticlePerso')->findAll();

        return $this->render('commentairearticleperso/index.html.twig', array(
            'commentaireArticlePersos' => $commentaireArticlePersos,
        ));
    }

    /**
     * Creates a new commentaireArticlePerso entity.
     *
     * @Route("/new", name="commentairearticleperso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $commentaireArticlePerso = new Commentairearticleperso();
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\CommentaireArticlePersoType', $commentaireArticlePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaireArticlePerso);
            $em->flush($commentaireArticlePerso);

            return $this->redirectToRoute('commentairearticleperso_show', array('id' => $commentaireArticlePerso->getId()));
        }

        return $this->render('commentairearticleperso/new.html.twig', array(
            'commentaireArticlePerso' => $commentaireArticlePerso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentaireArticlePerso entity.
     *
     * @Route("/{id}", name="commentairearticleperso_show")
     * @Method("GET")
     */
    public function showAction(CommentaireArticlePerso $commentaireArticlePerso)
    {
        $deleteForm = $this->createDeleteForm($commentaireArticlePerso);

        return $this->render('commentairearticleperso/show.html.twig', array(
            'commentaireArticlePerso' => $commentaireArticlePerso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commentaireArticlePerso entity.
     *
     * @Route("/{id}/edit", name="commentairearticleperso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CommentaireArticlePerso $commentaireArticlePerso)
    {
        $deleteForm = $this->createDeleteForm($commentaireArticlePerso);
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\CommentaireArticlePersoType', $commentaireArticlePerso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentairearticleperso_edit', array('id' => $commentaireArticlePerso->getId()));
        }

        return $this->render('commentairearticleperso/edit.html.twig', array(
            'commentaireArticlePerso' => $commentaireArticlePerso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentaireArticlePerso entity.
     *
     * @Route("/{id}", name="commentairearticleperso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CommentaireArticlePerso $commentaireArticlePerso)
    {
        $form = $this->createDeleteForm($commentaireArticlePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaireArticlePerso);
            $em->flush();
        }

        return $this->redirectToRoute('commentairearticleperso_index');
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
