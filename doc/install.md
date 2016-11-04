# Installation #

## Serveur web (Apache/PHP) ##
* Installer Apache et PHP sur la machine.
* Configurer Apache pour que le répertoire d'accueil pointe vers le dossier "ScrumManager/src/web/" (du dépôt). Soit en modifiant 
le "DocumentRoot" dans le fichier "httpd.conf" soit en créant un virtual host dans le fichier "httpd-vhosts.conf".

## Base de données (MySQL) ##
* Installer MySQL sur la machine.
* Si le mot de passe de l'utilisateur "root" n'est pas "root" aussi, le modifier grâce à la commande suivante à exécuter dans 
l'interprêteur de commandes mysql : 
```
SET PASSWORD FOR 'root'@'localhost' = PASSWORD('root');
```
* Créer une nouvelle base de données et y insérer les tables requises en chargeant le script SQL 
"ScrumManager/src/bd/databaseCreation.sql" ou en exécutant le script NodeJS "ScrumManager/src/tests/createDatabase.js"

## Tests (NodeJS/Mocha/Selenium-Webdriver) ##
* Installer NodeJS sur la machine (https://nodejs.org/).
* Installer Mocha sur la machine, lancer la commande  : "npm install -g mocha" (ne fonctionne pas au CREMI).
* Lancer la commande "npm install" dans le répertoire "ScrumManager/src/tests/", cela va installer tous les modules nécessaires.
* Dans ce même répertoire, lancer la commande "npm test", qui va créer la base de données et effectuer le test d'intégration complet de l'application.
