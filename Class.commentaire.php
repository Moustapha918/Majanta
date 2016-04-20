<?php


class Commentaire
{
	private $id;
	private $auteur;
	private $contenu;
	private $ID_ligneDeMur;
	private $date_com;
	private $bdd;
	
	/*public __construct($auteur = null,$contenu = null,$ID_ligneDeMur = null)
	{
		$this->auteur = $auteur;
		$this->contenu = $contenu;
		$this->ID_ligneDeMur = $ID_ligneDeMur;
		
	}*/
	
	public function hydrater($auteur = null,$contenu = null,$ID_ligneDeMur = null){
		
		$this->auteur = $auteur;
		$this->contenu = $contenu;
		$this->ID_ligneDeMur = $ID_ligneDeMur;
	}
	
	private	function connecter_bdd(){
	try{
			$bdd = new PDO('mysql:host=localhost; dbname=net_social;','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{echo $e->getMessage();}
		return $bdd;
	}
	public function commenter()
	{
		$this->bdd = $this->connecter_bdd();
		$requette = $this->bdd->prepare('INSERT INTO commentaires(contenu,auteur,ID_ligneDeMur,date_com) VALUES(:contenu,:auteur,:ID_ligneDeMur,NOW())');
		$requette->execute(array('contenu' => $this->contenu,
							 'auteur' => $this->auteur,
							 'ID_ligneDeMur' => $this->ID_ligneDeMur,));
		// $not = $this->bdd('INSERT INTO notifications()')
	}
	
	public function afficher_commentaire($id)
	{
		$this->bdd = $this->connecter_bdd();
		$requette = $this->bdd->prepare('SELECT * FROM commentaires WHERE ID_ligneDeMur = :ID ORDER BY date_com DESC');
		$requette->execute(array('ID' => $id));
		while($rep = $requette->fetch())
		{
			?>
			<p class="lgcom"align ="center"><a href="profile.php?pseudo=<?php  echo $rep['auteur']; ?>"><?php  echo $rep['auteur'].'</a> : '.$rep['contenu']; ?> </br></p>
			<?php	
		}
	}
}
?>
