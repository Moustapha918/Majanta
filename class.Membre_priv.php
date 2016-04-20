<?php
session_start();
/*
error_reporting(E_ALL);

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}
*/
class Membre_priv
{
	private $pseudo = null;    
	private $nom = null;
	private $prenom = null;
	private $dateNaiss = null;
	private $email = null;
	private $sexe = null;
	private $password = null;
	private $avatar = null;

	public function __construct($pseudo=null,$password=null,$nom=null,$prenom=null,$email =null,$dateNaiss=null,$sexe=null)
    {
        $this->pseudo = htmlspecialchars($pseudo);
		$this->nom = htmlspecialchars($nom);
		$this->prenom = htmlspecialchars($prenom);
		$this->email = htmlspecialchars($email);
		$this->dateNaiss = htmlspecialchars($dateNaiss);
		$this->password = htmlspecialchars($password);
		$this->sexe = htmlspecialchars($sexe);
    }
	
	private function ext_img($image){
		$extension = strtolower(substr($image,strrpos($image,'.') + 1,strlen($image) - strrpos($image, '.') - 1));// returne l'extention d'un fichier 
		// strtolower transforme une chiane a une lettre miniscule , substr : extraire une partie d' une chiane, 
		return $extension;
	}
	private function verif_ext($ext)
	{
		$extension_autorise = array('gif','png','jpg','jpeg');
		return  in_array($ext,$extension_autorise) ? 1:0;
	}
	
