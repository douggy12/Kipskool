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

    public function addImage()
    {

        if (isset($_FILES['monImage']) and $_FILES['monImage']['type'] == 'web/NewsBundle/img') {
            $img = $_FILES['monImage'];
            $uniq = uniqid();
            $img_path = 'web/NewsBundle/img/' . $uniq . ".jpg";
            $big_img_path = 'images/big/' . "img" . $uniq . ".jpg";

            function resize($src, $img_path, $mywidth)
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
                imagejpeg($thumb, $img_path);
            }

            resize($img['tmp_name'], $img_path, 100);
            //move_uploaded_file($img['tmp_name'],$img_path);



            $save=array(
                "img" => "img" . $uniq . ".jpg",
            );
            header('Location: index.php');
        } else echo 'erreur !!!';
    }
}