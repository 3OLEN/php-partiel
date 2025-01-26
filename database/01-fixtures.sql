INSERT INTO partiel_php.referentiel (id, titre, description, url, createur, date_creation)
VALUES
    (1, '2025 3OLEN - PHP - Cours', 'Ressources du module PHP des 3OLEN 2025', 'https://lyon-ort.fr/mod/folder/view.php?id=3554', 'Système', '2025-01-01 00:00:00'),
    (2, 'PHP 8.4 - Nouveautés', 'Article de blog des Tilleuls concernant les nouveautés du langage PHP sur sa version 8.4 de novembre 2024', 'https://les-tilleuls.coop/blog/ce-quil-faut-retenir-des-nouveautes-de-php-8-4', 'Système', '2025-01-01 00:00:00'),
    (3, 'Angular - MutationObserver', 'Article d''aide sur les MutationObserver en Angular', 'https://nitayneeman.com/blog/listening-to-dom-changes-using-mutationobserver-in-angular/', 'Système', '2025-01-01 00:00:00'),
    (4, 'PHP - self VS static', 'Petite explication sur la différence des mots-clefs "self" et "static" en PHP', 'https://php6.io/php/self-vs-static', 'Système', '2025-01-01 00:00:00'),
    (5, 'Infection PHP - Documentation', 'Documentation de la librairie « infection/infection » pour réaliser des tests de mutation en PHP', 'https://infection.github.io/guide/', 'Système', '2025-01-01 00:00:00');

INSERT INTO partiel_php.tag (id, code, nom)
VALUES
    (1, 'PHP', 'PHP'),
    (2, 'JS', 'JS'),
    (3, 'DEV_WEB', 'Développement web'),
    (4, 'POSTGRESQL', 'PostgreSQL'),
    (5, 'MYSQL', 'MySQL'),
    (6, 'DATABASE', 'Bases de données'),
    (7, 'DOC_TECH', 'Documentation technique'),
    (8, 'TUTO', 'Tutorial'),
    (9, 'SYMFONY', 'Symfony'),
    (10, 'ANGULAR', 'Angular'),
    (11, 'BOOTSTRAP', 'Bootstrap'),
    (12, 'FRAMEWORK', 'Framework'),
    (13, 'FORMATION', 'Formation'),
    (14, 'POO', 'Programmation Orientée Objet'),
    (15, 'RELEASE', 'Release'),
    (16, 'CODE_QUALITY', 'Qualité du code'),
    (17, 'TESTS', 'Tests'),
    (18, 'TU', 'Tests Unitaires'),
    (19, 'PHPUNIT', 'PHPUnit'),
    (20, 'INFECTION', 'Infection (Tests PHP)');

INSERT INTO partiel_php.referentiel_tag (id_referentiel, id_tag)
VALUES
    (1, 1),
    (2, 1),
    (4, 1),
    (5, 1),
    (1, 3),
    (4, 7),
    (5, 7),
    (3, 8),
    (4, 8),
    (3, 10),
    (1, 13),
    (2, 15),
    (4, 16),
    (5, 16),
    (5, 18),
    (5, 20);
