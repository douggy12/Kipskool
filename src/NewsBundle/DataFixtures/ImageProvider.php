<?php

namespace NewsBundle\DataFixtures;

use Symfony\Component\HttpFoundation\File\File;

class ImageProvider
{
    public static function portrait()
    {
        return new File(__DIR__.'\..\..\..\web\images\avatar\portrait'. rand(1,87) .'.jpg');

    }

    public static function articleImg(){
        return new File(__DIR__.'\..\..\..\web\images\articleperso\article'. rand(1,56) .'.jpg');
    }

    public static function ecoleImg(){
        return new File(__DIR__.'\..\..\..\web\images\imie.png');
    }

    public static function promoImg($int){
        return new File(__DIR__.'\..\..\..\web\images\avatar\promo'. $int .'.jpg');
    }
}