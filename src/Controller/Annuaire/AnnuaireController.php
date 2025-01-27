<?php

declare(strict_types=1);

namespace App\Controller\Annuaire;

use App\Model\Entity\Tag;
use App\Model\Repository\ReferentielRepository;
use App\Model\Repository\TagRepository;
use App\View\RenderView;

class AnnuaireController
{
    public function __invoke(): void
    {
        $search = $this->getSubmittedSearchValue();
        $tag = $this->getSubmittedTagValue();
        $results = null;
        if ($search !== null || $tag !== null) {
            $results = (new ReferentielRepository())->findBy(search: $search, tag: $tag);
        }

        RenderView::renderTemplate(
            templatePath: 'pages/annuaire/index.php',
            data: [
                'tags' => (new TagRepository())->getAll(),
                'search' => $search,
                'tag' => $tag,
                'results' => $results,
            ]
        );
    }

    private function getSubmittedSearchValue(): ?string
    {
        $searchValue = trim(htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES));

        return mb_strlen($searchValue) > 0 ? $searchValue : null;
    }

    private function getSubmittedTagValue(): ?Tag
    {
        $tagId = filter_var(
            value: $_GET['tag'] ?? null,
            filter: FILTER_VALIDATE_INT,
            options: [
                'options' => [
                    'min_range' => 1,
                ],
                'flags' => FILTER_NULL_ON_FAILURE,
            ]
        );

        return is_int($tagId)
            ? (new TagRepository())->findById(id: $tagId)
            : null;
    }
}
