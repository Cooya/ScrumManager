# First Sprint (03/11 - 07/11)

## Kanban
|Task id | Developper | To do | On going | On testing | Done |
| ---------- | ---------- | :-----: | :--------: | :----------: | :----: |
| 1 | | X | | |
| 2 | | X | | |
| 3 | | X | | |
| 4 | | X | | |
| 5 | | X | | |


## User stories
* US#1 : En tant qu’utilisateur quelconque, je dois pouvoir m’inscrire, me connecter et me déconnecter de l’application.
* US#2 : En tant qu’utilisateur quelconque, je dois pouvoir créer un projet et ainsi en devenir son chef de projet
* US#4 : En tant qu’utilisateur quelconque, je dois pouvoir accéder à la liste de tous les projets auxquels j’ai participé.

## Tâches
### Tâche 1 (base de données mySQL) :
* Création d'une base de données qui contiendra les données de notre application.
* Création d'une table User(id, login, password, first_name, surname, mail).
* Création d'une table Project(id, name, owner, master, contributors, last_update, creation_date, repository_link).
* Test unitaire : simulation SQL de la création d'un utilisateur, puis d'un projet et vérification de l'intégrité de la base.

*Durée estimée : 0,5 Jh*

### Tâche 2 (front-end HTML/CSS) :
* Conception de la barre de navigation.
* Conception de la page d'accueil (texte de présentation de l'application).

*Durée estimée : 1,5 Jh*

### Tâche 3 (front-end HTML/CSS) :
* Création de la page d'enregistrement d'un utilisateur (formulaire first_name/surname/mail/login/password).
* Création de la page de connexion (formulaire login/password).

*Durée estimée : 1,5 Jh*

### Tâche 4 (contrôleurs PHP) :
* Création d'un contrôleur PHP d'enregistrement qui reçoit une requête POST et qui soumet à la base de données une requête SQL
d'ajout d'un nouvel utilisateur.
* Création d'un contrôleur PHP de connexion qui reçoit une requête POST et qui vérifie la validité des identifiants via une
requête SQL.
* Création d'un contrôleur PHP de déconnexion d'un utilisateur.

*Durée estimée : 1 Jh*

### Tâche 5 (démonstration) :
* Test de validation : création d'un compte, connexion avec ce compte puis déconnexion.

*Durée estimée : 1 Jh*

**Durée totale estimée : 5,5 Jh**
