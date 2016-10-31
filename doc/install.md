# Installation #
* Installer Apache, PHP et mySQL sur la machine.
* Configurer Apache pour que le répertoire d'accueil pointe vers le dossier "ScrumManager/src/web/" (du dépôt). Soit en modifiant 
le "DocumentRoot" dans le fichier "httpd.conf" soit en créant un virtual host dans le fichier "httpd-vhosts.conf".

## Base de données ##
* Si le mot de passe de l'utilisateur "root" n'est pas "root" aussi, le modifier grâce à la commande suivante à exécuter dans 
l'interprêteur de commandes mysql : 
```
SET PASSWORD FOR 'root'@'localhost' = PASSWORD('root');
```
* Créer une nouvelle base de données et y insérer les tables requises en chargeant le script SQL 
"ScrumManager/src/bd/databaseCreation.sql".
