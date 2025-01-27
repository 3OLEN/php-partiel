<?php

use App\View\RenderView;

ob_start();
?>
    <form method="post">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input
                type="text"
                class="form-control<?= in_array(needle: 'titre', haystack: $fieldsWithError ?? [], strict: true) ? ' is-invalid' : ''; ?>"
                id="titre"
                name="titre"
                required
                maxlength="100"
                value="<?= $submittedReferentiel?->getTitre() ?? ''; ?>"
            >
            <?php if (in_array(needle: 'titre', haystack: $fieldsWithError ?? [], strict: true)): ?>
                <div class="invalid-feedback">
                    Le titre est obligatoire et doit comporter au maximum 100 caractères.
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                rows="3"
                class="form-control<?= in_array(needle: 'description', haystack: $fieldsWithError ?? [], strict: true) ? ' is-invalid' : ''; ?>"
                id="description"
                name="description"
                maxlength="255"
            ><?= $submittedReferentiel?->getDescription() ?? '' ?></textarea>
            <?php if (in_array(needle: 'description', haystack: $fieldsWithError ?? [], strict: true)): ?>
                <div class="invalid-feedback">
                    La description ne doit pas dépasser 255 caractères.
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input
                type="text"
                class="form-control<?= in_array(needle: 'url', haystack: $fieldsWithError ?? [], strict: true) ? ' is-invalid' : ''; ?>"
                id="url"
                name="url"
                required
                maxlength="1000"
                value="<?= $submittedReferentiel?->getUrl() ?? ''; ?>"
            >
            <?php if (in_array(needle: 'url', haystack: $fieldsWithError ?? [], strict: true)): ?>
                <div class="invalid-feedback">
                    L'URL est obligatoire, doit être valide et doit comporter au maximum 1000 caractères.
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Sujet·s</label>
            <select
                class="form-control<?= in_array(needle: 'tags', haystack: $fieldsWithError ?? [], strict: true) ? ' is-invalid' : ''; ?>"
                id="tags"
                name="tags[]"
                multiple
                required
                size="15"
            >
                <?php foreach ($tags as $tag): ?>
                    <option
                        value="<?= $tag->id ?>"
                        <?= in_array(needle: $tag->id , haystack: $selectedTagIds ?? [], strict: true) ? 'selected' : ''; ?>
                    >
                        <?= $tag->getNom() ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (in_array(needle: 'tags', haystack: $fieldsWithError ?? [], strict: true)): ?>
                <div class="invalid-feedback">
                    Au moins un sujet doit être sélectionné et au maximum 10 sujets peuvent être choisis.
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="createur" class="form-label">Créateur</label>
            <input type="text" class="form-control" id="createur" disabled value="<?= $identity; ?>">
        </div>

        <div class="d-flex gap-3">
            <a href="/" class="btn btn-secondary">Retour à l'accueil</a>
            <button type="submit" class="btn btn-primary">Créer ressource</button>
        </div>
    </form>

<?php
$content = ob_get_clean();

RenderView::renderBase(
    pageTitle: 'Ajout de ressource dans le référentiel',
    content: $content
);
