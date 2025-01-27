<?php

declare(strict_types=1);

namespace App\Model\Entity;

class Tag
{
    public function __construct(
        public readonly ?int $id = null,
        private ?string $code = null,
        private ?string $nom = null,
    ) {
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}
