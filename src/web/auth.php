<html>
<?php
	include 'databaseConnection.php';
	$message = '';
	    if (empty($_POST['login']) || empty($_POST['password']) ) //Oublie d'un champ
	    {
	        $message = '<p>an error has occured. Please check all the fields </p>
	    <p>Click<a href="./loginPage.php">here</a> to go back</p>';
	    }
	    else{

	    $login=$_POST['login']; 
		$password=md5($_POST['password']);

		$data = $db->query("SELECT login, password FROM user WHERE login = '$login'");
		if($result = $data->fetch()){
	    	if ($result['login'] == $login && $result['password']==$password) // Acces OK !
			 {
			 	session_start();
				$_SESSION['login'] = $result['login'];
				$_SESSION['password'] = $result['password'];
				$message = '<p>Hi '.$result['login'].', 
				            You are now connected !!</p>
				            <p>Click <a href="./projectList.php">here</a> 
				            to see the list of projects </p>';
				            echo $message; 		
	include "AddContributor.php";
		}
	}
?>
</html>