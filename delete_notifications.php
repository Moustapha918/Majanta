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
$query = $bdd->prepare("DELETE FROM notifications WHERE pseudo_des = :pseudo_des AND pseudo_exp = :pseudo_exp AND type='message'");
$query->execute(array('pseudo_des' => $_SESSION['pseudo'], 'pseudo_exp' => $_GET['pseudo']));

?>