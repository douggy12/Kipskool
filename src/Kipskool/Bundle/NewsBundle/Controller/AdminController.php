<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Article_promo;
use Kipskool\Bundle\NewsBundle\Entity\articleEcole;
use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\BrowserKit\Response;

/**
 * Admin controller.
 *
 * @Route("/admin/")
 */
class AdminController extends Controller
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


}
