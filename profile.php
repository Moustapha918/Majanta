<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Majanata</title>
<meta name="keywords" content="pink shop, store template, ecommerce, online shopping, CSS, HTML" />
<meta name="description" content="Pink Shop is a free ecommerce template provided by templatemo.com" />
<link href="templatemo_style_p.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="stylesheet/styles.css" />

<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>
<script language="javascript" type="text/javascript" src="scripts/mootools-1.2.1-core.js"></script>
<script language="javascript" type="text/javascript" src="scripts/mootools-1.2-more.js"></script>
<script language="javascript" type="text/javascript" src="scripts/slideitmoo-1.1.js"></script>
<script language="javascript" type="text/javascript">
	window.addEvents({
		'domready': function(){
			/* thumbnails example , div containers */
			new SlideItMoo({
						overallContainer: 'SlideItMoo_outer',
						elementScrolled: 'SlideItMoo_inner',
						thumbsContainer: 'SlideItMoo_items',		
						itemsVisible: 5,
						elemsSlide: 3,
						duration: 200,
						itemsSelector: '.SlideItMoo_element',
						itemWidth: 140,
						showControls:1});
		},
		
	});
</script>
</head>
<body>
<div id="templatemo_wrapper">
<?php 
require_once("class.Membre_priv.php");
require_once("class.ligneDeMur.php");
require_once("Class.amis.php");

$mur = new ligneDeMur();
$ami = new amis();
$membre = new Membre_priv();


