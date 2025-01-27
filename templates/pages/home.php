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

<?php if (isset($identity)): ?>
    <div class="alert alert-info" role="alert">
        <h2 class="h4 alert-heading">Bienvenue <?= $identity ?> !</h2>
        <p>
            Vous êtes maintenant identifié·e et pouvez accéder à l'ensemble des fonctionnalités du référentiel de
            connaissances et ainsi <a href="/referentiel/ajout">ajouter une nouvelle ressource</a>.
        </p>
        <div class="d-flex justify-content-center">
            <a href="/oubliez-moi" class="btn btn-primary">Je souhaite que mon identité soit réinitialisée !</a>
        </div>
    </div>
<?php endif; ?>

<form action="/identification" method="post">
    <div class="mb-3 col-md-6">
        <label for="identity" class="form-label">Votre identité</label>
        <input type="text" class="form-control" id="identity" name="identity" value="<?= $identity ?? '' ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">S'identifier</button>
</form>

<?php
$content = ob_get_clean();

RenderView::renderBase(
    pageTitle: '3OLEN - Partiel PHP',
    content: $content
);