	private	function connecter_bdd(){
	try{
		$bdd = new PDO('mysql:host=localhost; dbname=net_social;','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{echo $e->getMessage();}
		return $bdd;
	}
	
	public function set_avatar()
	{ 
		$res = array(0,'ok');
		if(isset($_FILES['image'])&& trim($_FILES['image']['name']) != '')
		{
			$RepDes =   'avatar/';		/*  Reperatoite de destination */
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
			if(trim($image_name) != '')
			if($image_size > 0)	
			{
				move_uploaded_file($image_path,$RepDes.$image_name);
				
				$bdd = $this->connecter_bdd();
				$requette = $bdd->prepare('UPDATE membre SET avatar = :avatar WHERE pseudo = :pseudo');
				$requette->execute(array('avatar' => $RepDes.$image_name,'pseudo' => $_SESSION['pseudo']));
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
	
	public function Get_avatar($pseudo)
	{
		$bdd = $this->connecter_bdd();
				$requette = $bdd->prepare('SELECT avatar from membre WHERE pseudo = :pseudo');
				$requette->execute(array('pseudo' => $pseudo));
				$requette = $requette->fetch();
				return $requette['avatar'];
	}

	public function enregistrement()
    {	
	$bdd = $this->connecter_bdd();
		$req = $bdd->prepare('INSERT INTO membre(pseudo,email,password,nom,prenom,dateNaiss,sexe,avatar) VALUES(:pseudo,:email,:password,:nom,:prenom,:dateNaiss,:sexe,"avatar/avatar_defaut.png")');
		$req->execute(array('pseudo' => $this->pseudo,
							'email' => $this->email,
							'password' => $this->password,
							'nom' => $this->nom,
							'prenom' => $this->prenom,
							'dateNaiss' => $this->dateNaiss,
							'sexe' => $this->sexe));		
    }
	
	public function verifier_inscr()
    {
		$res = 'ok';
		$bdd = $this->connecter_bdd();
		$req = $bdd->prepare('SELECT pseudo FROM membre WHERE pseudo=:pseudo');
		$req->execute(array('pseudo'=> $this->pseudo));
		$req = $req->fetch();
		if(!$req['pseudo'])
		{
			$this->enregistrement();
			$_SESSION['pseudo'] = $this->pseudo;
			$_SESSION['nom'] = $this->nom;
			$_SESSION['prenom'] = $this->prenom;
			header("Location: bienvenue.php");
		}
		else
		$res = "pseudo erroné";
		return $res;
    }
	
	
	public function verifier_conx()
    {
		$res = 'ok';
		$bdd = $this->connecter_bdd();
		$req = $bdd->prepare('SELECT * FROM membre WHERE pseudo=:pseudo');
		$req->execute(array('pseudo'=> $this->pseudo));
		$req = $req->fetch();
		if(!$req)
		{
			$res = "pseudo erroné";
		}
		else
		{
			if($req['password'] != $this->password)
			$res = 'mot de passe erroné';
			else
			{
			session_start();
			$_SESSION['pseudo'] = $this->pseudo;
			$_SESSION['nom'] = $req['nom'];
			$_SESSION['prenom'] = $req['prenom'];
			header("Location: index.php");
			
			}
		}
		
		return $res;
    }

	public function Get_coord($pseudo){
		$bdd = $this->connecter_bdd();
		$cordonne = $bdd->prepare('SELECT * FROM membre WHERE pseudo = :pseudo');
		$cordonne->execute(array("pseudo" => $pseudo));
		return $cordonne;
	}
    public function gerer_profile()
    {
		$bdd = $this->connecter_bdd();
		
        if(isset($_POST['nom'])){
		$update = $bdd->prepare('UPDATE membre SET nom =:nom WHERE pseudo = :pseudo');
		$update->execute(array('nom'=>$_POST['nom'],'pseudo'=>$_SESSION['pseudo']));
		}
		if(isset($_POST['prenom']))
		{
			$update = $bdd->prepare('UPDATE membre SET prenom =:prenom WHERE pseudo = :pseudo');
			$update->execute(array('prenom'=>$_POST['prenom'],'pseudo'=>$_SESSION['pseudo']));
		}
		if(isset($_POST['ville']))
		{
			$update = $bdd->prepare('UPDATE membre SET ville =:ville WHERE pseudo = :pseudo');
			$update->execute(array('ville'=>$_POST['ville'],'pseudo'=>$_SESSION['pseudo']));
		}
			
    }
    

    public function changer_email()
    {
		$bdd = $this->connecter_bdd();
        if (isset($_POST['email']))
		{
			$_POST['email'] = htmlspecialchars($_POST['email']); // On rend inoffensives les balises HTML que le visiteur a pu rentrer
			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$_POST['email']))
			{
				$cord = $this->Get_coord($_SESSION['pseudo']);
				$cord = $cord->fetch();
				$mdp = $cord['password'];
				if(isset($_POST['epassword']))
				if($mdp == $_POST['epassword'])
				{
					$update = $bdd->prepare('UPDATE membre SET email =:email WHERE pseudo = :pseudo');
					$update->execute(array('email'=>$_POST['email'],'pseudo'=>$_SESSION['pseudo']));
					return 'email a été changé avec succes';
				}
				else return 'mot de passe incorrecte'.$mdp;
				else
				return 'veuillez saisir votre mot de passe';
				
				
			}
			else
			{
			return 'email invalide';
			}
		}
    }
	
	public function changer_password()
    {
		$bdd = $this->connecter_bdd();
        if (isset($_POST['npassword']))
		{
			$_POST['npassword'] = htmlspecialchars($_POST['npassword']); // On rend inoffensives les balises HTML que le visiteur a pu rentrer
				$cord = $this->Get_coord($_SESSION['pseudo']);
				$cord = $cord->fetch();
				$amdp = $cord['password'];
				if(isset($_POST['apassword']))
				if(isset($_POST['cpassword']) && ($_POST['cpassword']== $_POST['npassword'] ))
				{
					if($_POST['apassword'] == $amdp)
					{
					$update = $bdd->prepare('UPDATE membre SET password =:password WHERE pseudo = :pseudo');
					$update->execute(array('password'=>$_POST['npassword'],'pseudo'=>$_SESSION['pseudo']));
					return 'mot de passe changé avec succes';
					}
					else 
					return 'ancien mot de passe invalide';
					
				}
				else return 'mots de passe differnets';
				else
				return "veuillez saisir l'ancien mot de passe";
				
			
		}
    }

} /* end of class Membre_priv */

?>