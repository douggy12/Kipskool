<?php
namespace NewsBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUpLoader
{


    public function __construct($targetDir)
    {

    }

    public function resize($src, $mywidth)
    {
        // Fichier et nouvelle taille
        $filename = $src;

        // Content type
        header('Content-Type: image/jpeg');

        // Calcul des nouvelles dimensions
        list($width, $height) = getimagesize($filename);
        $newwidth = $mywidth;
        $newheight = $height / $width * $mywidth;

        // Chargement
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($filename);

        // Redimensionnement
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        // Affichage
        imagejpeg($thumb);
    }

    public function getTargetDir()
    {

    }
}
