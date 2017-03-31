<?php

namespace NewsBundle\DataFixtures;

use Symfony\Component\HttpFoundation\File\File;

class PortraitProvider
{
    public static function portrait()
    {
        return new File('C:\Users\dmett\PhpstormProjects\Kipskool\web\images\avatar\portrait'. rand(1,87) .'.jpg');
    }
}