<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\RenderView;

class HomeController
{
    public function __invoke(): void
    {
        RenderView::renderTemplate(
            templatePath: 'pages/home.php',
        );
    }
}
