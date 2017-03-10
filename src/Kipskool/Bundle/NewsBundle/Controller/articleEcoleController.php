<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\articleEcole;
use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * Displays a form to edit an existing articleEcole entity.
     *
     * @Route("ecole/{ecole_id}/article/{article_id}/edit", name="articleecole_edit")
     * @ParamConverter("articleEcole", options={"mapping": {"article_id": "id"}})
     * @ParamConverter("ecole", options={"mapping": {"ecole_id": "id"}})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ecole $ecole, articleEcole $articleEcole)
    {
        $deleteForm = $this->createDeleteForm($articleEcole);
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\articleEcoleType', $articleEcole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ecole_show', array('id' => $ecole->getId()));
        }

        return $this->render('articleecole/edit.html.twig', array(
            'articleEcole' => $articleEcole,
            'ecole' => $ecole,
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
