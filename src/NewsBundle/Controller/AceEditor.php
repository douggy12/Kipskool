<?php
namespace NewsBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * a page with an ace editor in it
 * @Route("ace")
 */
class AceEditor extends Controller{
    /**
     * @Route("")
     */
    public function GoToAce(){
        return $this->render('::ace_builds.html.twig');
    }
}
