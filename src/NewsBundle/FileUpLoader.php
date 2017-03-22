<?php
namespace NewsBundle;

use Faker\Provider\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUpLoader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }
    public function resize($src, $mywidth)
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

        $imageName= md5(uniqid()).'.'.$filename->guessExtension();
        $thumb->move(
            $this->getParameter('srcFeatures_directory'),
            $imageName
        );

// Redimensionnement
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        
    }
    public function getTargetDir()
    {
        return $this->targetDir;
    }
}
