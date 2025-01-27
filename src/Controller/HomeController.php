<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\RenderView;
use App\Web\Session\Provider\IdentitySessionProvider;

class HomeController
{
    public function __invoke(): void
    {
        $templateParameters = [];
        // Identité
        if (IdentitySessionProvider::hasStoredIdentity()) {
            $templateParameters['identity'] = IdentitySessionProvider::getIdentity();
        }

        RenderView::renderTemplate(
            templatePath: 'pages/home.php',
            data: $templateParameters
        );
    }
}
