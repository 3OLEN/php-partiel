<?php

declare(strict_types=1);

namespace App\Controller\Error;

class NotFoundErrorController
{
    public function __construct(
        public readonly string $path,
    ) {
    }

    public function __invoke(): void
    {
        http_response_code(404);
        echo '404 Not Found';
    }
}
