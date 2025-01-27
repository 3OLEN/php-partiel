<?php

declare(strict_types=1);

namespace App\Model\Entity;

class Referentiel
{
    private array $tags = [];

    public function __construct(
        public readonly ?int $id = null,
        private ?string $titre = null,
        private ?string $description = null,
        private ?string $url = null,
        private ?string $createur = null,
        private ?\DateTimeImmutable $dateCreation = null,
    ) {
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getCreateur(): ?string
    {
        return $this->createur;
    }

    public function setCreateur(?string $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeImmutable $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): static
    {
        $this->tags = array_combine(
            keys: array_map(
                callback: static fn (Tag $tag): string => $tag->getCode(),
                array: $tags
            ),
            values: $tags
        );

        return $this;
    }

    public function addTag(Tag $tag): static
    {
        $this->tags[$tag->getCode()] = $tag;

        return $this;
    }
}
