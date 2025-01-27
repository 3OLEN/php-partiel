<?php

declare(strict_types=1);

namespace App\Exception\Web;


class ResourceNotSupportedException extends \Exception
{
    public function __construct(
        public readonly string $path
    ) {
        parent::__construct(
            message: "La ressource « {$this->path} » n'est pas supportée",
            code: 501
        );
    }
}
