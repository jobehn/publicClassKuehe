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
if(isset($_POST["subm"]) && !empty($_POST["pass"]) && !empty($_POST["passrepeat"]) && !empty($_POST["username"]) && !empty($_POST["email"])){
if(1){
if($_POST["passrepeat"] == $_POST["pass"]){
            $stmt = $db->prepare("SELECT * FROM chat_user WHERE USERNAME = :user  OR EMAIL = :email");
            $stmt->bindParam(":user", $_POST["username"]);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            $count = $stmt->rowCount();
			if($count == 0){
                        $stmt = $db->prepare("INSERT INTO chat_user (USERNAME, EMAIL, PASSWORD) VALUES (:user, :email, :pw)");
                        $stmt->bindParam(":user", $_POST["username"]);
                        $hashpw = password_hash($_POST["pass"], PASSWORD_BCRYPT);
                        $stmt->bindParam(":pw", $hashpw);
                        $stmt->bindParam(":email", $_POST["email"]);
                        $stmt->execute();
						header("Location: login.php");
			
			}else{
			echo 'E-Mail/Benutzername schon vergeben.';
			}


}else{
echo 'Passwörter müssen übereinstimmen';
}
}else{
echo 'Passwörter der Form ein Groß/Kleinbuchstabe, eineZahl mit einer Länge von 8 Zeichen';
}

}

?>

<form action="register.php" method="POST">
  <input type="text" name="username" placeholder="Benutzername" ><br>
  <input type="email" name="email" placeholder="E-Mail"><br>
  <input type="password" name="pass" placeholder="Passwort"><br>
  <input type="password" name="passrepeat" placeholder="Passwort wiederholen"><br>
  <input type="submit" value="Registrieren" name="subm">
</form>

</body>
</html>