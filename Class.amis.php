<?php
//session_start();
require_once("class.ligneDeMur.php");
error_reporting(E_ALL);

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

class amis
{
    private $id_invitation = null;    
    private $pseudo_exp = null;
    private $pseudo_des = null;
	private $date_invi = null;
	private $date_confi = null;
	private $actif = null;
	
	public function __construct()
    {
    
    }
	
	private	function connecter_bdd(){
	try{
		$bdd = new PDO('mysql:host=localhost; dbname=net_social;','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{echo $e->getMessage();}
		return $bdd;
	}
	
    public function ChercherDesAmis()
    {	
		if(isset($_POST['texte_re']))
		{
        $bdd = $this->connecter_bdd();
		$rep = $bdd->query("SELECT * FROM membre");
		?>
		
		<?php
		$texte_re=trim($_POST['texte_re']);
		while($req = $rep->fetch())
			{
				if(($texte_re == $req['pseudo']) ||  ($texte_re== $req['nom']) ||  ($texte_re== $req['prenom']) || ($texte_re== $req['email']))
				{
				?>
			<div class="content_section">	
		<div class="membre">
			<div class="product_box margin_r35">   
	                    <h3>photo</h3>
						<div class="image_wrapper"> <a href="profile.php?pseudo=<?php echo $req['pseudo']; ?> " target="_parent"><img src="<?php echo $req['avatar']; ?> " alt="product 2" width="182" height="102" /></a> </div>
                   
                    </div>
                    
          <div class="product_box margin_r35">
                        <h3>nom</h3>
    
                      <?php echo $req['nom']; ?> 
                    </div>
                    
        <div class="product_box">
                        <h3>prenom</h3>
                     <?php echo $req['prenom']; ?>
					
		</div>
        </div>
			<div class="cleaner"></div>
   	    <div class="cleaner"></div>
      </div>
				<?php
				}
			}
		
		}
	}
	
	public function situation($pseudo)
	{
		$bdd = $this->connecter_bdd();
		$requette0 =$bdd->prepare('SELECT count(id_invitation) as nbinv FROM amis WHERE pseudo_exp = :pseudo_exp AND pseudo_des = :pseudo_des AND active = 1');
		$requette0->execute(array('pseudo_exp' => $pseudo ,'pseudo_des' => $_SESSION['pseudo']));
		$requette0 = $requette0->fetch();
		$requette1 = $bdd->prepare('SELECT count(id_invitation) as nbinv FROM amis WHERE pseudo_exp = :pseudo_exp AND pseudo_des = :pseudo_des AND active = 1');
		$requette1->execute(array('pseudo_exp' => $_SESSION['pseudo'],'pseudo_des' => $pseudo));
		$requette1 = $requette1->fetch();
		if($requette1['nbinv'] || $requette0['nbinv'])
		return 'Amis';
		$requette2 = $bdd->prepare('SELECT count(id_invitation) as nbinv FROM amis WHERE pseudo_exp = :pseudo_exp AND pseudo_des = :pseudo_des');
		$requette2->execute(array('pseudo_exp' => $_SESSION['pseudo'],'pseudo_des' => $pseudo));
		$requette2 = $requette2->fetch();
		if($requette2['nbinv'])
		return 'Annuler';
		$requette3 = $bdd->prepare('SELECT count(id_invitation) as nbinv FROM amis WHERE pseudo_exp = :pseudo_exp AND pseudo_des = :pseudo_des');
		$requette3->execute(array('pseudo_exp' => $pseudo,'pseudo_des' => $_SESSION['pseudo']));
		$requette3 = $requette3->fetch();
		if($requette3['nbinv'])
		return 'Accepter';
		return 'Envoyer';
	}
	
	public function envoi_dem($pseudo)
	{
		$bdd = $this->connecter_bdd();
		$requette = $bdd->prepare('INSERT INTO amis (pseudo_exp,pseudo_des,date_invi,active) VALUES(:pseudo_exp,:pseudo_des,NOW(),0)');
		$requette->execute(array('pseudo_exp' => $_SESSION['pseudo'],'pseudo_des' => $pseudo));
	}
	public function accepter_dem($pseudo)
	{
		$bdd= $this->connecter_bdd();
		$requette = $bdd->prepare('UPDATE  amis SET active = 1 ,date_conf = NOW() WHERE pseudo_exp = :pseudo_exp AND pseudo_des = :pseudo_des');
		$requette->execute(array('pseudo_exp' => $pseudo,'pseudo_des' => $_SESSION['pseudo']));
	}
	public function annuler_dem($pseudo)
	{
		$bdd= $this->connecter_bdd();
		$requette = $bdd->prepare('DELETE FROM   amis WHERE  pseudo_exp = :pseudo_exp AND pseudo_des = :pseudo_des');
		$requette->execute(array('pseudo_exp' => $_SESSION['pseudo'],'pseudo_des' => $pseudo));
	}
	public function returer_des_amis($pseudo)
	{
		$bdd= $this->connecter_bdd();
		$requette = $bdd->prepare('DELETE FROM   amis WHERE  pseudo_exp = :pseudo_exp AND pseudo_des = :pseudo_des OR pseudo_exp = :pseudo_des AND pseudo_des = :pseudo_exp');
		$requette->execute(array('pseudo_exp' => $_SESSION['pseudo'],'pseudo_des' => $pseudo));
	}
	
	public function nb_invitation()
	{
		$bdd = $this->connecter_bdd();
		$rep = $bdd->prepare('SELECT count(id_invitation) as inv FROM amis WHERE pseudo_des = :pseudo_des and active = 0');
		$rep->execute(array('pseudo_des' => $_SESSION['pseudo']));
		$rep = $rep->fetch();
		return $rep['inv'];
	}
	public function invitation()
	{
		$bdd = $this->connecter_bdd();
		$rep = $bdd->prepare('SELECT * FROM amis,membre WHERE pseudo_des = :pseudo_des and active = 0 and amis.pseudo_exp = membre.pseudo');
		$rep->execute(array('pseudo_des' => $_SESSION['pseudo']));
		
		while($req = $rep->fetch())
		{
			?>
			<div class="content_section">	
		<div class="membre">
			<div class="product_box margin_r35">   
	                    <h3>photo</h3>
						<div class="image_wrapper"> <a href="profile.php?pseudo=<?php echo $req['pseudo']; ?> " target="_parent"><img src="<?php echo $req['avatar']; ?> " alt="avatar" width="182" height="102" /></a> </div>
                   
                    </div>
                    
          <div class="product_box margin_r35">
                        <h3>nom</h3>
    
                      <?php echo $req['nom']; ?> 
                    </div>
                    
        <div class="product_box">
                        <h3>prenom</h3>
                     <?php echo $req['prenom']; ?>
		</div>
        </div>
			<div class="cleaner"></div>
   	    <div class="cleaner"></div>
      </div>
				<?php
		}
	
	}
	
	public function nb_notifications($pseudo){
		$bdd = $this->connecter_bdd();
		$nots = $bdd->prepare('SELECT * from notifications WHERE pseudo_des = :pseudo AND type = "message"');
		$nots->execute(array("pseudo" => $pseudo));
		$i = $nots->rowcount();
	/*
		$json['nb_not'] = $i;
		echo json_encode($json);
		// return $i;*/
	
	
	
		$data[0] = $i;
		$j= 1;
		
		// $note['nb_not'] = $i;
		
		while($note = $nots->fetch()){
		$data[$j] = $note['pseudo_exp'];
		$j++;
		}
		$json['not'] = $data;
		echo json_encode($json);
		// return $i;
	
	
	}
	public function membres_suggere($pseudo){
		$bdd = $this->connecter_bdd();
		$i = 0;
		$membres_sug = $bdd->prepare('SELECT pseudo,avatar from membre WHERE pseudo NOT IN(SELECT membre.pseudo as amis FROM membre,amis 
						   WHERE (membre.pseudo =  amis.pseudo_exp AND amis.pseudo_des = :pseudo)
													OR 
													(membre.pseudo =  amis.pseudo_des AND  amis.pseudo_exp = :pseudo)
													OR membre.pseudo = :pseudo) ORDER BY dateNaiss LIMIT 0,4');

		$membres_sug->execute(array("pseudo" => $pseudo));
		$j = $membres_sug->rowcount();
		
		?>
		
		<div id="SlideItMoo_outer">	
                <div id="SlideItMoo_inner">			
                    <div id="SlideItMoo_items">
		<?php
		// if($j>=4){
		while($membre_sug =$membres_sug->fetch()){
		
		?>
		         <div class="SlideItMoo_element">
                       
                                <a href="profile.php?pseudo=<?php  echo $membre_sug['pseudo']; ?>">
                                <img src="<?php  echo $membre_sug['avatar']; ?>" alt="" width="100" height="100"/></a>
				</div>	
					
	<?php
	$mbr_pseudo[$i] = $membre_sug['pseudo'];
	$i++;
	}
	
	for($i = 0 ; $i <$j ; $i++)
	{
	?>
		         <div class="SlideItMoo_element">
                       
                                <a href="profile.php?pseudo=<?php  echo $mbr_pseudo[$i]; ?>"><?php  echo $mbr_pseudo[$i]; ?></a>
				</div>	
					
	<?php
	}
	
	?>
	
					</div>			
			</div>
		</div>
	<?php
	}
	



public function list_amis($pseudo){
	$bdd = $this->connecter_bdd();
	$amis = $bdd->prepare('SELECT pseudo,avatar,nom,prenom FROM membre,amis 
						   WHERE (membre.pseudo =  amis.pseudo_exp AND amis.pseudo_des = :pseudo)
													OR 
													(membre.pseudo =  amis.pseudo_des AND active=1 AND amis.pseudo_exp = :pseudo)
													');

		$amis->execute(array("pseudo" => $pseudo));
		while($ami = $amis->fetch())
			{
				
				?>
			<div class="content_section">	
		<div class="membre">
			<div class="product_box margin_r35">   
	                    <h3>photo</h3>
						<div class="image_wrapper"> <a href="profile.php?pseudo=<?php echo $ami['pseudo']; ?> " target="_parent"><img src="<?php echo $ami['avatar']; ?> " alt="product 2" width="182" height="102" /></a> </div>
                   
                    </div>
                    
          <div class="product_box margin_r35">
                        <h3>nom</h3>
    
                      <?php echo $ami['nom']; ?> 
                    </div>
                    
        <div class="product_box">
                        <h3>prenom</h3>
                     <?php echo $ami['prenom']; ?>
		</div>
        </div>
			<div class="cleaner"></div>
   	    <div class="cleaner"></div>
      </div>
				<?php
				
			}
		

}
}  //fin de la classe amis
?>