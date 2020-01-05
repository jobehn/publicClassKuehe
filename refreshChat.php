<?php
			session_start();
			require 'connectDB.php';
            $stmt = $db->prepare("SELECT * FROM chat_messages WHERE USER = :uid AND CHAT_ID = :rid OR USER = :rid AND CHAT_ID = :uid  ORDER BY TIME ASC  ");
            $stmt->bindParam(":uid",$_SESSION['ID']);
			$stmt->bindParam(":rid",$_POST['target']);
            $stmt->execute();
            $count = $stmt->rowCount();

			$result='';
		//	$result.='h';
			if($count >0){
			//$result.='h';
			while($row = $stmt->fetch()){
			if($row['CHAT_ID'] == $_SESSION['ID']){
				//$result .= '<div id="msg"'.$row['ID'].' class="msgdiv"><div class="time">'.$row['TIME'].'</div><div class="textmsg">'.$row['MSG'].'</div><div class="whom">'.$_POST['tarname'].'</div></div>';
					$result.= '<div id="msg"'.$row['ID'].' class="msgdiv"><div class="time">'.$row['TIME'].'</div><div class="textmsg"><p>'.$row['MSG'].'</p></div><div class="whom">'.$_POST['tarname'].'</div><div id="haken'.$row['GELESEN'].'">&#10004</div></div>';
			}else{
			//$result .= '<div id="msg"'.$row['ID'].' class="msgdiv"><div class="time">'.$row['TIME'].'</div><div class="textmsg">'.$row['MSG'].'</div><div class="whom">You</div></div>';
				$result.= '<div id="msg"'.$row['ID'].' class="msgdiv"><div class="time">'.$row['TIME'].'</div><div class="textmsg"><p>'.$row['MSG'].'</p></div><div class="whom">You</div><div id="haken'.$row['GELESEN'].'"> &#10004</div></div>';
		}
			}
			
			}
			echo $result;

?>