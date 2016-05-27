<?php

namespace DEE\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DEEUserBundle extends Bundle
{
    // This bundle extends FOSUserBundle
    public function getParent() {
        return 'FOSUserBundle';
    }
}
