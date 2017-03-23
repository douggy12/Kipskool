<?php

namespace NewsBundle\Controller;

use NewsBundle\Entity\CommentaireArticlePerso;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AjaxCommentaireController extends Controller
{
    /**
     * récupère la liste des commentaires au format JSON
     * @Method({"GET", "POST"})
     * @Route("/comlist")
     * @param Request $request
     * @return JsonResponse
     */
    public function listAjaxCommentaire(Request $request)
    {
        $article = $request->get('article');
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('NewsBundle:commentaireArticleEcole');
        if($request->get('articleType') == "ArticlePerso"){
            $repository = $em->getRepository('NewsBundle:CommentaireArticlePerso');
        }


        $commentaires = $repository->findBy(
            array(
                'article' => $article
                ),
            array(
                'createdAt' => "DESC"
            ));


        foreach ($commentaires as $commentaire){
            $jsonCom[] = array(
                "createdAt" => $commentaire->getCreatedAt(),
                "auteur"    => $commentaire->getAuteur()->getPrenom().' '.$commentaire->getAuteur()->getNom(),
                "texte"     => $commentaire->getTexte()
            );
        }


        return new JsonResponse( $jsonCom );
    }

    /**
     * @param Request $request
     * @Route("/addcom")
     * @return Response
     */
    public function addAjaxCommentaire (Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repository;
        if($request->get('articleType') == "ArticlePerso"){
            $repository = $em->getRepository('NewsBundle:ArticlePerso');
        }

        $article = $repository->find($request->get('article'));

        $commentaire = new CommentaireArticlePerso();
        $commentaire->setArticle($article);
        $commentaire->setAuteur($this->getUser());
        $commentaire->setTexte($request->get('texte'));


        $em->persist($commentaire);
        $em->flush();

        return new Response("ok");


    }

    /**
     * @param Request $request
     * @Route("/delcom")
     */
    public function delAjaxCommentaire (Request $request)
    {

    }
}
