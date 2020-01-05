<?php	

			try{
				$db = new PDO('mysql:host=localhost;dbname=chatdb','root','');
				
			}catch(PDOException $e){
				exit;
			}
?>