<?php

declare(strict_types=1);

namespace App\Model\Dto;

readonly class QueryParameterDto
{
    public function __construct(
        public string $name,
        public string|int|null $value,
        public int $pdoType,
    ) {
    }
}
