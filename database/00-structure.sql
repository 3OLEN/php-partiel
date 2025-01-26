CREATE TABLE referentiel
(
    id int AUTO_INCREMENT
        PRIMARY KEY,
    titre varchar(100) NOT NULL,
    description varchar(255) NULL,
    url varchar(1000) NOT NULL,
    createur varchar(255) NOT NULL,
    date_creation datetime DEFAULT CURRENT_TIMESTAMP NOT NULL
)
    COMMENT 'Ensemble des ressources du référentiel';

CREATE INDEX referentiel_titre_index
    ON referentiel (titre);

CREATE TABLE tag
(
    id int AUTO_INCREMENT
        PRIMARY KEY,
    code varchar(100) NOT NULL,
    nom varchar(200) NOT NULL,
    CONSTRAINT tag_unique_code
        UNIQUE (code),
    CONSTRAINT tag_unique_nom
        UNIQUE (nom)
)
    COMMENT 'Sujets (ou tags) des ressources du référentiel';

CREATE TABLE referentiel_tag
(
    id_referentiel int NOT NULL,
    id_tag int NOT NULL,
    PRIMARY KEY (id_referentiel, id_tag),
    CONSTRAINT referentiel_tag_referentiel_id_fk
        FOREIGN KEY (id_referentiel) REFERENCES referentiel (id),
    CONSTRAINT referentiel_tag_tag_id_fk
        FOREIGN KEY (id_tag) REFERENCES tag (id)
)
    COMMENT 'Table d''association entre les ressources du référentiel et les sujets';

