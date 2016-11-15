
  <script>
  $( function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      project = $( "#project" ),
      description = $( "#description" ),
      developper = $( "#developper" ),
      sprint = $( "#sprint" ),
      status = $( "#status" ),
      duration = $( "#duration" );
 
   
 
    function addTask() {
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
       $.ajax({
       url : 'addTaskHandler.php',
       type : 'POST', 
       data : 'project=' + project.val() + '&contenu=' + description.val()+'&developper=' +developper.val() + '&sprint=' +sprint.val() + '&status=' + status.val() +'&duration='+ duration.val(), 
       dataType : 'html',  
       success : function(code_html, statut){ 
           alert(code_html );
       },

       error : function(resultat, statut, erreur){
          alert(resultat);
       }
            });
  
        addTask();
     
    
    });

 
    $( "#create-task" ).button().on( "click", function() {

      dialog.dialog( "open" );
    });
  } );
  </script>
 
<div id="dialog-form" title="Create new Task">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
    <fieldset>
       <label for="project">Project id</label>
      <input type="text" name="project" id="project" class="text ui-widget-content ui-corner-all">
      <label for="description">description</label>
      <input type="text" name="description" id="description" class="text ui-widget-content ui-corner-all">
      <label for="developper">developper Id</label>
      <input type="text" name="developper" id="developper"  class="text ui-widget-content ui-corner-all">
      <label for="sprint">sprint</label>
      <input type="text" name="sprint" id="sprint"  class="text ui-widget-content ui-corner-all">
      <label for="status">status</label>
      <input type="text" name="status" id="status"  class="text ui-widget-content ui-corner-all">
      <label for="duration">duration</label>
      <input type="text" name="duration" id="duration"  class="text ui-widget-content ui-corner-all">

      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
 
 
<button id="create-task">Create new task</button>
 
