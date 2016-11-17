
  <script>
  $( function() {
    var dialog, form,
       taskid = $( "#taskid" ),
      description = $( "#description" ),
      developer = $( "#developer" ),
      sprint = $( "#sprint" ),
      status = $( "#status" ),
      duration = $( "#duration" );
      project = $( "#project" );

 
   
 
    function addTask() {
      $.ajax({
       url : 'addTaskHandler.php',
       type : 'POST', 
       data : 'taskid=' + taskid.val() + '&project=' + project.val() +  '&description=' + description.val()+ '&developer=' + developer.val() + '&sprint=' +sprint.val() + '&status=' + status.val() +'&duration='+ duration.val(), 
       dataType : 'html',
            success : function(code_html, statut){ 
            $( "#task" ).append( "<li>" +
          "Task  "+ taskid.val() +" : " + description.val() + "</td>" + 
              "</li>" ) ;
        dialog.dialog( "close" );       },

       error : function(resultat, statut, erreur){
      alert("erreur"+erreur);
       }
     });
    
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
     
      <label for="taskid">Task id</label>
      <input type="number" name="taskid" id="taskid" class="text ui-widget-content ui-corner-all">
      <input  type ="hidden"  id="project" value= <?php echo $_GET['projectId']; ?> >

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
 
 
<button id="create-task">Create new task</button>
 
