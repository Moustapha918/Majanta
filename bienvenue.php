<?php session_start() ;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bienvenue dans MajantaBBA</title>
<meta name="keywords" content="pink shop, store template, ecommerce, online shopping, CSS, HTML" />
<meta name="description" content="Pink Shop is a free ecommerce template provided by templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="stylesheet/styles.css" />
<style type="text/css">




#apDiv1 {
	position: absolute;
	width: 200px;
	height: 115px;
	z-index: 1;
	left: 852px;
	top: 305px;
}
#apDiv2 {
	position: absolute;
	width: 308px;
	height: 49px;
	z-index: 2;
	left: 384px;
	top: 420px;
}
#apDiv3 {
	position: absolute;
	width: 260px;
	height: 45px;
	z-index: 3;
	left: 720px;
	top: 419px;
}
</style>
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
	
    
  <div id="templatemo_header_bar">
    
            <div id="header"><div class="right"></div>
            
                <h1><a href="index.php">
                    <img src="images/1.png" alt="Site Title" width="234" height="54" />
                <span>site web de reseau social</span></a>            </h1>
            </div>
            <div class="button_01"><a href="deconnexion.php">deconnexion</a></div>
            <div class="button_01"><a href="apropos.php">a propos</a></div>
            
    </div> <!-- end of templatemo_header_bar -->
    
    <div class="cleaner"></div><!-- end of sidebar -->
<div class="felicitation">
  <p align ="center"class="bien"> <?php echo  " bienvenue, <a href=''> ".$_SESSION['nom'].' '.$_SESSION['prenom']."</a>"; ?></p>
	<p class="bien1" align ="center">  Nous vous remercions d'avoir créé un compte sur MajantaBBA. 
	Utilisez-le pour contacter votre communauté decouvrir des nouveaux amis.
	Nous espirons que vous soyez heureux pendant votre navigation dans notre site.<br/>
	Depuis maintenant vous povez acceder a votre compte via le pseudo : <?php echo $_SESSION['pseudo']; ?>
 </p>
 <p align ="center">
	<div id="apDiv3"><div class = "bouton">
    <a href="index.php"> Ignorer cette etape</a>
</div></div>
	
	<div id="apDiv2">
    <div class = "bouton">
  <a href="profile.php"> completer votre profile</a>
</div>
  </div>
  
</div>

</p>
      
  </div> <!-- end of templatmeo_content -->
    
    
<div id="templatemo_footer_wrapper">

	<div id="templatemo_footer">
    
    	
       <font color="#000000"><marquee>Ce travail réalisé par Merrouche Asma et Ould heiba  Mohamed Moustapha.  '2014'</marquee> </font>
    </div>
<!-- end of footer -->

	</div>
</body>
</html>