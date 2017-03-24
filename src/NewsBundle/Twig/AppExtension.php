<?php
namespace NewsBundle\Twig;




class AppExtension extends \Twig_Extension
{
//    public function getFilters()
//    {
//        return array(
//            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
//        );
//    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }


    public function getFilters(){
        return array(
            new \Twig_SimpleFilter('raccourci', array($this, 'textFilter'))
        );
    }

    public function textFilter($chaine)
    {
        $positionDernierEspace = 0;
        if( strlen($chaine) >= 50)
        {
            $chaine = substr($chaine,0,50);
            $positionDernierEspace = strrpos($chaine,' ');
            $chaine = substr($chaine,0,$positionDernierEspace).'...';
        }
        $chaine= '['.$chaine.']';
        return $chaine;
    }
//}
}