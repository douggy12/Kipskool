<?php
namespace NewsBundle\Twig;


class AppExtension extends \Twig_Extension
{
    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;

        return $price;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('raccourci', array($this, 'textFilter'))
        );
    }

    public function textFilter($chaine)
    {
        $positionDernierEspace = 0;
        if (strlen($chaine) >= 50) {
            $chaine = substr($chaine, 0, 50);
            $positionDernierEspace = strrpos($chaine, ' ');
            $chaine = substr($chaine, 0, $positionDernierEspace) . '...';
        }
        $chaine = '[' . $chaine . ']';
        return $chaine;
    }

    public function resizeImage($image)
    {

            function resize($src, $mywidth)
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

            resize($image,  100);
            //move_uploaded_file($img['tmp_name'],$img_path);
        
            header('Location: index.php');

    }
}