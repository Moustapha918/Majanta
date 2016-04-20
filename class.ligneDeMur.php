<?php

error_reporting(E_ALL);

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

require_once('class.Membre_priv.php');
require_once('Class.commentaire.php');

class ligneDeMur

{
    private $ID = null;
    private $titre = null;
    private $contenu = null;
	private $pseudo_mur = null;
	private $pseudo_partager = null;
	private $date_pub = null;
	private $image = null;
	private $commentaire;

    // --- OPERATIONS ---
	
	public function __construct($contenu = null,$titre = null)
    {
        $this->titre = htmlspecialchars($titre);
		$this->contenu = htmlspecialchars($contenu);
		$this->pseudo_mur = htmlspecialchars($_SESSION['pseudo']);
		$this->pseudo_partager = htmlspecialchars($_SESSION['pseudo']);
		$this->commentaire = new Commentaire();
    }
	
	private	function connecter_bdd(){
	try{
		$bdd = new PDO('mysql:host=localhost; dbname=net_social;','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{echo $e->getMessage();}
		return $bdd;
	}
	
	public function afficher_mur($pseudo)
    {
		
        $bdd = $this->connecter_bdd();
		$requette = $bdd->prepare('SELECT * FROM lignedemur WHERE pseudo_mur=:pseudo ORDER BY date_pub DESC');
		$requette->execute(array('pseudo' => $pseudo));
		while($rep = $requette->fetch())
		{
			if(isset($_POST['com_'.$rep['ID']]))
			{
				$this->commentaire->hydrater(htmlspecialchars($_SESSION['pseudo']),htmlspecialchars($_POST['com_'.$rep['ID']]),$rep['ID']);
				$this->commentaire->commenter();
			}
			
			?>
			
			<div class="templatemo_box">
            	
                
                <div class="body">
				<h2><a href="profile.php?pseudo=<?php  echo $rep['pseudo_partager']; ?>"><?php echo $rep['pseudo_partager'].'</a> a partagé : '.$rep['titre']; ?>  </h2>
                    
					<p class = "contenu"> <?php  echo $rep['contenu']; ?> </p>
			<?php
			
			if(trim($rep['image']) != '')
			{
			?>
			<img src = "<?php  echo $rep['image']; ?>" alt="image"/>
			<?php } 
			
			$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			?>
					
				
			
			<form class="contact-form" id="contact-form" method="post" enctype="multipart/form-data"  action="<?php echo $monUrl; ?>">
				
			  <label><input name="com<?php echo '_'.$rep['ID'];?>" type="text" placeholder="commenter ..."></label>
			  <div class="wrapper">
				
				<div class="extra-wrap">
					<div class="clear"></div>
					<div class="buttons">
						
					</div>
				</div>
			  </div>
				
			</form>
			<?php $this->commentaire->afficher_commentaire($rep['ID']); ?>
                </div>
            
            	<div class="box_bottom"><span></span></div>
            </div>
			<?php	
		}
		
		$requette->closecursor();
    }
	/*fonctions de chargement de l'image */
	
	private function ext_img($image){
		$extension = strtolower(substr($image,strrpos($image,'.') + 1,strlen($image) - strrpos($image, '.') - 1));
		return $extension;
	}
	private function verif_ext($ext){
		$extension_autorise = array('gif','png','jpg','jpeg');
		return  in_array($ext,$extension_autorise) ? 1:0;
	}
	
	
	private function upload_image()
	{ 
		$res = array(0,'ok');
		if(isset($_FILES['image'])&& trim($_FILES['image']['name']) != '')
		{
			$RepDes =   'image_originale/';		/*  Reperatoite de destination */
			$image = $_FILES['image'];
			$image_name = $image['name'];
			$image_type = $image['type'];
			$image_size = $image['size'];
			$image_path = $image['tmp_name'];
			$extension = $this->ext_img($image_name);
			if(file_exists($image_name))
			{
			 $i = 0;
			while(file_exists($RepDes.$i.'_'.$image_name) ) 
			$i++;
			$image_name = $i.'_'.$image_name;
			}
			if($this->verif_ext($extension))
			if(is_writable($RepDes))
			if(trim($image_name != ''))
			if($image_size > 0)	
			{
				move_uploaded_file($image_path,$RepDes.$image_name);
				switch($extension)
				{
				case "png" : $source = imagecreatefrompng($RepDes.$image_name); //la source
					break;
				case "gif" : $source = imagecreatefromgif($RepDes.$image_name); //la source
					break;
				default : $source = imagecreatefromjpeg($RepDes.$image_name); //la source
					break;
				}
				
				// Les fonctions imagesx et imagesy renvoient la larg hauteur d'une image
				
				$largeur_source = imagesx($source);
				$hauteur_source = imagesy($source);
				$largeur_destination = 600;
				$hauteur_destination = 400;
				if($largeur_source <  $largeur_destination)
				$largeur_destination = $largeur_source;
				if($hauteur_source <  $hauteur_destination)
				$hauteur_destination = $hauteur_source;
				
				$destination = imagecreatetruecolor($largeur_destination, $hauteur_destination); // On miniature vide
				
				// On crée la miniature
				
				imagecopyresampled($destination, $source, 0, 0, 0, 0,
				$largeur_destination, $hauteur_destination, $largeur_source,
				$hauteur_source);
				// On enregistre la miniature sous le nom "image_mur/image_name"
				try{
				switch($extension)
				{
				case "jpeg" : imagejpeg($destination, "images_mur/".$image_name); 
					break;
				case "png" : imagepng($destination, "images_mur/".$image_name);
					break;
				case "gif" : imagegif($destination, "images_mur/".$image_name); //la source
					break;
				case "jpg" : imagejpeg($destination, "images_mur/".$image_name); //la source
					break;
				}
				}
				catch(Exception $e)
				{die('erreur de rechargement');}
				 
				$image_name = "images_mur/".$image_name;
				$res[0] = $image_name;
			}
			else
			$res[1] = 'taille de l\'image est nule';
			else
			$res[1] = 'erreur de rachargement ';
			else
			$res[1] = 'erruer d acces au repertoire de destination';
			else
			$res[1] = 'extension non reconnu';
			
		}
		return $res;
							
	}

public function partager()
    {
		$res = 0;
					
			$image = $this->upload_image();
			$this->image = $image[0];
			$bdd = $this->connecter_bdd();
			
			$amis = $bdd->prepare('SELECT membre.pseudo as ami FROM membre,amis 
						   WHERE (membre.pseudo =  amis.pseudo_exp AND amis.pseudo_des= :pseudo)
													OR 
													(membre.pseudo =  amis.pseudo_des AND  amis.pseudo_exp= :pseudo)');
			$amis->execute(array('pseudo' => $this->pseudo_mur));
			while($ami = $amis->fetch())
			{
				$this->pseudo_mur = $ami['ami'];
				if($this->image)
				{
					$requette = $bdd->prepare('INSERT INTO lignedemur(titre,contenu,pseudo_partager,pseudo_mur,image,date_pub) VALUES(:titre,:contenu,:pseudo_partager,:pseudo_mur,:image,NOW())');
					$requette->execute(array('titre' => $this->titre,
										 'contenu' => $this->contenu,
										 'pseudo_partager' => $this->pseudo_partager,
										 'pseudo_mur' => $this->pseudo_mur,
										 'image' => $this->image));
				}
			else
			{
				if($image[1] == 'ok'){
				$requette = $bdd->prepare('INSERT INTO lignedemur(titre,contenu,pseudo_partager,pseudo_mur,date_pub) VALUES(:titre,:contenu,:pseudo_partager,:pseudo_mur,NOW())');
				$requette->execute(array('titre' => $this->titre,
									 'contenu' => $this->contenu,
									 'pseudo_partager' => $this->pseudo_partager,
									 'pseudo_mur' => $this->pseudo_mur));}
				else
				{
					$res = $image[1];
				}
			}
			}
			
		return $res;
	}
	public function publier()
    {
		$res = 0;
					
			$image = $this->upload_image();
			$this->image = $image[0];
			$bdd = $this->connecter_bdd();
			if($this->image)
				{
					$requette = $bdd->prepare('INSERT INTO lignedemur(titre,contenu,pseudo_partager,pseudo_mur,image,date_pub) VALUES(:titre,:contenu,:pseudo_partager,:pseudo_mur,:image,NOW())');
					$requette->execute(array('titre' => $this->titre,
										 'contenu' => $this->contenu,
										 'pseudo_partager' => $this->pseudo_partager,
										 'pseudo_mur' => $this->pseudo_mur,
										 'image' => $this->image));
				}
			else
				{
				if($image[1] == 'ok'){
				$requette = $bdd->prepare('INSERT INTO lignedemur(titre,contenu,pseudo_partager,pseudo_mur,date_pub) VALUES(:titre,:contenu,:pseudo_partager,:pseudo_mur,NOW())');
				$requette->execute(array('titre' => $this->titre,
									 'contenu' => $this->contenu,
									 'pseudo_partager' => $this->pseudo_partager,
									 'pseudo_mur' => $this->pseudo_mur));}
				else
				{
					$res = $image[1];
				}
				}
		return $res;
	}
	
} /* end of class ligneDeMure */

?>

