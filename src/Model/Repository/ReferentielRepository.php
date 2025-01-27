<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\DbConnection;
use App\Model\Entity\Referentiel;
use App\Model\Entity\Tag;

class ReferentielRepository
{
    /** @return array<Referentiel> */
    public static function findBy(?string $search = null, ?Tag $tag = null): array
    {
        $query = <<<'SQL'
SELECT DISTINCT ref.* FROM referentiel AS ref
    INNER JOIN referentiel_tag AS ref_tag ON ref.id = ref_tag.id_referentiel
    INNER JOIN tag AS t ON ref_tag.id_tag = t.id
SQL;

        $whereClauses = [];
        $parameters = [];
        if ($search !== null) {
            $whereClauses[] = 'ref.titre LIKE :search';
            $parameters[] = new readonly class(name: 'search', value: "%{$search}%", type: \PDO::PARAM_STR) {
                public function __construct(
                    public string $name,
                    public mixed $value,
                    public int $type,
                ) {}
            };
        }
        if ($tag !== null) {
            $whereClauses[] = 't.id = :tag_id';
            $parameters[] = new readonly class(name: 'tag_id', value: $tag->id, type: \PDO::PARAM_INT) {
                public function __construct(
                    public string $name,
                    public mixed $value,
                    public int $type,
                ) {}
            };
        }

        if (count($whereClauses) > 0) {
            $query .= ' WHERE ' . implode(' AND ', $whereClauses);
        }
        $query .= ' ORDER BY ref.titre ASC';

        $statement = DbConnection::createOrGetInstance()->pdo->prepare($query);
        foreach ($parameters as $parameter) {
            $statement->bindValue(param: $parameter->name, value: $parameter->value, type: $parameter->type);
        }
        $statement->execute();

        $referentiels = [];
        foreach ($statement->fetchAll() as $dbReferentiel) {
            $referentiel = new Referentiel(
                id: (int) $dbReferentiel['id'],
                titre: $dbReferentiel['titre'],
                description: $dbReferentiel['description'],
                url: $dbReferentiel['url'],
                createur: $dbReferentiel['createur'],
                dateCreation: new \DateTimeImmutable($dbReferentiel['date_creation']),
            );

            $referentiel->setTags((new TagRepository())->findByReferentiel(referentiel: $referentiel));

            $referentiels[] = $referentiel;
        }

        return $referentiels;
    }
}
