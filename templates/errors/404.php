<?php

use App\View\RenderView;

ob_start();
?>

<div class="alert alert-danger" role="alert">
    <h2 class="h4 alert-heading">404 Not Found!</h2>
    <p>La ressource « <code><?= $path ?></code> » demandée n'existe pas.</p>
</div>

<nav class="d-flex">
    <a href="/" class="btn btn-secondary">
        Retour à l'accueil
    </a>
</nav>

<?php
$content = ob_get_clean();

RenderView::renderBase(
    pageTitle: 'Page introuvable !',
    content: $content
);
