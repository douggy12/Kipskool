<?php

namespace NewsBundle\Controller;

use NewsBundle\Entity\Commentaire_article_promo;
use NewsBundle\Entity\commentaireArticleEcole;
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
        switch($request->get('articleType') ){
            case "ArticlePerso":
                $repository = $em->getRepository('NewsBundle:CommentaireArticlePerso');
                break;
            case "articleEcole":
                $repository =$em->getRepository('NewsBundle:commentaireArticleEcole');
                break;
            case "Article_promo":
                $repository = $em->getRepository('NewsBundle:Commentaire_article_promo');
                break;
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
                "texte"     => $commentaire->getTexte(),
                "id"        => $commentaire->getId(),
                "avatar"    => $commentaire->getAuteur()->getAvatar()
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

        $repository = $em->getRepository('NewsBundle:ArticlePerso');
        switch($request->get('articleType') ){
            case "ArticlePerso":
                $repository = $em->getRepository('NewsBundle:ArticlePerso');
                break;
            case "articleEcole":
                $repository =$em->getRepository('NewsBundle:articleEcole');
                break;
            case "Article_promo":
                $repository = $em->getRepository('NewsBundle:Article_promo');
                break;
        }

        $article = $repository->find($request->get('article'));

        switch($request->get('articleType') ){
            case "ArticlePerso":
                $commentaire = new CommentaireArticlePerso();
                break;
            case "articleEcole":
                $commentaire =new commentaireArticleEcole();
                break;
            case "Article_promo":
                $commentaire = new Commentaire_article_promo();
        }

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
        $em = $this->getDoctrine()->getManager();


        switch($request->get('articleType') ){
            case "ArticlePerso":
                $repository = $em->getRepository('NewsBundle:CommentaireArticlePerso');
                break;
            case "articleEcole":
                $repository =$em->getRepository('NewsBundle:commentaireArticleEcole');
                break;
            case "Article_promo":
                $repository = $em->getRepository('NewsBundle:Commentaire_article_promo');
                break;
        }

        $commentaire = $repository->find($request->get('commentaire'));

        $em->remove($commentaire);
        $em->flush();

        return new Response("ok");


    }
}
