<html>
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
 <div class="corp">
    <div class="ligne">
      <div class="cellule"><input type="text" name="date" size="10" value=""/></div>
    <?php
      $sql1 = "SELECT id, developper_Id, status FROM task"; 

      $result1 = $db->query($sql1);
      $data1 = $result1->fetch();


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
                <div class="cellule">' . $data1['id'] . '</div>
                <div class="cellule">' . $data1['developper_Id'] . '</div>
                <div class="cellule">' . $a . '</div>
                <div class="cellule">' . $b . '</div>
                <div class="cellule">' . $c . '</div>
                <div class="cellule">' . $d . '</div>
          </div>
          ';
      } 
    ?>

 
    
</section>
<h2> user stories</h2>
<ul>
 <?php
      $sql1 = "SELECT description FROM us"; 

      $result1 = $db->query($sql1);
      $data1 = $result1->fetch();


      while($data1 = $result1->fetch()) {
        echo '<li> '. $data1['description'] .' <li>';

      } 
    ?>
</ul>

<h2> Taches</h2>
<ul>
 <?php
      $sql1 = "SELECT id,description FROM task"; 

      $result1 = $db->query($sql1);
      $data1 = $result1->fetch();


      while($data1 = $result1->fetch()) {
        echo '<li> Tache '. $data1['id'].' : '. $data1['description'] .' <li>';

      } 
    ?>
</ul>




</body>
</html>