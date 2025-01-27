<?php

declare(strict_types=1);

namespace App;

use App\Web\Router\Router;

class Application
{
    public function run(): void
    {
        session_start();

        $router = new Router();
        $router->handleRequest(
            path: parse_url(url: $_SERVER['REQUEST_URI'], component: PHP_URL_PATH),
            method: $_SERVER['REQUEST_METHOD']
        );
    }
}
