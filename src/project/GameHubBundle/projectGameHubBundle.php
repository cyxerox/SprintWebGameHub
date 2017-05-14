<?php

namespace project\GameHubBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class projectGameHubBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
