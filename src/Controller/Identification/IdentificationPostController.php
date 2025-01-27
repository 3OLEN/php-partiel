<?php

declare(strict_types=1);

namespace App\Controller\Identification;

use App\Web\Session\Provider\IdentitySessionProvider;

class IdentificationPostController
{
    public function __invoke(): void
    {
        $identity = trim(htmlspecialchars(string: $_POST['identity'] ?? '', flags: ENT_QUOTES));

        if (mb_strlen($identity) > 0) {
            IdentitySessionProvider::storeIdentity(identity: $identity);
        }

        header('Location: /');
    }
}
