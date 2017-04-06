<?php

namespace NewsBundle\Controller;

use NewsBundle\Entity\ArticlePerso;
use NewsBundle\Entity\CommentaireArticlePerso;
use NewsBundle\Entity\Perso;
use NewsBundle\Form\ArticlePersoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Articleperso controller.
 * @ParamConverter("articlePerso", options={"mapping": {"article_perso_id" : "id"}})
 * @Route("article_perso")
 */
class ArticlePersoController extends Controller
{

    /**
     * Creates a new articlePerso entity.
     * @ParamConverter("perso", options={"mapping" : {"perso_id" : "id"}})
     * @Route("/article_perso_new/perso/{perso_id}", name="articleperso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Perso $perso)
    {

        $articlePerso = new ArticlePerso();
        $articlePerso->setPerso($perso);
        $articlePerso->setType("article");
        $articlePerso->setAuteur($this->getUser());
        $form = $this->createForm('NewsBundle\Form\ArticlePersoType', $articlePerso);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($articlePerso);
            $em->flush($articlePerso);

            return $this->redirectToRoute('perso_show', array('perso_id' => $perso->getId()));
        }

        return $this->render('ViewPromo/article_new_edit.html.twig', array(
            'perso' => $perso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new articlePerso entity.
     * @ParamConverter("perso", options={"mapping" : {"perso_id" : "id"}})
     * @Route("/article_perso_new_code/perso/{perso_id}", name="articleperso_new_code")
     * @Method({"GET", "POST"})
     */
    public function newCode(Request $request, Perso $perso)
    {
        $codePerso = new ArticlePerso();
        $codePerso->setPerso($perso);
        $bool = true;

            $codePerso->setAuteur($this->getUser());

        $form = $this->createForm('NewsBundle\Form\CodeType', $codePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $codePerso->setTitre("[" . strtoupper($form->get('type')->getData()) . "]" . $form->get('titre')->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($codePerso);
            $em->flush($codePerso);

            return $this->redirectToRoute('perso_show', array('perso_id' => $perso->getId()));
        }

//        if($request->isXmlHttpRequest()){
//
//            $codePerso->setTexte($request->get('code'));
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($codePerso);
//            $em->flush($codePerso);
//
//            //return $this->redirectToRoute('perso_show', array('perso_id' => $perso->getId()));
//            return new JsonResponse(array());
//        }

        return $this->render('ace_editor.html.twig', array(
            'perso' => $perso,
            'form' => $form->createView(),
            'bool' => $bool
        ));

    }

    /**
     * Finds and displays a articlePerso entity.
     *
     * @Route("/{article_perso_id}", name="articleperso_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, ArticlePerso $articlePerso)
    {
        $commentaireArticlePerso = new CommentaireArticlePerso();
        $commentaireArticlePerso->setArticle($articlePerso);
        $commentaireArticlePerso->setAuteur($this->getUser());
        $form = $this->createForm('NewsBundle\Form\CommentaireArticlePersoType', $commentaireArticlePerso);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaireArticlePerso);
            $em->flush($commentaireArticlePerso);

            return $this->redirectToRoute('articleperso_show', array(
                'id_perso' => $articlePerso->getPerso()->getId(),
                'article_perso_id' => $articlePerso->getId()
            ));
        }

        return $this->render(':ViewPromo:article_show.html.twig', array(
            'article' => $articlePerso,
            'perso' => $articlePerso->getPerso(),
            'promos' => $articlePerso->getPerso()->getPromo(),
            'ecole' => $articlePerso->getPerso()->getPromo()->first()->getEcole(),
            'commentaireArticlePerso' => $commentaireArticlePerso,
            'form' => $form->createView(),

        ));
    }

    /**
     * Displays a form to edit an existing articlePerso entity.
     *
     * @Route("/{article_perso_id}/edit", name="articleperso_edit")
     *
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ArticlePerso $articlePerso)
    {

        if ($articlePerso->getType() != 'article') {
            $editForm = $this->createForm('NewsBundle\Form\CodeType', $articlePerso);
        } else {
            $editForm = $this->createForm('NewsBundle\Form\ArticlePersoType', $articlePerso);
        }
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articleperso_show', array('article_perso_id' => $articlePerso->getId()));
        }

        if ($articlePerso->getType() != 'article') {
            return $this->render('ace_editor.html.twig', array(
                'article' => $articlePerso,
                'perso' => $articlePerso->getPerso(),
                'form' => $editForm->createView(),
                'bool' => false,
            ));
        } else {
            return $this->render('ViewPromo/article_new_edit.html.twig', array(
                'article' => $articlePerso,
                'perso' => $articlePerso->getPerso(),
                'form' => $editForm->createView(),

            ));
        }
    }

    /**
     * Deletes a articlePerso entity.
     *
     * @Route("/{article_perso_id}/delete", name="articleperso_delete")
     * @Method("GET")
     */
    public function deleteAction(ArticlePerso $articlePerso)
    {


        $em = $this->getDoctrine()->getManager();
        $em->remove($articlePerso);
        $em->flush();


        return $this->redirectToRoute('perso_show', array(
            "perso_id" => $articlePerso->getPerso()->getId()
        ));
    }


}
