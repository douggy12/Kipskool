<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Perso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Perso controller.
 *
 * @Route("perso")
 */
class PersoController extends Controller
{
    /**
     * Lists all perso entities.
     *
     * @Route("/", name="perso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $persos = $em->getRepository('NewsBundle:Perso')->findAll();

        return $this->render('perso/index.html.twig', array(
            'persos' => $persos,
        ));
    }

    /**
     * Creates a new perso entity.
     *
     * @Route("/new", name="perso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $perso = new Perso();
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\PersoType', $perso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($perso);
            $em->flush($perso);

            return $this->redirectToRoute('perso_show', array('id' => $perso->getId()));
        }

        return $this->render('perso/new.html.twig', array(
            'perso' => $perso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a perso entity.
     *
     * @Route("/{id}", name="perso_show")
     * @Method("GET")
     */
    public function showAction(Perso $perso)
    {
        $deleteForm = $this->createDeleteForm($perso);

        return $this->render('perso/show.html.twig', array(
            'perso' => $perso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing perso entity.
     *
     * @Route("/{id}/edit", name="perso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Perso $perso)
    {
        $deleteForm = $this->createDeleteForm($perso);
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\PersoType', $perso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('perso_edit', array('id' => $perso->getId()));
        }

        return $this->render('perso/edit.html.twig', array(
            'perso' => $perso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a perso entity.
     *
     * @Route("/{id}/delete", name="perso_delete")
     * @Method("GET")
     */
    public function deleteAction(Perso $perso)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($perso);
            $em->flush();


        return $this->redirectToRoute('perso_index');
    }

    /**
     * Creates a form to delete a perso entity.
     *
     * @param Perso $perso The perso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Perso $perso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('perso_delete', array('id' => $perso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
