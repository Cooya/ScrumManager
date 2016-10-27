<?php
/////Ajouter un projet /////////////////////////////////////////////////////////////////////////
// on se connecte à MySQL
$db = mysql_connect('localhost', 'root', 'root');

// on sélectionne la base
mysql_select_db('Projectmanager',$db);


// On récupére les données du formulaire et on les ajoutes dans la BDD

$name=$_GET['titre'];
$link=$_GET['theme'];


// Tests sur le formulaire 

if(!empty($name)){
	
			$sql = 'INSERT INTO project VALUES("NULL","'.$name.'","","","","","'.$link.'")'; 
			mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
			mysql_close();
		echo '<p style="color:green;"> Votre ajout a ete bien effectue </p>';

	echo '<p style="color:red;"><a href=./newProject.html> Retour </a></p>'; 	
				}



	else {
		echo '<p style="color:red;"> Veuillez completer la saisie des champs par des valeurs valides! veuillez cliquer <a href=./newProject.html> ici </a> pour recommencer </p>'; 	
			   }



?>
