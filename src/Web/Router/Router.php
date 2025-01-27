<?php

declare(strict_types=1);

namespace App\Web\Router;

use App\Controller\Error\NotFoundErrorController;
use App\Controller\HomeController;
use App\Exception\Web\ResourceNotSupportedException;

class Router
{
    public function handleRequest(string $path, string $method): void
    {
        // Gestion des assets
        if (str_starts_with(haystack: $path, needle: '/public')) {
            throw new ResourceNotSupportedException(path: $path);
        }

        // Récupération du controller
        $controller = $this->getController(path: $path, method: $method);
        $controller(); // invoke
    }

    private function getController(string $path, string $method): callable
    {
        return match ($path) {
            '/' => new HomeController(),
            default => null,
        }
            ?? new NotFoundErrorController(path: $path);
    }
}
