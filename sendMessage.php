<?php
session_start();
require 'connectDB.php';

                        $stmt2 = $db->prepare("INSERT INTO chat_messages ( USER,MSG,CHAT_ID) VALUES (:idd, :msg,:tarid)");
                        $stmt2->bindParam(":idd", $_SESSION["ID"]);
                        $stmt2->bindParam(":tarid", $_POST["target"]);
						 $stmt2->bindParam(":msg", $_POST["msg"]);
						$stmt2->execute();
?>