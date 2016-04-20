<?php 
session_start();
require_once("Class.amis.php");
$ami = new amis();
$ami->envoi_dem($_GET['pseudo']);
header("Location: profile.php?pseudo=".$_GET['pseudo']);
?>