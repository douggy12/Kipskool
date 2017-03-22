<?php
namespace Extrait;

class resize extends \Twig_Extension
{
    public function resize($src, $img_path, $mywidth)
    {


// Fichier et nouvelle taille
        $filename = $src;
        $percent = 0.5;

// Content type
        header('Content-Type: image/jpeg');

// Calcul des nouvelles dimensions
        list($width, $height) = getimagesize($filename);
        $newwidth = $mywidth;
        $newheight = $height / $width * $mywidth;
        // $newheight = $height * $percent;

// Chargement
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($filename);

// Redimensionnement
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Affichage


        imagejpeg($thumb, $img_path);
    }
}