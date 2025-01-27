<?php

use App\View\RenderView;

ob_start();
?>

<div class="alert alert-light" role="alert">
    <h2 class="h4 alert-heading">Référentiel de connaissances</h2>
    <p>
        Vous allez pouvoir interagir avec le référentiel de connaissances afin d'effectuer une recherche par le biais
        de l'<a href="/annuaire">annuaire inversé</a> ou d'ajouter de nouvelles ressources.
    </p>
    <p>
        Si vous souhaitez apporter une contribution au référentiel, merci de vous identifier avec le formulaire
        ci-dessous.
    </p>
</div>

<?php
$content = ob_get_clean();

RenderView::renderBase(
    pageTitle: '3OLEN - Partiel PHP',
    content: $content
);
