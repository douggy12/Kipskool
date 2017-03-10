<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\ArticlePerso;
use Kipskool\Bundle\NewsBundle\Entity\Perso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Articleperso controller.
 *
 * @Route("persoop")
 */
class ArticlePersoController extends Controller
{

    /**
     * Creates a new articlePerso entity.
     *
     * @Route("/{id}/addarticle", name="articleperso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Perso $perso)
    {
        $articlePerso = new ArticlePerso();
        $articlePerso->setPerso($perso);
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\ArticlePersoType', $articlePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articlePerso);
            $em->flush($articlePerso);

            return $this->redirectToRoute('perso_show', array('id' => $perso->getId()));
        }

        return $this->render('perso/show.html.twig', array(
            'perso' => $perso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a articlePerso entity.
     *
     * @Route("/{id}", name="articleperso_show")
     * @Method("GET")
     */
    public function showAction(ArticlePerso $articlePerso)
    {
        $deleteForm = $this->createDeleteForm($articlePerso);

        return $this->render('articleperso/show.html.twig', array(
            'articlePerso' => $articlePerso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing articlePerso entity.
     *
     * @Route("/{id}/edit", name="articleperso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ArticlePerso $articlePerso)
    {
        $deleteForm = $this->createDeleteForm($articlePerso);
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\ArticlePersoType', $articlePerso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articleperso_edit', array('id' => $articlePerso->getId()));
        }

        return $this->render('articleperso/edit.html.twig', array(
            'articlePerso' => $articlePerso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a articlePerso entity.
     *
     * @Route("/{id}", name="articleperso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ArticlePerso $articlePerso)
    {
        $form = $this->createDeleteForm($articlePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($articlePerso);
            $em->flush();
        }

        return $this->redirectToRoute('articleperso_index');
    }

    /**
     * Creates a form to delete a articlePerso entity.
     *
     * @param ArticlePerso $articlePerso The articlePerso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ArticlePerso $articlePerso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('articleperso_delete', array('id' => $articlePerso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
