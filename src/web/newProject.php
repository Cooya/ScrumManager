<?php
/////Ajouter un projet /////////////////////////////////////////////////////////////////////////
// on se connecte à MySQL

session_start();
$db = mysql_connect('localhost', 'root', 'root');

// on sélectionne la base
mysql_select_db('Projectmanager',$db);

$current_user= $_SESSION['login'];
$sql = 'SELECT id FROM user WHERE login="'.$current_user.'"'; 
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());  

// On récupére les données du formulaire et on les ajoutes dans la BDD
$data = mysql_fetch_array($req);
$name=$_GET['name'];
$link=$_GET['link'];
$datetime = date("Y-m-d H:i:s");

// Tests sur le formulaire 

if(!empty($name)){
	
			$sql = 'INSERT INTO project VALUES("NULL","'.$name.'","'.$data['id'].'","1","1","","'.$datetime.'","'.$link.'")'; 
			mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
			mysql_close();
		echo '<p style="color:green;"> Votre ajout a ete bien effectue </p>';

	echo '<p style="color:red;"><a href=./newProject.html> Retour </a></p>'; 	
				}



	else {
		echo '<p style="color:red;"> Veuillez completer la saisie des champs par des valeurs valides! veuillez cliquer <a href=./newProject.html> ici </a> pour recommencer </p>'; 	
			   }



?>
