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
$query = $bdd->prepare("SELECT pseudo_exp,contenu
FROM messages
WHERE (pseudo_exp = :pseudo AND pseudo_des = :session)
	  OR ( pseudo_exp = :session AND pseudo_des = :pseudo)
");
$query->execute(array('pseudo' => $_POST['pseudo'], 'session' => $_SESSION['pseudo']));

$messages=array();
while ($rows = $query->fetch())
{
$messages[] = $rows;
}
foreach($messages as $message)
{
?>
<a href='#' align="center"><?php echo $message['pseudo_exp'];?></a>
<p><?php echo nl2br($message['contenu']); ?></p>
<?php
}

?>