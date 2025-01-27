<?php

declare(strict_types=1);

namespace App\View;

class RenderView
{
    public static function renderTemplate(string $templatePath, array $data = []): void
    {
        extract($data);
        require_once $_SERVER['DOCUMENT_ROOT'] . "/templates/{$templatePath}";
    }

    public static function renderBase(string $pageTitle, string $content): void
    {
        static::renderTemplate(
            templatePath: 'layout/base.php',
            data: [
                'pageTitle' => $pageTitle,
                'content' => $content,
            ]
        );
    }
}
