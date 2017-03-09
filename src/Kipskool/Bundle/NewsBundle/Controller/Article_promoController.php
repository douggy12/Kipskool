<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Article_promo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Article_promo controller.
 *
 * @Route("article_promo")
 */
class Article_promoController extends Controller
{
    /**
     * Lists all article_promo entities.
     *
     * @Route("/", name="article_promo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $article_promos = $em->getRepository('NewsBundle:Article_promo')->findAll();

        return $this->render('article_promo/index.html.twig', array(
            'article_promos' => $article_promos,
        ));
    }

    /**
     * Creates a new article_promo entity.
     *
     * @Route("/new", name="article_promo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $article_promo = new Article_promo();
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Article_promoType', $article_promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article_promo);
            $em->flush($article_promo);

            return $this->redirectToRoute('article_promo_show', array('id' => $article_promo->getId()));
        }

        return $this->render('article_promo/new.html.twig', array(
            'article_promo' => $article_promo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a article_promo entity.
     *
     * @Route("/{id}", name="article_promo_show")
     * @Method("GET")
     */
    public function showAction(Article_promo $article_promo)
    {
        $deleteForm = $this->createDeleteForm($article_promo);

        return $this->render('article_promo/show.html.twig', array(
            'article_promo' => $article_promo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing article_promo entity.
     *
     * @Route("/{id}/edit", name="article_promo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Article_promo $article_promo)
    {
        $deleteForm = $this->createDeleteForm($article_promo);
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Article_promoType', $article_promo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_promo_edit', array('id' => $article_promo->getId()));
        }

        return $this->render('article_promo/edit.html.twig', array(
            'article_promo' => $article_promo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a article_promo entity.
     *
     * @Route("/{id}", name="article_promo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Article_promo $article_promo)
    {
        $form = $this->createDeleteForm($article_promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article_promo);
            $em->flush();
        }

        return $this->redirectToRoute('article_promo_index');
    }

    /**
     * Creates a form to delete a article_promo entity.
     *
     * @param Article_promo $article_promo The article_promo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article_promo $article_promo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_promo_delete', array('id' => $article_promo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
