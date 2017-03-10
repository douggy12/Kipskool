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

        ));
    }

    /**
     * Deletes a articleEcole entity.
     *
     * @ParamConverter("articleEcole", options={"mapping": {"article_id": "id"}})
     * @Route("ecole/{id}/article/{article_id}/delete", name="articleecole_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Ecole $ecole, articleEcole $articleEcole)
    {



            $em = $this->getDoctrine()->getManager();
            $em->remove($articleEcole);
            $em->flush();


        return $this->redirectToRoute('ecole_show', array('id' => $ecole->getId()));
    }
}
