<?php

use App\View\RenderView;

ob_start();
?>

<div class="alert alert-info" role="alert">
    <p>Vous pouvez effectuer une recherche par :</p>
    <ul>
        <li>Intitulé (recherche partielle)</li>
        <li>Sujet</li>
    </ul>
</div>

<form>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="search" class="form-label">Intitulé</label>
            <input type="text" class="form-control" id="search" name="search" value="<?= $search ?? '' ?>">
        </div>

        <div class="col-md-6">
            <label for="tag" class="form-label">Sujet</label>
            <select class="form-select" id="tag" name="tag">
                <option value="">Sélectionnez un sujet</option>
                <?php foreach ($tags as $tagToDisplay): ?>
                    <option value="<?= $tagToDisplay->id ?>"
                        <?= $tagToDisplay->id === $tag?->id ? 'selected' : '' ?>
                    >
                        <?= $tagToDisplay->getNom() ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="d-flex gap-3">
        <a href="/" class="btn btn-secondary">Retour à l'accueil</a>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </div>
</form>

<?php if (isset($results)): ?>

<div class="card mt-3">
    <div class="card-body">
        <h2 class="h4 card-title">Résultats</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Ressource</th>
                <th scope="col">Sujets</th>
                <th scope="col">Date ajout</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $referentiel): ?>
                <tr>
                    <td><?= $referentiel->getTitre() ?></td>
                    <td><?= $referentiel->getUrl() ?></td>
                    <td>
                        <?php foreach ($referentiel->getTags() as $tag): ?>
                            <a href="/annuaire?tag=<?= $tag->id ?>" class="badge bg-secondary">
                                <?= $tag->getNom() ?>
                            </a>
                        <?php endforeach; ?>
                    </td>
                    <td><?= $referentiel->getDateCreation()->format('d/m/Y') ?></td>
                </tr>
            <?php endforeach; ?>

            <?php if (count($results) === 0): ?>
                <tr>
                    <td colspan="4" class="text-center">Aucun résultat</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php
$content = ob_get_clean();

RenderView::renderBase(
    pageTitle: 'Annuaire inversé',
    content: $content
);
