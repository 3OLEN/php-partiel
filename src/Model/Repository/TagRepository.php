<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\DbConnection;
use App\Model\Entity\Referentiel;
use App\Model\Entity\Tag;

class TagRepository
{
    public function findById(int $id): ?Tag
    {
        $statement = DbConnection::createOrGetInstance()->pdo->prepare(
            <<<SQL
SELECT * FROM tag
WHERE id = :id
SQL
        );
        $statement->bindParam(':id', $id);
        $statement->execute();

        $dbTag = $statement->fetch();

        return is_array($dbTag)
            ? new Tag(
                id: (int) $dbTag['id'],
                code: $dbTag['code'],
                nom: $dbTag['nom'],
            )
            : null;
    }

    /** @return array<Tag> */
    public function getAll(): array
    {
        $statement = DbConnection::createOrGetInstance()->pdo->prepare(
            <<<SQL
SELECT * FROM tag
ORDER BY nom ASC
SQL
        );
        $statement->execute();

        $tags = [];
        foreach ($statement->fetchAll() as $dbTag) {
            $tags[] = new Tag(
                id: (int) $dbTag['id'],
                code: $dbTag['code'],
                nom: $dbTag['nom'],
            );
        }

        return $tags;
    }

    /** @return array<Tag> */
    public function findByReferentiel(Referentiel $referentiel): array
    {
        $statement = DbConnection::createOrGetInstance()->pdo->prepare(
            <<<SQL
SELECT t.* FROM tag AS t
    INNER JOIN referentiel_tag AS rt ON t.id = rt.id_tag
WHERE rt.id_referentiel = :referentiel_id
ORDER BY t.nom ASC
SQL
        );
        $statement->bindValue(param: ':referentiel_id', value: $referentiel->id, type: \PDO::PARAM_INT);
        $statement->execute();

        $tagsByReferentiel = [];
        foreach ($statement->fetchAll() as $dbTag) {
            $tagsByReferentiel[] = new Tag(
                id: (int) $dbTag['id'],
                code: $dbTag['code'],
                nom: $dbTag['nom'],
            );
        }

        return $tagsByReferentiel;
    }
}
