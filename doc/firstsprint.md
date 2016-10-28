# First Sprint (03/11 - 07/11)

## Kanban
|Task id | Developper | To do | On going | On testing | Done |
| ---------- | ---------- | :-----: | :--------: | :----------: | :----: |
| 1 |Ismail |  | | |X |
| 2 | Ismail|  | | |X |
| 3 |Mohamed | | | |X |
| 4 |Mohamed | || |X |
| 5 | Ismail|  | | | X|
| 6 |Ismail |  | | | X|
| 7 | Ismail|  | | | X|
| 8 | | X | | | |
| 9 |Mohamed | | | |X |
| 10 | | X | | | |
| 11 |Nicolas |  | |X | |


## User stories
* US#1 : En tant qu’utilisateur quelconque, je dois pouvoir m’inscrire, me connecter et me déconnecter de l’application.
* US#2 : En tant qu’utilisateur quelconque, je dois pouvoir créer un projet et ainsi en devenir son chef de projet.
* US#3 : En tant qu’utilisateur quelconque, je dois pouvoir être invité à un projet en tant que contributeur ou client.
* US#4 : En tant qu’utilisateur quelconque, je dois pouvoir accéder à la liste de tous les projets auxquels j’ai participé.
* US#5 : En tant que chef de projet, je dois pouvoir ajouter ou retirer des contributeurs et un client. 

## Tâches
### Tâche 1 (base de données mySQL) :
* Création d'une base de données "Projectmanager" dans lequel seront stockées nos tables. 
* Création d'une table "User", User(id, login, password, name, surname, mail). 
* Création d'une table "Project", Project(id, name, owner, master, contributors, last_update, creation_date, repository_link). 
* Ajouter un utilisateur ainsi qu'un projet en requêtes SQL pour vérifier que toutes les tables sont bien présentes. 

*Durée estimée : 0,5 Jh*

### Tâche 2 :
* Création du menu de navigation.
* Création de la page HTML "Home".

*Durée estimée : 1 Jh*

### Tâche 3 :
* Création de la page HTML de connexion (Formulaire avec deux champs de texte).
* Création de la page HTML d'enregistrement (Formulaire avec les champs correspondants à la table User).

*Durée estimée : 1 Jh*

### Tâche 4 :
* Réalialisation du controleur PHP pour la gestion des requêtes SQL correpondantes à la connexion et l'enregistrement des utilisateurs. 

*Durée estimée : 1 Jh*

### Tâche 5 :
* Réalialisation de la page HTML de création d'un nouveau projet.

*Durée estimée : 0,5 Jh*

### Tâche 6 :
* Création de la page HTML pour lister les projets existants.

*Durée estimée : 0,5 Jh*

### Tâche 7 :
* Réalialisation du controleur PHP qui permet la création d'un nouveau projet (l'utilisateur qui crée le projet devient automatiquement le chef de ce projet)ainsi que effectuer le listage des projets.

*Durée estimée : 1 Jh*


### Tâche 8 :
* Réalialisation d'un controleur PHP qui permet de générer un mail de notification lorsqu'on est ajouté à un nouveau projet sur le mail il y'aura un lien qui permet de rejoindre le projet.

*Durée estimée : 1 Jh*

### Tâche 9 :
* Création de la page HTML pour l'ajout de nouveaux contributeurs par leurs mails.

*Durée estimée : 0,5 Jh*

### Tâche 10 :
* Création d'un controleur PHP permet la gestion de l'ajout des nouveaux contributeurs ainsi que l'envoi de mail.

*Durée estimée : 1 Jh*


### Tâche 11 :
* Effectuer un test de validation qui crée un compte et se connecte avec.
* Effectuer un test de validation qui crée plusieurs projets et qui les liste.

*Durée estimée : 1 Jh*






**Durée totale estimée : 9 Jh**
