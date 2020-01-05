<!DOCTYPE html>
<html lang="de">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <meta charset="utf-8">
  
  <style>



  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  </head>

<body>
<?php 
require 'connectDB.php';

if(isset($_POST["subm"]) && !empty($_POST["pass"]) && !empty($_POST["username"]) ){

            $stmt = $db->prepare("SELECT * FROM chat_user WHERE USERNAME = :user  ");
            $stmt->bindParam(":user", $_POST["username"]);
            $stmt->execute();
            $count = $stmt->rowCount();
			if($count == 1){

                //        session_start();
				$triesLogin = $stmt->fetch();
                if (password_verify($_POST["pass"], $triesLogin["PASSWORD"])) {
				
                    session_start();
                    $_SESSION["ID"] = $triesLogin["ID"];
					$stmt2 = $db->prepare("UPDATE chat_user SET Tutor = 1 WHERE ID = :idn");
					$stmt2->bindParam(":idn", $triesLogin["ID"]);
					$stmt2->execute();
					header('Location: menu.php');
				}else{
					echo 'falsches Passwort';
				}
			}else{
			echo 'Benutzername falsch';
			}



}



?>

<form action="login.php" method="POST">
  <input type="text" name="username" placeholder="Benutzername" ><br>
  <input type="password" name="pass" placeholder="Passwort"><br>
  <input type="submit" value="Einloggen" name="subm">
</form>

</body>
</html>