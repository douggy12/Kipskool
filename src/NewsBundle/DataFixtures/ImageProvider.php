<?php

namespace NewsBundle\DataFixtures;

use Symfony\Component\HttpFoundation\File\File;

class ImageProvider
{
    public static function portrait()
    {
        return new File(__DIR__.'\..\..\..\web\images\avatar\portrait'. rand(1,87) .'.jpg');

    }

    public static function articlePersoImg(){
        return new File(__DIR__.'\..\..\..\web\images\articleperso\article'. rand(1,49) .'.jpg');
    }
}