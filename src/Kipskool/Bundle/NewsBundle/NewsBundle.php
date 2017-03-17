<?php

namespace Kipskool\Bundle\NewsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NewsBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
