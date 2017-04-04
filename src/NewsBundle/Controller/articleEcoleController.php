<?php

namespace NewsBundle\Controller;

use NewsBundle\Entity\articleEcole;
use NewsBundle\Entity\commentaireArticleEcole;
use NewsBundle\Entity\Ecole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Extrait\Extrait;

/**
 * Articleecole controller.
 * @ParamConverter("articleEcole", options={"mapping" : {"article_ecole_id" : "id"}})
 * @Route("article_ecole")
 */
class articleEcoleController extends Controller
{
    /**
     * Creates a new articleEcole entity for the active ecole.
     * @ParamConverter("ecole", options={"mapping" : {"ecole_id" : "id"}})
     * @Route("/new_article_ecole/ecole/{ecole_id}", name="addArticle")
     * @Method({"GET", "POST"})
     */
    public function addArticle(Request $request, Ecole $ecole)
    {
        $articleEcole = new articleEcole();
        $articleEcole->setEcole($ecole);
        $articleEcole->setAuteur($this->getUser());
        $articleEcole->setType("article");

        $form = $this->createForm('NewsBundle\Form\articleEcoleType', $articleEcole);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($articleEcole);
            $em->flush($articleEcole);

            return $this->redirectToRoute('ecole_show', array('ecole_id' => $ecole->getId()));
        }

        return $this->render('articleecole/new.html.twig', array(
            'ecole'=>$ecole,
            'articleEcole' => $articleEcole,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a articleEcole entity.
     *
     * @Route("/{article_ecole_id}", name="articleecole_show")
     * @Method({"GET", "POST"})
     *
     */
    public function showArticle( Request $request, articleEcole $articleEcole)
    {
        $commentaireArticleEcole = new commentaireArticleEcole();
        $commentaireArticleEcole->setArticle($articleEcole);
        $commentaireArticleEcole->setAuteur($this->getUser());
        $form = $this->createForm('NewsBundle\Form\commentaireArticleEcoleType', $commentaireArticleEcole);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaireArticleEcole);
            $em->flush($commentaireArticleEcole);

            return $this->redirectToRoute('articleecole_show', array(
                'article_ecole_id' => $articleEcole->getId(),
                'ecole_id' => $articleEcole->getEcole()->getId()
            ));
        }


        return $this->render(':ViewPromo:page_layout_ecole.html.twig', array(
            'articleEcole' => $articleEcole,
            'ecole' => $articleEcole->getEcole(),
            'commentaireArticleEcole' => $commentaireArticleEcole,
            'form' => $form->createView(),

        ));
    }


    /**
     * Displays a form to edit an existing articleEcole entity.
     *
     * @Route("/{article_ecole_id}/edit", name="articleecole_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, articleEcole $articleEcole)
    {

        $editForm = $this->createForm('NewsBundle\Form\articleEcoleType', $articleEcole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articleecole_show', array('article_ecole_id' => $articleEcole->getId()));
        }

        return $this->render('articleecole/edit.html.twig', array(
            'articleEcole' => $articleEcole,
            'ecole' => $articleEcole->getEcole(),
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a articleEcole entity.
     *
     * @Route("{article_ecole_id}/delete", name="articleecole_delete")
     * @Method("GET")
     */
    public function deleteAction(articleEcole $articleEcole)
    {



            $em = $this->getDoctrine()->getManager();
            $em->remove($articleEcole);
            $em->flush();


        return $this->redirectToRoute('ecole_show', array('ecole_id' => $articleEcole->getEcole()->getId()));
    }
}
