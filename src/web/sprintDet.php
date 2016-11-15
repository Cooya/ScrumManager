<html>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
//  session_start();
  //if(!isset($_SESSION['login'])) {
    //header('Location: loginPage.php');
  //}
  include 'databaseConnection.php';
?>

<body>
  <head>
    <title>ScrumManager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>


<section class="tableau">

  <div class="colgroupe">
    <div class="col"></div>
    <div class="col"></div>

  </div>
  <div class="legende">Kanban Sprint</div>
  <header class="tete">
    <div class="cellule">Task id</div>
    <div class="cellule">Developper</div>
    <div class="cellule">To do</div>
    <div class="cellule">On going</div>
    <div class="cellule">On testing</div>
    <div class="cellule">Done</div>


  </header>
 <div  class="corp">
    <?php
      $sql1 = "SELECT id, developper_Id, status FROM task"; 

      $result1 = $db->query($sql1);


      while($data1 = $result1->fetch()) {
        $a='';
        $b='';
        $c='';
        $d='';
        if($data1['status']==0)
          $a='X';
        if($data1['status']==1)
          $b='X';
        if($data1['status']==2)
          $c='X';
        if($data1['status']==3)
          $d='X';

          echo '
                <div class="ligne">
                <div class="cellule" ><p onclick="myFunction();this.onclick=null;" id="tmp">
' . $data1['id'] . '</p></div>
                <div class="cellule">' . $data1['developper_Id'] . '</div>
                <div class="cellule">' . $a . '</div>
                <div class="cellule">' . $b . '</div>
                <div class="cellule">' . $c . '</div>
                <div class="cellule">' . $d . '</div>
          </div>

          <script>
        function myFunction() {
        document.getElementById("tmp").innerHTML =
        "<input type=\"text\" >"
 ;
    }
</script>
          ';
      } 
    ?>

 
    
</section>
<h2> user stories</h2>
<ul>
 <?php
      $sql1 = "SELECT id,description FROM us"; 

      $result1 = $db->query($sql1);


      while($data1 = $result1->fetch()) {
        echo '<li> UserStorie '. $data1[id] . ' : '. $data1['description'] .' </li>';

      } 
    ?>
</ul>

<h2> Taches</h2>
<ul>
 <div id="task" class="corp">
 <?php
      $sql1 = "SELECT id,description FROM task"; 

      $result1 = $db->query($sql1);
        include 'addTask.php';



      while($data1 = $result1->fetch()) {
        echo '<li> Tache '. $data1['id'].' : '. $data1['description'] .' </li>';
        echo '  
        <a href="registration.php"><img src="assets/images/update.png"/></a>
        <a href="index.php"><img src="assets/images/delete.png" /></a>';

      } 
    ?>
     </div >
</ul>




</body>
</html>