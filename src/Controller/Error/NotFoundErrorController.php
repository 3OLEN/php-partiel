<?php

declare(strict_types=1);

namespace App\Controller\Error;

use App\View\RenderView;

class NotFoundErrorController
{
    public function __construct(
        public readonly string $path,
    ) {
    }

    public function __invoke(): void
    {
        http_response_code(404);

        RenderView::renderTemplate(
            templatePath: 'errors/404.php',
            data: [
                'path' => $this->path,
            ]
        );
    }
}
