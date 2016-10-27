<html>

<?php
 $message='';
    if (empty($_POST['login']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>an error has occured. Please check all the fields </p>
    <p>Click<a href="./loginPage.php">here</a> to go back</p>';
    }
    else{


	  
    try {
        $connexion = new PDO('mysql:host=localhost;dbname=Projectmanager;charset=utf8', 'root', 'root');

    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());}

    

    }

    $login=$_POST['login']; 
	$password=md5($_POST['password']);

	$data = $connexion->query("SELECT login, password FROM user WHERE login = '$login'");
	if($result = $data->fetch()){
    	if ($result['login'] == $login && $result['password']==$password) // Acces OK !
		 {
		 	session_start();
			$_SESSION['login'] = $result['login'];
			$_SESSION['password'] = $result['password'];
			$message = '<p>Bienvenue '.$result['login'].', 
			            vous êtes maintenant connecté!</p>
			            <p>Cliquez <a href="./index.html">ici</a> 
			            pour revenir à la page d accueil</p>';
			            echo $message; 		
include "AddContributor.php";
		}
	}

?>


</html>