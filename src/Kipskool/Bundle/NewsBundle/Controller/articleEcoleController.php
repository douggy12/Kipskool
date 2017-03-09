<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\articleEcole;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Articleecole controller.
 *
 *
 */
class articleEcoleController extends Controller
{
    /**
     * Lists all articleEcole entities.
     *
     * @Route("/", name="articleecole_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articleEcoles = $em->getRepository('NewsBundle:articleEcole')->findAll();

        return $this->render('articleecole/index.html.twig', array(
            'articleEcoles' => $articleEcoles,
        ));
    }

    /**
     * Creates a new articleEcole entity.
     *
     * @Route("/new", name="articleecole_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $articleEcole = new Articleecole();
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\articleEcoleType', $articleEcole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articleEcole);
            $em->flush($articleEcole);

            return $this->redirectToRoute('articleecole_show', array('id' => $articleEcole->getId()));
        }

        return $this->render('articleecole/new.html.twig', array(
            'articleEcole' => $articleEcole,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a articleEcole entity.
     *
     * @Route("/{id}", name="articleecole_show")
     * @Method("GET")
     */
    public function showAction(articleEcole $articleEcole)
    {
        $deleteForm = $this->createDeleteForm($articleEcole);

        return $this->render('articleecole/show.html.twig', array(
            'articleEcole' => $articleEcole,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing articleEcole entity.
     *
     * @Route("/{id}/edit", name="articleecole_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, articleEcole $articleEcole)
    {
        $deleteForm = $this->createDeleteForm($articleEcole);
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\articleEcoleType', $articleEcole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articleecole_edit', array('id' => $articleEcole->getId()));
        }

        return $this->render('articleecole/edit.html.twig', array(
            'articleEcole' => $articleEcole,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a articleEcole entity.
     *
     * @Route("/{id}", name="articleecole_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, articleEcole $articleEcole)
    {
        $form = $this->createDeleteForm($articleEcole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($articleEcole);
            $em->flush();
        }

        return $this->redirectToRoute('articleecole_index');
    }

    /**
     * Creates a form to delete a articleEcole entity.
     *
     * @param articleEcole $articleEcole The articleEcole entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(articleEcole $articleEcole)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('articleecole_delete', array('id' => $articleEcole->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
