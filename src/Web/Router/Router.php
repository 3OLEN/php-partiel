<?php

declare(strict_types=1);

namespace App\Web\Router;

use App\Controller\Annuaire\AnnuaireController;
use App\Controller\Error\NotFoundErrorController;
use App\Controller\HomeController;
use App\Controller\Identification\IdentificationPostController;
use App\Controller\OubliezMoi\OubliezMoiController;
use App\Controller\Referentiel\Ajout\AjoutReferentielGetController;
use App\Controller\Referentiel\Ajout\AjoutReferentielPostController;
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
            '/annuaire' => new AnnuaireController(),
            '/identification' => $method === 'POST'
                ? new IdentificationPostController()
                : null,
            '/referentiel/ajout' => $method === 'POST'
                ? new AjoutReferentielPostController()
                : new AjoutReferentielGetController(),
            '/oubliez-moi' => new OubliezMoiController(),
            default => null,
        }
            ?? new NotFoundErrorController(path: $path);
    }
}
