# 3OLEN 2024-2025 - Partiel PHP

* 📆 Date : Lundi 27 janvier
* ⏳️ Durée : 4h
* 🆘 Aide autorisée : Internet, cours, TP
* ⛔️ Interdits : Communication, partage de code, plagiat
* **‼️ Respectez bien les instructions ‼️**
  - 💯 Je me servirai des instructions pour noter le partiel !
  - ☑️ Merci de commiter régulièrement afin de réduire les soupçons de plagiat...

## 📜 Sujet

Vous êtes chargé·e de réaliser un référentiel de connaissances avec un annuaire inversé, permettant de retrouver les
ressources liées à la recherche spécifiée.

Ce référentiel de connaissances fait le lien entre les ressources (seulement des liens dans un premier temps) et des
sujets (appelés "tags").

L'annuaire inversé permettra de retourner toutes les ressources (donc des liens) liées aux intitulés de recherche.

### 🗃️ Référentiel de connaissances

* Table : `referentiel`
* Dictionnaire de données :
  - id (int)
  - titre (string) { obligatoire ; maximum 100 caractères }
  - description (string) { maximum 255 caractères }
  - url (string) { obligatoire ; maximum 1000 caractères ; doit être une URL }
  - sujets (array<string>) { obligatoire ; minimum 1 sujet ; maximum 10 sujets ; représentés par la table `tag` }
  - createur (string) { obligatoire ; maximum 255 caractères }
  - date de création (datetime) { obligatoire }

### 📋️ Réalisation

Vous aurez à réaliser les pages suivantes :

- [ ] Accueil
- [ ] Annuaire inversé

#### Accueil

Une simple page d'accueil permettant de naviguer vers les autres pages de l'application.

#### Annuaire inversé

Cette page est découpée en deux parties : formulaire de recherche et tableau des résultats.

- [ ] Formulaire de recherche
  - [ ] Champ de saisie libre pour recherche partielle sur le titre
  - [ ] Sélection d'un sujet (tag)
- [ ] Tableau des résultats
  - [ ] Affiché à la soumission de la recherche
  - [ ] Tableau (titre, url, autres sujets, date ajout) ; triées par titre ascendant

### 💯 Pour aller + loin

Vous pouvez réaliser le formulaire d'ajout d'une nouvelle ressource dans le référentiel de connaissances.

Le formulaire doit mettre à disposition les champs suivants :

- [ ] Titre
- [ ] Description
- [ ] URL
- [ ] Sujets (tags)
- [ ] Créateur

## 📋️ Instructions

### 📦️ Projet

- [x] Renseignez votre NOM + Prénom : Billy Villena
- [x] Commiter régulièrement : dès que vous avez terminé une partie, ou toutes les 30/45mn.
- [x] Initialiser un projet composer
  - [x] `"name": "php/partiel"`
  - [x] Préfixe des namespaces : `App\\`
  - [x] Dossier des sources PHP : `src/`
  - [x] Version PHP minimale : `8.3.0`
  - [x] Extensions PHP requises : `ext-pdo` / `ext-pdo_mysql` / `ext-mbstring`
- [x] Définissez et gérez correctement votre `.gitignore`
- [x] Le point d'entrée de l'application est `index.php` à la racine du projet
- [x] Les assets seront définies dans le dossier `public/`
  - ⚠️ Vous pouvez avoir un bonus sur l'UX / UI, mais à vous de gérer le temps imparti !

### 🗃️ Base de données

- [x] Créer une base de données MySQL `partiel_php`
- [x] Utiliser le script SQL fourni [database/00-structure.sql](database/00-structure.sql) pour la structure de la BDD
- [x] Utiliser le script SQL fourni [database/01-fixtures.sql](database/01-fixtures.sql) pour les données de la BDD

### 🔲 Programmation Orientée Objet

- Une classe PHP est sous format PascalCase => `IndexController` / `AjouterUtilisateurController`
- Un fichier PHP reprend **exactement** le nom de la classe => `IndexController.php` / `AjouterUtilisateurController.php`
- Les noms des dossiers sont sous format PascalCase => `src/Model/Entity` / `src/Controller/Utilisateur`
- Si ces règles ne sont pas respectées, vous aurez des problèmes avec Linux et aujourd'hui **TOUTES** les
  applications PHP sont hébergées sur du Linux
  - Pour info, j'utilise du Linux, donc si vous voulez que votre projet fonctionne correctement chez moi...

----------

- [x] Tout ce qui peut être typé est typé !
  - Rares sont les cas où le type `mixed` est utilisé... 
- [x] Le `SRP` (_Single Responsibility Principle_) doit être respecté
- [x] Utilisation de la promotion des propriétés
- [x] Utilisation des accesseurs & mutateurs

### 📥️ Point d'entrée

- [x] Créer un fichier `index.php` à la racine du projet
- [x] Charger l'autoloader de Composer
- [x] Initialiser la session PHP
- [x] Définition du router
  - Vous pouvez le définir directement dans ce fichier (le plus simple)
  - Ou par une classe dédiée `Router` ; s'il est **100% fonctionnel**, vous aurez un bonus
  - ⛔️ Pas de librairie tierce, à vous de le coder !

> ℹ️ Vous n'avez pas besoin de traiter les parties suivantes dans l'ordre.

### 🌐 Router

- [x] Doit laisser le soin au serveur web de servir les assets (fichiers accessibles dans `public/`)
- [ ] Doit définir les routes de l'application et utiliser le controller associé
- [x] Doit rejeter par une 404 si la route n'existe pas

### ⬢ Controllers

- [ ] Doivent être définis dans leur propre dossier et organisés dans des sous-dossiers
- [ ] Rappels de POO [⬆️](#-programmation-orientée-objet) 
- [ ] À vous de voir si vous faites un controller par action, ou plusieurs actions dans le même controller, ou du
      Controller "invokable", etc. Tant que l'organisation est propre et cohérente !
- [ ] Les données soumises sont vérifiées et validées 

### 🗄️ Model

- [x] Les entities et repositories doivent être définies dans leur propre dossier
  - Il peut y avoir, éventuellement, un dossier encapsulant la partie "Model"
- [x] Rappels de POO [⬆️](#-programmation-orientée-objet)
- [x] La connexion BDD n'est définie qu'une seule fois dans toute l'application
- [ ] Les entités sont utilisées dans les repositories
- [ ] Les requêtes utilisent des paramètres nommés

### 🍱 View

- [ ] Utilisation de templates dédiés dans le dossier `templates/` à la racine du projet
  - [ ] Les templates sont organisés dans des sous-dossiers
- [ ] Utilisation du HTML sémantique
- [ ] Réutilisation de morceaux de templates
- [ ] Navigation entre les pages par des boutons d'action ou des liens
