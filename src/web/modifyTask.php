<?php
  session_start();
  if(!isset($_SESSION['login'])) {
    header('Location: login.php');
  }
  include 'databaseConnection.php';
  
    if($_SERVER["REQUEST_METHOD"] == "POST") {

      $task = $_POST['taskid'];
      $description = $_POST['description'];
      $sprint = $_POST['sprint'];
      $status = $_POST['status'];
      $duration = $_POST['duration'];

      $sql = "UPDATE task SET id = '$task', description = '$description', sprint = '$sprint', status='$status', duration='$duration'
            WHERE id = '$task'";     
    
      $db->query($sql);
     
      }

?>
  

    <script>
          $(function() {


        modifyDialog = $("#modifyDialog").dialog({
          autoOpen: false,
          height: 600,
          width: 700,
          modal: true,
          buttons: {
            "Modify Task": function() {
              modifyDialog.find("form").submit();
              modifyDialog.dialog("close");
            },
            Cancel: function() {
                modifyDialog.dialog("close");
            }
          },
          close: function() {

          }
        });

        openModifyDialog = function(usObj) {
          $("#modifyDialog > form > fieldset > input, textarea").each(function(index, elt) {
            if(elt.name != 'action')
              elt.value = usObj[elt.name];
          });
          modifyDialog.dialog('open');
        }
      });
    </script>


  <div id="modifyDialog" title="Modify Task">
    <form method="POST">
      <fieldset>
      <label for="taskid">Task id</label>
      <input type="number" name="taskid" id="taskid" class="text ui-widget-content ui-corner-all">
      <label for="description">description</label>
      <input type="text" name="description" id="description" class="text ui-widget-content ui-corner-all">
      <label for="developer">developer login</label>
      <input type="text" name="developer" id="developer"  class="text ui-widget-content ui-corner-all">
      <label for="sprint">sprint</label>
      <input type="number" name="sprint" id="sprint"  class="text ui-widget-content ui-corner-all">
      <label for="status">status</label>
      <input type="number" name="status" id="status"  class="text ui-widget-content ui-corner-all">
      <label for="duration">duration</label>
      <input type="number" name="duration" id="duration"  class="text ui-widget-content ui-corner-all">

      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
      </fieldset>
    </form>
  </div>

