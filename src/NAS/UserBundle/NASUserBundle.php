<?php

namespace NAS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NASUserBundle extends Bundle
{

    public function getParent(){
        return 'FOSUserBundle';
    }
}
