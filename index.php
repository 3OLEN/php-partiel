<?php

declare(strict_types=1);

use App\Application;
use App\Exception\Web\ResourceNotSupportedException;

require_once __DIR__ . '/vendor/autoload.php';

try {
    (new Application())->run();
} catch (ResourceNotSupportedException) {
    return false;
}
