<?php
session_start();
require 'connectDB.php';
					$stmt2 = $db->prepare("UPDATE chat_user SET Tutor = 0 WHERE ID = :idn");
					$stmt2->bindParam(":idn", $_SESSION["ID"]);
					$stmt2->execute();
session_destroy();
header("Location: login.php");
?>