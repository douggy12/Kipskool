<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Article_promo;
use Kipskool\Bundle\NewsBundle\Entity\articleEcole;
use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Kipskool\Bundle\NewsBundle\Entity\Promo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Symfony\Component\HttpFoundation\Request;

/**
 * Admin controller.
 *
 * @Route("/admin/")
 */
class AdminEcoleController extends Controller
{
    /**
     * Finds and displays a ecole entity.
     *
     * @ParamConverter("ecole", options={"mapping":{"ecole_id":"id"}})
     * @Route("ecole/{ecole_id}", name="admin_ecole")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ecole $ecole)
    {
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\EcoleType', $ecole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_ecole', array('ecole_id' => $ecole->getId()));
        }
        return $this->render('admin/admin_ecole.html.twig', array(
            'ecole' => $ecole,
            'edit_form' => $editForm->createView(),
        ));
    }
    /**
     * Deletes a articleEcole entity.
     *
     * @ParamConverter("articleEcole", options={"mapping": {"article_id": "id"}})
     * @Route("article/{article_id}/delete", name="admin_article_delete")
     * @Method("GET")
     */
    public function deleteAction(articleEcole $articleEcole)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($articleEcole);
        $em->flush();

        return $this->redirectToRoute('admin_ecole', array('ecole_id' => $articleEcole->getEcole()->getId()));
    }

    /**
     * Displays a form to edit an existing articleEcole entity.
     *
     * @ParamConverter("articleEcole", options={"mapping": {"article_id": "id"}})
     * @Route("article/{article_id}/edit", name="admin_article_edit")
     * @Method({"GET", "POST"})
     */
    public function editArticleAction(Request $request, articleEcole $articleEcole)
    {

        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\articleEcoleType', $articleEcole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_ecole', array('ecole_id' => $articleEcole->getEcole()->getId()));
        }

        return $this->render('articleecole/edit.html.twig', array(
            'ecole'=>$articleEcole->getEcole(),
            'articleEcole' => $articleEcole,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Finds and displays a ecole entity.
     *
     * @ParamConverter("ecole", options={"mapping": {"ecole_id": "id"}})
     * @Route("promo/{ecole_id}", name="admin_promo")
     * @Method("GET")
     */
    public function indexPromoAction(Ecole $ecole)
    {


        return $this->render('admin/admin_promo.html.twig', array(
            'ecole' => $ecole,

        ));
    }


}