$cordonne = $membre->Get_coord($_SESSION['pseudo']);
$cordonne = $cordonne->fetch();
if(isset($_SESSION['pseudo']))
{
$membre->gerer_profile();
$email = $membre->changer_email();
$mot = $membre->changer_password();
?>
<div id="templatemo_wrapper">
	<?php if(!isset($_GET['pseudo']) OR (isset($_GET['pseudo'])AND $_GET['pseudo']== $_SESSION['pseudo']))
{
$membre->set_avatar();
?>

    
<div id="templatemo_header_bar">
    
            <div id="header"><div class="right"></div>
            
                <h1><a href="index.php">
                    <img src="images/1.png" alt="Site Title" width="203" height="53" />
                    <span>Site web de reseau social</span>
                </a></h1>
            </div>
            
            <div id="search_box">
                <form action="recherche.php" method="post">
                    <input type="text" placeholder="pseud nom ou email ..." name="texte_re" size="10" id="searchfield" title="searchfield" onfocus="clearText(this)" onblur="clearText(this)" />
                    <input type="submit" name="Search" value="" alt="Search" id="searchbutton" title="Search" />
                </form>
			</div>
    
</div> <!-- end of templatemo_header_bar -->
    
    <div class="cleaner"></div>
    
    <div id="sidebar">
      <div class="sidebar_section">
        
      
            
        <div class="image_wrapper"><a href="#" target="_parent"><img src="<?php echo $membre->Get_avatar($_SESSION['pseudo']); ?>"  name="Insert_avatar"  width="202" height="127"/></a></div>            
        
		<form id="form_publication" method="post" action="profile.php" enctype = "multipart/form-data">	
			<input type="file" name="image" width ="200"/>  <?php  if(isset($erreur,$_FILES['image']) && $erreur) echo $erreur; ?>
			<input value="Enregistrer"type="submit" name"form_publication"/>
		</form>
		<div class="discount"><span><?php echo $cordonne['nom'] ?> </span>  <a href="#"> <?php echo $cordonne['prenom'] ?></a></div>
		<div class="discount"><?php echo $cordonne['email'] ?>  </div>
		<div class="discount"><?php echo $cordonne['dateNaiss'] ?>  </div>
      </div>  
        
    </div> <!-- end of sidebar -->
    
    <div id="templatmeo_content"><!-- end of latest_content_gallery -->

      <div class="content_section">
        
   	    <h2>&nbsp;</h2>
       
			
            
            
            <form class="contact-form" id="contact-form1" method="post" enctype="multipart/form-data">
				<fieldset>
				 <legend>Info de profile</legend>
					  <label><span class="text-form">Nom:</span><input type="text" name="nom"></label>
					  <label><span class="text-form">Prenom:</span><input type="text" name ="prenom"></label>
					  <label><span class="text-form">Ville:</span><input type="text" name ="ville"></label>
					  
					  <div class="wrapper">
						<div class="extra-wrap">							
							<div class="clear"></div>
							<div class="buttons">
								<a class="button" href="#" onClick="document.getElementById('contact-form1').reset()">Clear</a>
								<a class="button" href="#" onClick="document.getElementById('contact-form1').submit()">Send</a>
							</div>
						</div>
					  </div>
				</fieldset>
			</form>
            
            <form class="contact-form" id="contact-form2" method="post" enctype="multipart/form-data">
				<fieldset>
				<legend>Votre Email</legend>
				
					  <label><span class="text-form">Email:</span><input type="text" name="email"></label>
					  <label><span class="text-form">password :</span><input type="password" name="epassword"></label>
					  
					  <div class="wrapper">
						
						<div class="extra-wrap">
							
							<div class="clear"></div>
							<div class="buttons">
								<span class="boutoon"  href="#"><?php if(isset($email)) echo $email;  ?></span>
								<a class="button" href="#" onClick="document.getElementById('contact-form2').reset()">Clear</a>
								<a class="button" href="#" onClick="document.getElementById('contact-form2').submit()">Send</a>
							</div>
							
						</div>
					  </div>
				</fieldset>
			</form>
            <form class="contact-form" id="contact-form3" method="post" enctype="multipart/form-data">
				<fieldset>
				<legend>Votre mot de passe</legend>
					  <label><span class="text-form">ancien password:</span><input name="apassword" type="password"></label>
					  <label><span class="text-form">nouvelle password :</span><input name="npassword" type="password"></label>
					  <label><span class="text-form">confirmation :</span><input name="cpassword" type="password"></label>
					  <div class="wrapper">
						
						<div class="extra-wrap">
							
							<div class="clear"></div>
							<div class="buttons">
							<span class="boutoon"  href="#"><?php if(isset($mot)) echo $mot;  ?></span>
								<a class="button" href="#" onClick="document.getElementById('contact-form3').reset()">Clear</a>
								<a class="button" href="#" onClick="document.getElementById('contact-form3').submit()">Send</a>
							</div>
						</div>
					  </div>
				</fieldset>
			</form>
            
   	    <div class="cleaner"></div>
   	    <div class="cleaner"></div>
      </div>
    
    </div> <!-- end of templatmeo_content -->
    
    <div id="templatemo_footer_wrapper">

	<div id="templatemo_footer">
    
    	
       <font color="#000000"><marquee>Ce travail réalisé par Merrouche Asma et Ould heiba  Mohamed Moustapha.  '2014'</marquee> </font>
    </div>
<!-- end of footer -->
</div> <!-- end of templatemo_wrapper -->


<?php }
		else
		{ 
		$cordonne = $membre->Get_coord($_GET['pseudo']);
		$cordonne = $cordonne->fetch();
		
		?>

			
   <div id="templatemo_header_bar">
    
             <div id="header"><div class="right"></div>
            
                <h1><a href="index.php">
                    <img src="images/1.png" alt="Site Title" width="203" height="53" />
                    <span>Site web de reseau social</span>
                </a></h1>
            </div>
            
            <div id="search_box">
                <form action="recherche.php" method="post">
                    <input type="text" value="pseud nom ou email ..." name="texte_re" size="10" id="searchfield" title="searchfield" onfocus="clearText(this)" onblur="clearText(this)" />
                    <input type="submit" name="Search" value="" alt="Search" id="searchbutton" title="Search" />
                </form>
			</div>
    
    </div> <!-- end of templatemo_header_bar -->
    
    <div class="cleaner"></div>
    
    <div id="sidebar"><div class="sidebar_top"></div><div class="sidebar_bottom"></div>
      <div class="sidebar_section">
        
        <h2> </h2>
            
            <div  class="image_wrapper"><a href="#" target="_parent"><img src="<?php echo $membre->Get_avatar(($_GET['pseudo'])); ?>" alt="product" width="202" height="127"/></a></div>            
          
		  <div class="discount"><?php echo $cordonne['nom'].' '.$cordonne['prenom']; ?></div>
		  <div class="discount"><span><h2> <?php switch($ami->situation($_GET['pseudo']))
					{
					case "Amis" : echo '<a  class = "bouton2" href="returer_des_amis.php?pseudo='.$_GET['pseudo'].'"> Returer des amis</a>'; 
						break;
					case "Accepter" :echo '<a class="bouton2" href="accepter_dem.php?pseudo='.$_GET['pseudo'].'"> accepter</a>';
						break;
					case "Envoyer" : echo '<a class="bouton2" href="envoi_dem.php?pseudo='.$_GET['pseudo'].'"> Ajouter</a>';
						break;
					case "Annuler" :  echo '<a class="bouton2" href="annuler_dem.php?pseudo='.$_GET['pseudo'].'"> Annuler demande</a>'; 
						break;
					}
			?></span></h2></div>
        
        </div>  
        
    </div> <!-- end of sidebar -->
    
	
	
	
	
	
	
	
	<div id="templatmeo_content">
	<div class="content_section">
        
        	<h2>Le mur</h2>
        	<div class="cleaner"></div>
        	<div class="cleaner"></div>
                    
                    <div class="button_01"></div>
                    <div id="templatmeo_wrapper">

    
            
				<?php  $mur->afficher_mur($_GET['pseudo']);?>
                    
            	<div class="box_bottom"><span></span></div>
            </div>
			
    </div>
	</div>
	
	
	
	
	
	
	
	
	
	<!--
	
    <div id="templatmeo_content"><!-- end of latest_content_gallery

      <div class="content_section">
        
   	    <h2>Le mur</h2>
		
   	    <div class="cleaner"></div>
   	    <div class="cleaner"></div>
		<div id="templatmeo_wrapper">
		
					<?php  $mur->afficher_mur($_GET['pseudo']);?>
					
					<div class="box_bottom"><span></span></div>
					</div>
		  <div class="button_01"></div>
                    
      </div> -->
	  
  <!--  </div>  end of templatmeo_content -->

    
</div> <!-- end of templatemo_wrapper -->


    <div id="templatemo_footer_wrapper">

	<div id="templatemo_footer">
    
    	
       <font color="#000000"><marquee>Ce travail réalisé par Merrouche Asma et Ould heiba  Mohamed Moustapha.  '2014'</marquee> </font>
    </div>
<!-- end of footer -->

	</div>
	

<?php }
?>
</body>
</html>
<?php

 }else
header("Location: connexion.php"); ?>