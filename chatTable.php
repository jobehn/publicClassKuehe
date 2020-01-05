<?php
session_start();
require 'connectDB.php';




//echo 'asd';
 $stmt = $db->prepare("SELECT * FROM chat_user WHERE ID != :id  ");
            $stmt->bindParam(":id", $_SESSION["ID"]);
            $stmt->execute();
            $count = $stmt->rowCount();
			$result='';
			if($count > 0){
			$result .= '<table id ="tabl"><tr><th>Username</th><th>Status</th><th>Kontakt</th></tr>';
			while($row = $stmt->fetch()){
			$stmt2 = $db->prepare("SELECT * FROM chat_messages WHERE USER = :rid AND CHAT_ID = :uid AND GELESEN = 0 ");
            $stmt2->bindParam(":uid",$_SESSION['ID']);
			$stmt2->bindParam(":rid",$row['ID']);			
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
			if(!($count2 ==0)){
					$result .= '<tr><td>'. $row['USERNAME'].'</td><td><div id="kreis'.$row['Tutor'].'"></div></td><td><button type="button" class="messageMe" data-targetUser = "'.$row['USERNAME'].'" data-targetUserID = "'.$row['ID'].'">Chat</button><div id="newmessage">'.$count2.' new Messenges</div></td></tr>';
			}else{
				$result .= '<tr><td>'. $row['USERNAME'].'</td><td><div id="kreis'.$row['Tutor'].'"></div></td><td><button type="button" class="messageMe" data-targetUser = "'.$row['USERNAME'].'" data-targetUserID = "'.$row['ID'].'">Chat</button><div id="newmessage"></div></td></tr>';
			}
			}
			$result .= '</table>';
			}
			
	echo $result;

?>