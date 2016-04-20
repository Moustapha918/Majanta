<?php
//session_start();
require_once("class.ligneDeMur.php");
error_reporting(E_ALL);

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

	


class chat
{    
    private $pseudo_exp = null;
    private $pseudo_des = null;
	private $contenu = null;
	private $tile = null;
	
	
	public function __construct()
    {
		
    }
	
	private function connecter_bdd(){
	try{
		$bdd = new PDO('mysql:host=localhost; dbname=net_social;','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{echo $e->getMessage();}
		return $bdd;
	}
		
		public function recup_membre_enligne(){
			
				$bdd = $this->connecter_bdd();
				$query = $bdd->prepare("
				SELECT *
				FROM Membre_enligne
				WHERE online_pseudo = :pseudo 
				");
				$query->execute(array('pseudo'=> $_SESSION['pseudo']));
				$nbre = $query->rowCount();
				$donnee = $query->fetch();
				 if($nbre == 0) {
				  $insert = $bdd->prepare('
				INSERT INTO  Membre_enligne(online_pseudo, online_ip,
				online_status, online_time) 
				VALUES(:pseudo, :ip, :status, :time)
				');
				  $insert->execute(array(
				   'pseudo' => $_SESSION['pseudo'],
				   'ip' => $_SERVER["REMOTE_ADDR"],
				   'status' => '2',
				   'time' => time()
				  ));

				} else {
				  $update = $bdd->prepare('UPDATE Membre_enligne SET online_time =:time WHERE online_pseudo = :pseudo');
				  $update->execute(array(
				   'time' => time(),
				   'pseudo' => $_SESSION['pseudo']
				  ));
				  }
				$query->closeCursor();

				 //On supprime les membres qui ne sont pas sur le chat

				$time_out = time()-5;
				$delete = $bdd->prepare('DELETE FROM Membre_enligne WHERE online_time < :time');
				$delete->execute(array(
				 'time' => $time_out
				));



				$req = $bdd->prepare('SELECT membre_enligne.online_pseudo as ami_enligne, membre_enligne.online_status  FROM membre,amis,membre_enligne 
										   WHERE ((membre_enligne.online_pseudo =  amis.pseudo_exp AND amis.pseudo_des= :pseudo AND active = 1)
																	OR 
																	(membre_enligne.online_pseudo =  amis.pseudo_des AND  amis.pseudo_exp = :pseudo AND active=1))
																	AND membre.pseudo = membre_enligne.online_pseudo');
				$req->execute(array(":pseudo" => $_SESSION['pseudo']));
				$i=0;
				 $nbamis = $req->rowCount();
				 if($nbamis != 0){
				while($rep= $req->fetch()){
					$info['status'] = $rep['online_status'];
					$info['pseudo'] = $rep['ami_enligne'] ;
					$data[$i] = $info;
					 $i++;
				}

				$json['list'] = $data;
				echo json_encode($json);
			}
	}
	
}
?>	