<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\commentaireArticleEcole;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commentairearticleecole controller.
 *
 * @Route("commentairearticleecole")
 */
class commentaireArticleEcoleController extends Controller
{
    /**
     * Lists all commentaireArticleEcole entities.
     *
     * @Route("/", name="commentairearticleecole_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commentaireArticleEcoles = $em->getRepository('NewsBundle:commentaireArticleEcole')->findAll();

        return $this->render('commentairearticleecole/index.html.twig', array(
            'commentaireArticleEcoles' => $commentaireArticleEcoles,
        ));
    }

    /**
     * Creates a new commentaireArticleEcole entity.
     *
     * @Route("/new", name="commentairearticleecole_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $commentaireArticleEcole = new Commentairearticleecole();
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\commentaireArticleEcoleType', $commentaireArticleEcole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaireArticleEcole);
            $em->flush($commentaireArticleEcole);

            return $this->redirectToRoute('commentairearticleecole_show', array('id' => $commentaireArticleEcole->getId()));
        }

        return $this->render('commentairearticleecole/new.html.twig', array(
            'commentaireArticleEcole' => $commentaireArticleEcole,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentaireArticleEcole entity.
     *
     * @Route("/{id}", name="commentairearticleecole_show")
     * @Method("GET")
     */
    public function showAction(commentaireArticleEcole $commentaireArticleEcole)
    {
        $deleteForm = $this->createDeleteForm($commentaireArticleEcole);

        return $this->render('commentairearticleecole/show.html.twig', array(
            'commentaireArticleEcole' => $commentaireArticleEcole,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commentaireArticleEcole entity.
     *
     * @Route("/{id}/edit", name="commentairearticleecole_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, commentaireArticleEcole $commentaireArticleEcole)
    {
        $deleteForm = $this->createDeleteForm($commentaireArticleEcole);
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\commentaireArticleEcoleType', $commentaireArticleEcole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentairearticleecole_edit', array('id' => $commentaireArticleEcole->getId()));
        }

        return $this->render('commentairearticleecole/edit.html.twig', array(
            'commentaireArticleEcole' => $commentaireArticleEcole,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentaireArticleEcole entity.
     *
     * @Route("/{id}", name="commentairearticleecole_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, commentaireArticleEcole $commentaireArticleEcole)
    {
        $form = $this->createDeleteForm($commentaireArticleEcole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaireArticleEcole);
            $em->flush();
        }

        return $this->redirectToRoute('commentairearticleecole_index');
    }

    /**
     * Creates a form to delete a commentaireArticleEcole entity.
     *
     * @param commentaireArticleEcole $commentaireArticleEcole The commentaireArticleEcole entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(commentaireArticleEcole $commentaireArticleEcole)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentairearticleecole_delete', array('id' => $commentaireArticleEcole->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
