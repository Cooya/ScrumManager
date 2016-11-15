<?php

  include 'databaseConnection.php';
  $message = "";
   project = $( "#project" ),
      description = $( "#description" ),
      developper = $( "#developper" ),
      sprint = $( "#sprint" ),
      status = $( "#status" ),
      duration = $( "#duration" );

    if(empty($_POST['project']) || empty( $_POST['description']) || empty($_POST['developper']) || empty($_POST['sprint']) || empty($_POST['status'])|| empty($_POST['duration'])) {
      $message = '<p style="color: red">Missing fields for creating a task</p>';
    
    else {
      $project = $_POST['project'];
      $description = $_POST['description'];
      $developper =$_POST['developper'];
      $sprint = $_POST['sprint'];
      $status = $_POST['status'];
      $duration = $_POST['duration'];

      $sql = "INSERT INTO task (project, description, developper, sprint, status, duration) VALUES ('$project', '$description', '$developper', '$sprint', '$status', '$duration')";
      if($db->query($sql)) {
        $message = '<p style="color: green">Success.</p>';
      }
   
    }
  }
?>