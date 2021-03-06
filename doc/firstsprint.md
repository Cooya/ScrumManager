# First Sprint (24/10 - 04/11)

## Kanban
|Task id | Developper | To do | On going | On testing | Done |
| ---------- | ---------- | :-----: | :--------: | :----------: | :----: |
| 1 | Ismail | | | | X |
| 2 | Ismail | | | | X |
| 3 | Mohamed | | | | X |
| 4 | Mohamed | | | | X |
| 5 | Ismail | | | | X |
| 6 | Ismail | | | | X |
| 7 | Ismail | | | | X |
| 8 | Nicolas | | | | X |
| 9 | Mohamed | | | | X |
| 10 | Nicolas | | | | X |


## User stories
* US#1 : En tant qu’utilisateur quelconque, je dois pouvoir m’inscrire, me connecter et me déconnecter de l’application.
* US#2 : En tant qu’utilisateur quelconque, je dois pouvoir créer un projet et ainsi en devenir son chef de projet.
* US#3 : En tant qu’utilisateur quelconque, je dois pouvoir rejoindre un projet en tant que contributeur ou propriétaire.
* US#4 : En tant qu’utilisateur quelconque, je dois pouvoir accéder à la liste de tous les projets auxquels j’ai participé.
* US#5 : En tant que chef de projet, je dois pouvoir ajouter ou retirer des contributeurs et un propriétaire.

## Tâches
### Tâche 1 (base de données mySQL) :
* Création d'une base de données "Projectmanager" dans lequel seront stockées nos tables. 
* Création d'une table User(id, login, password, name, surname, mail). 
* Création d'une table Project(id, name, owner, master, contributors, last_update, creation_date, repository_link). 
* Ajouter un utilisateur ainsi qu'un projet en requêtes SQL pour vérifier que toutes les tables sont bien présentes. 

*Durée estimée : 0,5 Jh*

### Tâche 2 :
* Création du menu de navigation.
* Création de la page HTML "Home".

*Durée estimée : 1 Jh*

### Tâche 3 :
* Création de la page HTML de connexion (formulaire login/password).
* Création de la page HTML d'enregistrement (formulaire login/password/name/surname/email).

*Durée estimée : 1 Jh*

### Tâche 4 :
* Réalisation du contrôleur PHP pour la gestion des requêtes SQL correpondantes à la connexion et l'enregistrement des utilisateurs. 

*Durée estimée : 1 Jh*

### Tâche 5 :
* Réalisation de la page HTML de création d'un nouveau projet.

*Durée estimée : 0,5 Jh*

### Tâche 6 :
* Création de la page HTML pour lister les projets existants.

*Durée estimée : 0,5 Jh*

### Tâche 7 :
* Réalisation du contrôleur PHP qui permet la création d'un nouveau projet (l'utilisateur qui crée le projet devient automatiquement le chef de ce projet).
* Réalisation du contrôleur PHP qui effectue le listage des projets.

*Durée estimée : 1 Jh*

### Tâche 8 :
* Créer une table pour stocker les contributeurs (association projet/utilisateur).
* Réalisation d'un contrôleur qui permet d'inviter des contributeurs et un client au projet.

*Durée estimée : 1 Jh*

### Tâche 9 :
* Création de la page HTML pour l'ajout de nouveaux contributeurs et un client par leur nom d'utilisateur.

*Durée estimée : 0,5 Jh*

### Tâche 10 :
* Effectuer un test de validation qui crée un compte et se connecte avec.
* Effectuer un test de validation qui crée plusieurs projets et qui les liste.

*Durée estimée : 1 Jh*


**Durée totale estimée : 8 Jh**
