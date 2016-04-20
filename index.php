<?php
require_once("class.ligneDeMur.php");
require_once("Class.amis.php");
$ami = new amis();
$membre = new Membre_priv();
if(isset($_SESSION['pseudo']))
{

if(isset($_POST['contenu']) && $_POST['contenu']!= ''){
	if(isset($_POST['titre']) && $_POST['titre']!= '')
	$mur = new ligneDeMur($_POST['contenu'],$_POST['titre']);
	else
	$mur = new ligneDeMur($_POST['contenu']);
	if(isset($_POST['partager']))
	$erreur = $mur->partager();
	elseif(isset($_POST['publier']))
	$erreur = $mur->publier();
	}                                                                         
else
$mur = new ligneDeMur();


$cordonne = $membre->Get_coord($_SESSION['pseudo']);
$cordonne = $cordonne->fetch();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Majanta BBA  </title
<meta name="keywords" content="pink shop, store template, ecommerce, online shopping, CSS, HTML" />
<meta name="description" content="Pink Shop is a free ecommerce template provided by templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="stylesheet/styles.css" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>

</head>
<body id="mur">
<div id="templatemo_wrapper">
    
  <div id="templatemo_header_bar">
    
            <div id="header"><div class="right"></div>
            
                <h1><a href="index.php">
                    <img src="images/1.png" alt="Site Title" width="183" height="63" />
                    <span>Site web de résau social</span>
                </a></h1>
            </div>
            <div class="button_01"><a href="deconnexion.php">deconnexion</a></div>
            <div class="button_01"><a href="apropos.php">a propos</a></div>
            
    <div id="search_box">
                <form action="recherche.php" method="post">
                    <input type="text" placeholder="pseud nom ou email ..." name="texte_re" size="10" id="searchfield" title="searchfield" onfocus="clearText(this)" onblur="clearText(this)" />
                    <input type="submit" name="Search" value="" alt="Search" id="searchbutton" title="Search" />
                </form>
				
    </div> 
  
    <!-- end of templatemo_header_bar -->
    <div class="cleaner"></div>
     
	  </div>
		 
		  
  <div id="sidebar"><div class="sidebar_top"></div><div class="sidebar_bottom"></div>
      <div class="sidebar_section">
	  
	  <?php if($ami->nb_invitation() != 0) echo '<div class="invi">'.$ami->nb_invitation().'</div>';?>  
		    			<div id="notif1"></div>
						<div id="notifications">
						</div>
						
            <ul class="categories_list">
			
                <li><a href="profile.php"><?php echo $cordonne['nom'].' '.$cordonne['prenom']; ?></a></li>
                <li><a href="invitations.php">invitations</a></li>
                <li><a href="#">notifications</a></li>
                <li><a href="list_amis.php">Liste des amis</a></li>
				
            </ul>
        </div>
			
      
        <div class="sidebar_section">
        
            <h2></h2>
            
            <div class="image_wrapper"><a href="profile.php" target="_parent"><img src="<?php echo $cordonne['avatar'] ?>" alt="avatar" width="201" height="131" /></a></div>
        </div>  
        
    </div> <!-- end of sidebar -->
    
    <div id="templatmeo_content">

    	<div id="latest_product_gallery">
           <h2> Membre que vous pouvez connaitre </h2>
    	  <?php $ami->membres_suggere($_SESSION['pseudo']); ?>
    	</div> <!-- end of latest_content_gallery -->
        
        <div class="content_section">
        
                <form id="form_publication" method="post" action="index.php" enctype = "multipart/form-data">					
						
							<input name="titre" type="text" placeholder ="titre"/><br/>
							<textarea name="contenu" id ="pubarea" placeholder ="Que penser vous ..."></textarea><br/>
							<input type="file" name="image" />  <?php  if(isset($erreur,$_FILES['image']) && $erreur) echo $erreur; ?>
							<input value="Publier" type ="submit" name="publier"/>
							<input value="Partager" type ="submit" name="partager"/>
												
				</form>
                    
		</div>
            
            
        <div class="content_section">
        
        	<h2>Le mur</h2>
        	<div class="cleaner"></div>
        	<div class="cleaner"></div>
                    
                    <div class="button_01"></div>
                    <div id="templatmeo_wrapper">

    
            
				<?php  $mur->afficher_mur($_SESSION['pseudo']);?>
                    
            	<div class="box_bottom"><span></span></div>
            </div>
			
    </div> 
   
    
    </div> <!-- end of templatmeo_content -->
    
   
</div> <!-- end of templatemo_wrapper -->

 <div class="body">
	<div id="chat">
	
                
				<div id="membres_enligne">
		<ul class="liste_membre" id = "liste_membre">
			
		</ul>
		</div>
		<div id="chat_priv">
		
		</div>
				</div>
				
	</div>
	
		

	<div id ="footer_chat">
	<a href="#post" onclick="
	if($('#chat').css('visibility')== 'hidden')
	$('#chat').css('visibility',' visible');
	else
	$('#chat').css('visibility',' hidden');
	">
	<div class="templatemo_box">
                <div class="body">
				chat
				
				</div>
				
            	
	</div>
	</a>
	</div>
	
	

<div id="templatemo_footer_wrapper">

	<div id="templatemo_footer">
    
    	
       <font color="#000000"><marquee>Ce travail réalisé par Merrouche Asma et Ould heiba  Mohamed Moustapha.  '2014'</marquee> </font>
    </div>
<!-- end of footer -->

	</div>
	<script src="js/chat.js" type="text/javascript">
	</script>

	<script src="js/notifications.js" type="text/javascript">
	</script>
	<script language="javascript">
	
	</script>
	
</body>
</html>

<?php } else
header("Location: connexion.php"); ?>
