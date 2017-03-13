<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * @Method("GET")
     */
    public function indexAction(Ecole $ecole)
    {
        return $this->render('admin/admin_ecole.html.twig', array(
            'ecole' => $ecole,

        ));
    }
}
