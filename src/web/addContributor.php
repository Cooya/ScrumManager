<html>
<?php
session_start();

/* 
si la variable de session login n'existe pas cela siginifie que le visiteur 
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres
*/
if(!isset($_SESSION['login'])) {
  echo 'Vous n\'êtes pas autoris´ à acceder à cette zone';
  include('loginPage.php');
  exit;
}
?>
  <head>
  <link rel="stylesheet" href="assets/css/navigationBar.css" />
  <link rel="stylesheet" href="assets/css/loginSignin.css" />

    <title>Login</title>
  </head>
<body>

<ul id="horiz_menu">

  <li class="bouton_menu"><a href="Logout.php"><img src="assets/images/logout.png" alt="logout" />Logout</a></li>

  <li class="bouton_menu"><a href="projectList.php"><img src="assets/images/list.png" alt="projectlist" />Project List</a></li>

  <li class="bouton_menu"><a href="newProject.html"><img src="assets/images/newproject.png" alt="newproject" />New Project</a></li>

</ul>
<input type="email" name="Developper" placeholder="add new contributor email"><button type="button" class="boutonCont">+</button>
<input type="email" name="contributor" placeholder="add new contributor email"><button type="button" class="boutonCont">+</button>
<input type="email" name="contributor" placeholder="add new contributor email"><button type="button" class="boutonCont">+</button>


</body>
</html>