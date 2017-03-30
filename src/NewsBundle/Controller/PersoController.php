<?php

namespace NewsBundle\Controller;

use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use NewsBundle\Entity\Perso;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Perso controller.
 * @ParamConverter("perso", options={"mapping" : {"perso_id" : "id"}})
 * @Route("perso")
 */
class PersoController extends Controller
{

    /**
     * Finds and displays a perso entity.
     *
     * @Route("/{perso_id}", name="perso_show")
     * @Method("GET")
     */
    public function showAction(Perso $perso)
    {
        $promo = $perso->getPromo()->first();


        return $this->render('perso/show.html.twig', array(
            'promo' => $promo,
            'perso' => $perso,

        ));
    }

    /**
     * Displays a form to edit an existing Perso entity.
     *

     * @Route("/{perso_id}/edit", name="perso_edit")
     *
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Perso $perso)
    {

        $editForm = $this->createForm('NewsBundle\Form\PersoType', $perso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            /** @var CacheManager */
            $imagineCacheManager = $this->get('liip_imagine.cache.manager');

            /** @var string */
            $resolvedPath = $imagineCacheManager->getBrowserPath($perso->getAvatar(), 'avatar_mini');

            return $this->redirectToRoute('perso_show', array('perso_id' => $perso->getId()));
        }

        return $this->render('perso/edit.html.twig', array(
            'perso' => $perso,
            'edit_form' => $editForm->createView(),

        ));
    }

}
