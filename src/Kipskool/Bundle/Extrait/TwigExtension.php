<?php
namespace Kipskool\Bundle\Extrait;

class TwigExtension extends \Twig_Extension
{
    public function getRaccourci(){
        return array(
            new \Twig_SimpleFilter('text_raccourci', array($this, 'textFilter'))
        );
    }

    public function textFilter($chaine)
    {
        $positionDernierEspace = 0;
        if( strlen($chaine) >= 50)
        {
            $chaine = substr($this,0,50);
            $positionDernierEspace = strrpos($chaine,' ');
            $chaine = substr($chaine,0,$positionDernierEspace).'...';
        }
        $chaine= '['.$chaine.']';
        return $chaine;
    }
}