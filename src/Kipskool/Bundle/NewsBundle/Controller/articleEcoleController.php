<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\articleEcole;
use Kipskool\Bundle\NewsBundle\Entity\commentaireArticleEcole;
use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Articleecole controller.
 *
 *@Route("ecole")
 */
class articleEcoleController extends Controller
{
    /**
     * Creates a new articleEcole entity for the active ecole.
     *
     * @Route("/{id}/new", name="addArticle")
     * @Method({"GET", "POST"})
     */
    public function addArticle(Request $request, Ecole $ecole)
    {
        $articleEcole = new articleEcole();
        $articleEcole->setEcole($ecole);

        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\articleEcoleType', $articleEcole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articleEcole);
            $em->flush($articleEcole);

            return $this->redirectToRoute('ecole_show', array('id' => $ecole->getId()));
        }

        return $this->render('articleecole/new.html.twig', array(
            'articleEcole' => $articleEcole,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a articleEcole entity.
     *
     * @ParamConverter("articleEcole", options={"mapping": {"article_id": "id"}})

     * @Route("/{id}/article/{article_id}", name="articleecole_show")
     * @Method({"GET", "POST"})
     *
     */
    public function showArticle( Request $request, Ecole $ecole, articleEcole $articleEcole)
    {
        $commentaireArticleEcole = new commentaireArticleEcole();
        $commentaireArticleEcole->setArticleEcole($articleEcole);
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\commentaireArticleEcoleType', $commentaireArticleEcole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaireArticleEcole);
            $em->flush($commentaireArticleEcole);

            return $this->redirectToRoute('articleecole_show', array(
                'article_id' => $articleEcole->getId(),
                'id' => $ecole->getId(),
            ));
        }


        return $this->render('articleecole/show.html.twig', array(
            'articleEcole' => $articleEcole,
            'ecole' => $ecole,
            'commentaireArticleEcole' => $commentaireArticleEcole,
            'form' => $form->createView(),

        ));
    }


    /**
     * Displays a form to edit an existing articleEcole entity.
     *
     * @Route("/{ecole_id}/article/{article_id}/edit", name="articleecole_edit")
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
     * @Route("/{id}/article/{article_id}/delete", name="articleecole_delete")
     * @Method("GET")
     */
    public function deleteAction(Ecole $ecole, articleEcole $articleEcole)
    {



            $em = $this->getDoctrine()->getManager();
            $em->remove($articleEcole);
            $em->flush();


        return $this->redirectToRoute('ecole_show', array('id' => $ecole->getId()));
    }
}
