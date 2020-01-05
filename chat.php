<?php
session_start();
if(!isset($_SESSION['ID'])){
header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <meta charset="utf-8">
  
  <style>

  #chatBox{
display:flex;
justify-content:center;
text-align:center;
height:200px;
width:20%;

}

  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  </head>

<body>
<div id="chatBox" class="box">

</div>
<div id="messageBox" class="box">
<textarea></textarea>
<button type="button" id="messageButton">PRESS</button>
</div>
<script>
$(document).ready(function(){
  $("#messageButton").click(function(){
 
    var msg = $('textarea').val();
	// alert(msg);
	$('#chatBox').html(msg);
	//$.post( "test.php", $( "#testform" ).serialize() );
  });
});
</script>  
</body>
</html>