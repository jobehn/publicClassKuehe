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
  <title>Chat </title>
  <meta charset="utf-8">
  <style>
  html{
  font-family:Arial;
  }
  #tutorlist{
  width:50%;
  height:500px;
  background-color:#f2f5fa;
  }
  #tabl{
  height:100%;
  width:100%;
  }
  #kreis1{
  width:20px;
  height:20px;
  border-radius:10px;
  background-color:#00ff00;  
  }
  
  #kreis0{
  width:20px;
  height:20px;
  border-radius:10px;
  background-color:#ff0000;
  }
  
    
.chatBox{
display:flex;
flex-direction:column;
justify-content:center;
text-align:center;
height:400px;
overflow:scroll;
width:100%;
}
.msgdiv{
border-bottom:1px solid #d0d3d6;


}
.time{
display:flex;
justify-content:center;
text-align:center;
font-size:8px;
}
.textmsg{
display:flex;
justify-content:center;
text-align:center;
}
.whom {

font-size:10px;
display:flex;
justify-content:left;
text-align:left;
}
.cDIV{
width:100%;
height:100%;
background-color:green;
}

#haken1{
width:20px;
display:block;

color:#55b7ff;
}
#haken0{
width:20px;
display:block;

color:#e3e3e3;

}
.log{
text-decoration:none;
color:#2a2a2a;
}
.log:hover{
color:#a2a2a2;
}
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  </head>

<body>
<a class="log" href="logout.php">logout</a>

<h1>Tutorenliste: </h1>
<div id="tutorlist">

<script>
$(document).ready(function(){
userTable();
setInterval(function(){
userTable();
updateChat();


},3000);
function userTable(){
$.ajax({
url: "chatTable.php",
method:"POST",
success:function(data){
$("#tutorlist").html(data);
}

});
}


function updateChat(){
$('.chatBox').each(function(){
var name =$(this).attr('data-targetname');
var id =$(this).attr('data-targetid');
refreshChatBox(name,id);
});
}

function createChatString(chatPartner,chatPartnerId) {
var htmlChat= '<div id="chatDiv'+chatPartnerId+'" class="cDIV">Chat with '+chatPartner+'<div id="chatBox'+chatPartnerId+'" class="chatBox" data-targetname="'+chatPartner+'"data-targetid="'+chatPartnerId+'"></div><div id="messageBox'+chatPartnerId+'" class="box"><textarea id ="textBox'+chatPartnerId+'"></textarea><button type="button" id="messageButton'+chatPartnerId+'" class="messageButton" data-targetName="'+chatPartner+'"data-targetID="'+chatPartnerId+'">Send</button></div></div>' ;
return htmlChat;
}

function refreshChatBox(tname,targetid){
$.ajax({
url: "refreshChat.php",
method:"POST",
data:{target:targetid,tarname:tname},
success:function(data){
$('#chatBox'+targetid).html(data);
}
});

}

function updateActivity(targetID,targetName){
$.ajax({
url: "updateActivity.php",
method:"POST",
data:{target:targetID,tarname:targetName},
success:function(data){

}
});
}



$(document).on('click','.messageMe',function(){
var targetID = $(this).attr('data-targetUserID');
var targetName = $(this).attr('data-targetUser');
var chatString = createChatString(targetName,targetID);
$("#NVchatBox").html(chatString);
  $("#chatDiv"+targetID).dialog({
    autoOpen : false, modal : true, show : "blind", hide : "blind"
  });
  $("#chatDiv"+targetID).dialog('open');
  refreshChatBox(targetName,targetID);
	boxInterval = setInterval(function(){
	updateActivity(targetID,targetName);
	if($('#chatDiv'+targetID).dialog('isOpen') === true){
		
	}else{
		clearInterval(boxInterval);
	}
	},3000);
  /*boxInterval= setInterval(function(){
	updateActivity(targetID);
	if($('#chatDiv'+targetID).dialog('isOpen') === true){
	
	}else{
		clearInterval(boxInterval);
	}
  ,3000}*/
});
$(document).on('click','.messageButton',function(){
var targetID = $(this).attr('data-targetID');
var targetName = $(this).attr('data-targetName'); 
var msgraw =$('#textBox'+targetID).val();
if(!(msgraw === '' || msgraw === ' ')){
$.ajax({
url: "sendMessage.php",
method:"POST",
data:{target:targetID,msg:msgraw},
success:function(data){
refreshChatBox(targetName,targetID);
$('#textBox'+targetID).val('');
}
});}
});

});
</script>

</div> 
<div id="NVchatBox"></div>
</body>
</html>