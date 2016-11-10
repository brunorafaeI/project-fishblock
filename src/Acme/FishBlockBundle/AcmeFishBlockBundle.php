<?php

namespace Acme\FishBlockBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeFishBlockBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
