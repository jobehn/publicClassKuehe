<?php
			session_start();
			require 'connectDB.php';
			$stmt = $db->prepare("UPDATE chat_messages SET GELESEN = 1 WHERE USER = :rid AND CHAT_ID = :uid AND GELESEN = 0 ");
            //$stmt = $db->prepare("SELECT * FROM chat_messages WHERE USER = :uid AND CHAT_ID = :rid AND GELESEN = 0 ORDER BY TIME ASC  ");
            $stmt->bindParam(":uid",$_SESSION['ID']);
			$stmt->bindParam(":rid",$_POST['target']);
            $stmt->execute();

?>
