<?php 
	require_once("Class.amis.php");
	$ami = new amis();
	$ami->nb_notifications($_SESSION['pseudo']);

?>