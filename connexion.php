 <?php
require("class.Membre_priv.php");
if(isset($_POST['insc'])){
 if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) ){
	$membre = new Membre_priv($_POST['pseudo'],$_POST['password'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['dateNaiss'],$_POST['sexe']);
	$erreuri = $membre->verifier_inscr();
	}
 }
 

if(isset($_POST['login'])){
if(isset($_POST['pseudo1']) && isset($_POST['password1']) ){
	$membre = new Membre_priv(htmlspecialchars($_POST['pseudo1']),htmlspecialchars($_POST['password1']));
	$erreurc = $membre->verifier_conx();
	}
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="utf-8">
	
	
	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="stylesheet/styles.css" />

</head>
<body >
	<!--==============================header=================================-->
	<div id="templatemo_wrapper">

	 <div id="templatemo_header_bar">
    
            <div id="header"><div class="right"></div>
            
                <h1><a href="index.php">
                    <img src="images/1.png" alt="Site Title" width="183" height="63" />
                    <span>Site web de résau social</span>
                </a></h1>
            </div>
        
            <div class="button_01"><a href="apropos.php">a propos</a></div>
            
   
  
    <!-- end of templatemo_header_bar -->
    
    <div class="cleaner"></div>
     
	  </div>
	
	<!--==============================content================================-->
	
	  <div class="cleaner"></div>
    
    <div id="sidebar"><div class="sidebar_top"></div><div class="sidebar_bottom"></div>
    	
        <div class="sidebar_section">
        
            <h2>Members</h2>
            
            <form action="connexion.php" method="post">
                <label>Username</label>
                <input type="text" value="" name="pseudo1" size="10" class="input_field" title="username" />
                <label>Password</label>
                <input type="password" value="" name="password1" class="input_field" title="password" />
                <strong><span><?php if(isset($erreurc)) echo 'pseudo ou password erroné'; ?>  <span></strong>
              <input type="submit" name="login" value="Login" alt="Login" id="submit_btn" title="Login" />
            </form>
             
			<div class="cleaner"></div>
		</div>
        
           
    </div> <!-- end of sidebar -->
	  <div id="templatmeo_content"></div>
 
	<div id="templatmeo_content"><!-- end of latest_content_gallery -->

      <div class="content_section">
        
	<div id="formulaire">
						<?php if(isset($erreuri)) echo 'pseudo existe deja'; ?>
						<form action="connexion.php" method="post" id="contact-form">
						
						  <fieldset>
						  <legend><h2>S'inscrire</h2></legend>
						  <p><span id="sprytextfield1">
						  <label><span id="text_form">Pseudo</span>
							<input type="text" name="pseudo" id="pseudo" />  
						  </label>
						  <span class="textfieldRequiredMsg">Le pseudo est obligatoire.</span></span></p>
						  <p><span id="sprytextfield2">
						  <label><span id="text_form">Email</span>
							<input type="text" name="email" id="email" />
						  </label>
						  <span class="textfieldRequiredMsg">Votre Email est obligaoire.</span>
						  <span class="textfieldInvalidFormatMsg">Email non valide.</span></span></p>
						  <p><span id="sprypassword1">
						  <label><span id="text_form">Mot de passe</span>
							<input type="password" name="password" id="password" />
						  </label>
						  <span class="passwordRequiredMsg">Une valeur est requise.</span>
						  <span class="passwordInvalidStrengthMsg">Au moin 4 chiffres 4 lettres et 2 caractere speciaux.</span></span></p>
						  <p><span id="spryconfirm1">
						  <label><span id="text_form">Confirmation</span>
							<input type="password" name="confirm" id="confirm" />
						  </label>
						  <span class="confirmInvalidMsg">Mots de passes non identique.</span></span></p>
							<p><span id="sprytextfield3">
							<label><span id="text_form">Nom</span>
							  <input type="text" name="nom" id="nom" />
						</label>
						</span></p><p><span id="sprytextfield4">
							<label><span id="text_form">Prenom</span>
							  <input type="text" name="prenom" id="prenom" />
							</label>
						</span></p><p><span id="sprytextfield5">
						<label><span id="text_form">Date de naissance</span>
						  <input type="text" name="dateNaiss" id="dateNaiss" />
						</label>
						<span class="textfieldRequiredMsg">Une valeur est requiseDate</span><span class="textfieldInvalidFormatMsg">JJ/MM/AAAA.</span></span></p><p><span id="spryselect1">
							<label><span id="text_form">Sexe</span>
							  <select name="sexe" id="sexe">
								<option value="Homme">Homme</option>
								<option value="Femme">Femme</option>
							  </select>
							</label>
							<span class="selectRequiredMsg">Sélectionnez un élément.</span></span></p>
						  </fieldset>
						  <input name="insc" type="submit" value="S'inscrire" />
						</form>
						 </div>
		<div class="cleaner"></div>
   	    <div class="cleaner"></div>
      </div>
    
    </div> <!-- end of templatmeo_content -->
	</div>				
	<!--==============================footer=================================-->
	
<div id="templatemo_footer_wrapper">

	<div id="templatemo_footer">
    
    	
       <font color="#000000"><marquee>Ce travail réalisé par Merrouche Asma et Ould heiba  Mohamed Moustapha.  '2014'</marquee> </font>
    </div>
<!-- end of footer -->

	</div>

	<script type="text/javascript"> Cufon.now(); </script>
	<script type="text/javascript">
		$(window).load(function() {
			$('.slider')._TMS({
				duration:1000,
				easing:'easeOutQuint',
				preset:'diagonalFade',
				slideshow:7000,
				banners:false,
				pauseOnHover:true,
				pagination:true,
				pagNums:false
			});
		});
	</script>
	<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minAlphaChars:4, minNumbers:0, minSpecialChars:0, validateOn:["blur"]});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "date", {validateOn:["blur"], format:"dd/mm/yyyy"});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
<?php if(isset($erreur))
echo '<script>alert('.$erreur.');</script>';
?>
</body>
</html>

