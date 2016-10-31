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
		echo '<p style="color:green;"> Your project has been added </p>';

	echo '<p style="color:red;"><a href=./newProject.html> Back </a></p>'; 	
				}



	else {
		echo '<p style="color:red;"> Please complete the entry fields with valid values! please click <a href=./newProject.html> here </a> to resume </p>'; 	
			   }



?>
