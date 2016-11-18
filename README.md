# Second Sprint (07/11 - 18/11)

## Kanban
|Task id | Developper | To do | On going | On testing | Done |
| ---------- | ---------- | :-----: | :--------: | :----------: | :----: |
| 1 | Ismail | | | | X |
| 2 | Ismail | | | | X |
| 3 | Ismail | | | | X |
| 4 | Ismail | | | | X |
| 5 | Ismail | | | | X |
| 6 | Nicolas | | | | X |
| 7 | Nicolas | | | | X |
| 8 | Mohamed | | | | X |
| 9 | Mohamed | | | | X |
| 10 | Mohamed | | | | X |
| 11 | Mohamed | | | | X |
| 12 | Nicolas | | | | X |


## User stories
* US#7 : En tant que participant à un projet, je dois pouvoir consulter et modifier le backlog (ajout, modification et suppression des sprints). 
* US#8 : En tant que participant à un projet, je dois pouvoir ajouter, modifier et supprimer des US du backlog.	
* US#9 : En tant que participant à un projet, je dois pouvoir modifier et consulter les détails de chaque sprint (kanban et description des tâches).

## Tâches
### Tâche 1 (base de données mySQL) :
* Création d'une table Task(id, description, developper, sprint, duration). 
* Création d'une table US(id, description, priority, cost, sprint). 
* Ajouter une tâche et une US en requêtes SQL pour vérifier que toutes les tables sont bien présentes. 

*Durée estimée : 0.5 Jh*

### Tâche 2 :
* Création de la page HTML du backlog (tableau des US avec description/priorité/coût/sprint).
* Création d'une boîte de dialogue permettant l'ajout, la modification et la suppression d'US.

*Durée estimée : 2 Jh*

### Tâche 3 :
* Création du contrôleur d'ajout des US.

*Durée estimée : 0.5 Jh*

### Tâche 4 :
* Création du contrôleur de modification des US.

*Durée estimée : 0.5 Jh*

### Tâche 5 :
* Création du contrôleur de suppression des US (et supression du sprint si aucune US associée au sprint restante).

*Durée estimée : 1 Jh*

### Tâche 6 :
* Création du contrôleur d'ajout des priorités, des coûts et des sprints pour chaque US.

*Durée estimée : 1.5 Jh*

### Tâche 7 :
* Création du contrôleur de modification des priorités, des coûts et des sprints pour chaque US.

*Durée estimée : 1 Jh*

### Tâche 8 :
* Création de la page HTML pour la consultation du détail de chaque sprint (kanban + US + description de chaque taĉhe).
* Création d'une boîte de dialogue permettant l'ajout, la modification et la suppression de tâches.

*Durée estimée : 2 Jh*

### Tâche 9 :
* Création du contrôleur d'ajout d'une tâche.

*Durée estimée : 1 Jh*

### Tâche 10 :
* Création d'un contrôleur de modification d'une taĉhe.

*Durée estimée : 1 Jh*

### Tâche 11 :
* Création d'un contrôleur de suppression d'une tâche.

*Durée estimée : 0,5 Jh*

### Tâche 12 :
* Test de validation qui crée plusieurs US.
* Test de validation qui ajoute des tâches dans un sprint.

*Durée estimée : 2 Jh*


**Durée totale estimée : 13,5 Jh**
