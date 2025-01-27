<?php

declare(strict_types=1);

namespace App\Controller\Referentiel\Ajout;

use App\Model\Repository\TagRepository;
use App\View\RenderView;
use App\Web\Session\Provider\IdentitySessionProvider;

class AjoutReferentielGetController
{
    public function __invoke(): void
    {
        if (IdentitySessionProvider::hasStoredIdentity() === false) {
            header('Location: /'); // Redirection sur la page d'accueil

            return;
        }

        RenderView::renderTemplate(
            templatePath: 'pages/referentiel/ajout/index.php',
            data: [
                'identity' => IdentitySessionProvider::getIdentity(),
                'tags' => (new TagRepository())->getAll(),
            ],
        );
    }
}
