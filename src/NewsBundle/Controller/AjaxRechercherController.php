<?php

namespace NewsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class AjaxRechercherController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Method("POST")
     * @Route("/rechercher")
     */
    public function indexAction(Request $request)
    {
        $motcle = $request->get('motcle');
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('NewsBundle:Perso')->findWithMotCle($motcle);
//            ->select('p')
//            ->where('p.prenom LIKE :motcle')
//            ->setParameter('motcle',  '%'.$motcle.'%')
//            ->orWhere('p.nom LIKE :motcle')
//            ->setParameter('motcle', '%'.$motcle.'%')
//            ->getQuery()
//        ;
        $resultats = $query->getResult();

        $jsonList = array();

        foreach ($resultats as $resultat){
            $jsonList[] = array(
               "prenom" => $resultat->getPrenom(),
               "nom" => $resultat->getNom(),
                "link" => '/perso/'.$resultat->getId(),
                "promo" => $resultat->getPromo()->first()->getNom(),
                "avatar" => $resultat->getAvatarName()



            );
        }


        return new JsonResponse($jsonList);
    }
}
