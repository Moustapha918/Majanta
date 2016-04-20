<?php
session_start();
function connecter_bdd(){
	try{
		$bdd = new PDO('mysql:host=localhost; dbname=net_social;','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{echo $e->getMessage();}
		return $bdd;
	}
	
$bdd = connecter_bdd();
$messages=trim(htmlentities(mysql_real_escape_string($_POST['message'])));
$query = $bdd->query("
INSERT INTO messages(id_message , pseudo_exp , pseudo_des , contenu) VALUES('','{$_SESSION['pseudo']}','{$_POST['pseudo']}','{$messages}')
");
$query = $bdd->query("
INSERT INTO notifications(ID , pseudo_exp , pseudo_des , type) VALUES('','{$_SESSION['pseudo']}','{$_POST['pseudo']}','message')
");

?>