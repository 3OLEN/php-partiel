<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\DbConnection;
use App\Model\Dto\QueryParameterDto;
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
            $parameters[] = new QueryParameterDto(
                name: 'search',
                value: "%{$search}%",
                pdoType: \PDO::PARAM_STR,
            );
        }
        if ($tag !== null) {
            $whereClauses[] = 't.id = :tag_id';
            $parameters[] = new QueryParameterDto(
                name: 'tag_id',
                value: $tag->id,
                pdoType: \PDO::PARAM_INT,
            );
        }

        if (count($whereClauses) > 0) {
            $query .= ' WHERE ' . implode(' AND ', $whereClauses);
        }
        $query .= ' ORDER BY ref.titre ASC';

        $statement = DbConnection::createOrGetInstance()->pdo->prepare($query);
        foreach ($parameters as $parameter) {
            $statement->bindValue(param: $parameter->name, value: $parameter->value, type: $parameter->pdoType);
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

    public function createNew(Referentiel $referentiel): void
    {
        // 1. Referentiel
        $statement = DbConnection::createOrGetInstance()->pdo->prepare(
            <<<SQL
INSERT INTO referentiel (titre, description, url, createur, date_creation)
VALUES (:titre, :description, :url, :createur, NOW())
SQL
        );
        $statement->bindValue(param: ':titre', value: $referentiel->getTitre());
        $statement->bindValue(param: ':description', value: $referentiel->getDescription());
        $statement->bindValue(param: ':url', value: $referentiel->getUrl());
        $statement->bindValue(param: ':createur', value: $referentiel->getCreateur());

        $statement->execute();

        // 2. Tags reliés
        $referentielId = DbConnection::createOrGetInstance()->pdo->lastInsertId();

        $values = [];
        $parameters = [
            new QueryParameterDto(
                name: 'referentiel_id',
                value: $referentielId,
                pdoType: \PDO::PARAM_INT,
            ),
        ];
        foreach ($referentiel->getTags() as $index => $tag) {
            $values[] = "(:referentiel_id, :tag_id_{$index})";
            $parameters[] = new QueryParameterDto(
                name: "tag_id_{$index}",
                value: $tag->id,
                pdoType: \PDO::PARAM_INT,
            );
        }

        $sqlReferentielTag = 'INSERT INTO referentiel_tag (id_referentiel, id_tag) VALUES '
            . implode(', ', $values);
        $referentielTagStatement = DbConnection::createOrGetInstance()->pdo->prepare($sqlReferentielTag);
        foreach ($parameters as $parameter) {
            $referentielTagStatement->bindValue(
                param: $parameter->name,
                value: $parameter->value,
                type: $parameter->pdoType
            );
        }
        $referentielTagStatement->execute();
    }
}
