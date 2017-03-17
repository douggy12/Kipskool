<?php

/**
 * Created by PhpStorm.
 * User: dmett
 * Date: 10/03/2017
 * Time: 11:52
 */
namespace Extrait;

class Extrait
{

    /**
     * La fonction raccourcirChaine() permet de réduire une chaine trop longue
     * passée en paramètre.
     *
     * Si la troncature a lieu dans un mot, la fonction tronque à l'espace suivant.
     *
     * @param : string $chaine le texte trop long à tronquer
     * @param : integer $tailleMax la taille maximale de la chaine tronquée
     * @return : string
     */
    public function getChaineRaccourci($chaine, $tailleMax)
    {
        $positionDernierEspace = 0;
        if( strlen($chaine) >= $tailleMax )
        {
            $chaine = substr($chaine,0,$tailleMax);
            $positionDernierEspace = strrpos($chaine,' ');
            $chaine = substr($chaine,0,$positionDernierEspace).'...';
        }
        return $chaine;
    }

}