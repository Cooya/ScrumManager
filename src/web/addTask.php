
  <script>
  $( function() {
    var dialog, form,
       project = $( "#project" ),
      description = $( "#description" ),
      developer = $( "#developer" ),
      sprint = $( "#sprint" ),
      status = $( "#status" ),
      duration = $( "#duration" );
 
   
 
    function addTask() {
      $.ajax({
       url : 'addTaskHandler.php',
       type : 'POST', 
       data : 'project=' + project.val() + '&description=' + description.val()+'&developer=' +developer.val() + '&sprint=' +sprint.val() + '&status=' + status.val() +'&duration='+ duration.val(), 
       dataType : 'html',
     });
    
       
  
      var valid = true;
 
      if ( valid ) {
        $( "#task" ).append( "<li>" +
          "Tache : " + description.val() + "</td>" +
          
        "</li>" ) +
        dialog.dialog( "close" );
      }
      return valid;
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 600,
      width: 350,
      modal: true,
      buttons: {
        "Create a task": addTask,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
       
        addTask();
     
    
    });

 
    $( "#create-task" ).button().on( "click", function() {

      dialog.dialog( "open" );
    });
  } );
  </script>
 
<div id="dialog-form" title="Create new Task">
 
  <form>
    <fieldset>
       <label for="project">Project id</label>
      <input type="number" name="project" id="project" class="text ui-widget-content ui-corner-all">
      <label for="description">description</label>
      <input type="text" name="description" id="description" class="text ui-widget-content ui-corner-all">
      <label for="developer">developer Id</label>
      <input type="number" name="developer" id="developer"  class="text ui-widget-content ui-corner-all">
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
 
 
<button id="create-task">Create new task</button>
 
