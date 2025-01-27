<?php

declare(strict_types=1);

namespace App\Controller\OubliezMoi;

use App\Web\Session\Provider\IdentitySessionProvider;

class OubliezMoiController
{
    public function __invoke(): void
    {
        IdentitySessionProvider::resetIdentity();
        header('Location: /');
    }
}
