<?php

echo'
<html>
  <head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

  <link rel="stylesheet" href="assets/css/navigationBar.css" />
  <link rel="stylesheet" href="assets/css/newProject.css" />

    <title>Scrum Manager</title>

  </head>

<body>


<ul id="horiz_menu">

	<li class="bouton_menu"><a href="logOut.php"><img src="assets/images/logout.png" alt="logout" />Logout</a></li>

	<li class="bouton_menu"><a href="projectList.php"><img src="assets/images/list.png" alt="projectlist" />Project List</a></li>

	<li class="bouton_menu"><a href="newProject.html"><img src="assets/images/newproject.png" alt="newproject" />New Project</a></li>

</ul>






<H1> Projects List</H1>

</body>
</html>';



// on se connecte à MySQL
$db = mysql_connect('localhost', 'root', 'root');

// on sélectionne la base
mysql_select_db('Projectmanager',$db);


// On récupére les champs de la table workshop 


$sql = "SELECT id,name,contributors,last_update,creation_date,repository_link FROM project"; 

$sql2 = "SELECT login FROM user,project WHERE user.id=project.owner"; 


// on envoie la requête
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());  

$req2 = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());  


$data2 = mysql_fetch_array($req2);


echo '<table  border="1">'; 

    echo '<tr>';
    echo '<td>';
    echo '<b>Name</b>'; 
    echo '</td>';

    echo '<td>';
    echo '<b>Owner</b>'; 
    echo '</td>';


    echo '<td>';
    echo '<b>Last update</b>'; 
    echo '</td>';


    echo '<td>';
    echo '<b>Creation date</b>'; 
    echo '</td>';


    echo '<td>';
    echo '<b>Repository Link</b>'; 
    echo '</td>';



    echo '</tr>';


while($data = mysql_fetch_array($req)) 
    {
    // on affiche les informations de l'enregstrement en cours

    echo '<tr>';
    echo '<td>';
    echo '<b>'.$data['name'].'</b>'; 
    echo '</td>';
 
    echo '<td>';
    echo '<b>'.$data2['login'].'</b>'; 
    echo '</td>';

    echo '<td>';
    echo '<b>'.$data['last_update'].'</b>'; 
    echo '</td>';


    echo '<td>';
    echo '<b>'.$data['creation_date'].'</b>'; 
    echo '</td>';


    echo '<td>';
    echo '<b>'.$data['repository_link'].'</b>'; 
    echo '</td>';

    echo '</tr>';
    } 
 echo '</table>';
// on ferme la connexion à mysql
mysql_close();  




?>


