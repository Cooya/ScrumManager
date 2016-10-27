<html>

<?php
 $message='';

if(empty($_POST['login'])||empty( $_POST['password'])||empty($_POST['name']) || empty($_POST['surname'])||empty($_POST['email']))
   //if (empty($_POST['login']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>an error has occured. Please check all the fields </p>
    <p>Click <a href="./signinPage.php">here</a> to go back</p>';
    echo $message;
    }
else{
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    try {
        $connexion = new PDO('mysql:host=localhost;dbname=Projectmanager;charset=utf8', 'root', 'root');

    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $data = $connexion->query("SELECT login FROM user WHERE login = '$login'");
    if($result = $data->fetch()){
        echo "ce login existe deja";
        include "signinPage.php";

    }
    else
    {
     $data=$connexion->query("INSERT INTO user (login, password, name, surname, mail) VALUES ('$login', '$password', '$name', '$surname', '$email')");
   //page de creation de projet

     include "loginPage.php";
    }

    }




?>


</html>