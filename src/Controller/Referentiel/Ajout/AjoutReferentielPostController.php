<?php

declare(strict_types=1);

namespace App\Controller\Referentiel\Ajout;

use App\Model\Entity\Referentiel;
use App\Model\Entity\Tag;
use App\Model\Repository\ReferentielRepository;
use App\Model\Repository\TagRepository;
use App\View\RenderView;
use App\Web\Session\Provider\IdentitySessionProvider;

class AjoutReferentielPostController
{
    public function __invoke(): void
    {
        if (IdentitySessionProvider::hasStoredIdentity() === false) {
            header('Location: /'); // Redirection sur la page d'accueil

            return;
        }

        $referentiel = $this->createModelFromSubmittedValues();
        $fieldsWithError = $this->validateSubmittedReferentiel($referentiel);
        if (count($fieldsWithError) === 0) {
            (new ReferentielRepository())->createNew($referentiel);
            header('Location: /');

            return;
        }

        RenderView::renderTemplate(
            templatePath: 'pages/referentiel/ajout/index.php',
            data: [
                'identity' => IdentitySessionProvider::getIdentity(),
                'tags' => (new TagRepository())->getAll(),
                'submittedReferentiel' => $referentiel,
                'fieldsWithError' => $fieldsWithError,
                'selectedTagIds' => array_map(
                    callback: static fn (Tag $tag): int => $tag->id,
                    array: $referentiel->getTags()
                )
            ],
        );
    }

    private function createModelFromSubmittedValues(): Referentiel
    {
        $referentiel = new Referentiel(
            titre: trim(htmlspecialchars(string: $_POST['titre'] ?? '', flags: ENT_QUOTES)),
            description: trim(htmlspecialchars(string: $_POST['description'] ?? '', flags: ENT_QUOTES)),
            url: trim(htmlspecialchars(string: $_POST['url'] ?? '', flags: ENT_QUOTES)),
            createur: IdentitySessionProvider::getIdentity(),
        );

        $submittedTagIds = array_unique(
            array: array_map(
                callback: 'intval',
                array: is_array($_POST['tags'] ?? null) ? $_POST['tags'] : []
            ),
            flags: SORT_NUMERIC
        );
        foreach ($submittedTagIds as $tagId) {
            $relatedTag = (new TagRepository())->findById($tagId);
            if ($relatedTag === null) {
                continue;
            }
            $referentiel->addTag($relatedTag);
        }

        return $referentiel;
    }

    /** @return array<string> Liste des champs en erreur */
    private function validateSubmittedReferentiel(Referentiel $referentiel): array
    {
        $errors = [];

        // * Titre
        if (
            $referentiel->getTitre() === null
            || mb_strlen($referentiel->getTitre()) === 0
            || mb_strlen($referentiel->getTitre()) > 100
        ) {
            $errors[] = 'titre';
        }

        // * Description
        if ($referentiel->getDescription() !== null && mb_strlen($referentiel->getDescription()) > 255) {
            $errors[] = 'description';
        }

        // * URL
        if (
            $referentiel->getUrl() === null
            || mb_strlen($referentiel->getUrl()) === 0
            || mb_strlen($referentiel->getUrl()) > 1000
            || filter_var(
                $referentiel->getUrl(),
                filter: FILTER_VALIDATE_URL,
                options: FILTER_NULL_ON_FAILURE
            ) === null
        ) {
            $errors[] = 'url';
        }

        // * Tags
        if (
            count($referentiel->getTags()) === 0
            || count($referentiel->getTags()) > 10
        ) {
            $errors[] = 'tags';
        }

        return $errors;
    }
}
