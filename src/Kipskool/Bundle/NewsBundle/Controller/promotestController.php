<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Commentaire_article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Promo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class promotestController extends Controller
{
//    /**
//     * @Route('/add_promo', name="addProm")
//     */
//    public function indexAction()
//    {
//        $promo = new Promo();
//        $promo->setNom("JMQ DL 2016");
//        $promo->setDescription("formation je me qualifie");
//
//        $article_promo= new Article_promo();
//        $article_promo->setTexte("Bonjour a tous !!!!!!");
//        $article_promo->setTitre("Bienvenito");
//        $article_promo->setCreatedAt(time());
//        $article_promo->setSrcFeature("wwwgooglefr");
//        $article_promo->setPromo($promo);
//
//        $commentaire= new Commentaire_article_promo();
//        $commentaire->setTexte("trop de la merde ton comment");
//        $commentaire->setArticlePromo($article_promo);
//
//        $em= $this->getDoctrine()->getManager();
//        $em->persist($promo);
//        $em->persist($article_promo);
//        $em->persist($commentaire);
//
//        $em->flush();
//
//        return new Response("Youpi tu a réussis");
//    }
}
