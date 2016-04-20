
<?php 
require("Class.amis.php"); 
if(isset($_SESSION['pseudo']))
{
$ami = new amis();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pink Shop Template</title>
<meta name="keywords" content="pink shop, store template, ecommerce, online shopping, CSS, HTML" />
<meta name="description" content="Pink Shop is a free ecommerce template provided by templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
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
	
    
  <div id="templatemo_header_bar">
    
            <div id="header"><div class="right"></div>
            
                <h1><a href="index.php">
                    <img src="images/1.png" alt="Site Title" width="234" height="54" />
                <span>site web de reseau social</span></a>            </h1>
            </div>
            
            <div id="search_box">
                <form action="recherche.php" method="post">
                    <input type="text" placeholder="pseudo nom ou email ..." name="texte_re" size="10" id="searchfield" title="searchfield" onfocus="clearText(this)" onblur="clearText(this)" />
                    <input type="submit" name="Search" value="" alt="Search" id="searchbutton" title="Search" />
                </form>
			</div>
    
    </div> <!-- end of templatemo_header_bar -->
    
    <div class="cleaner"></div><!-- end of sidebar -->
    
    <div id="templatmeo_content"><!-- end of latest_content_gallery -->

      <div class="content_section">
        
      <h2>&nbsp;</h2>
   	    <div class="cleaner"></div>
   	    <div class="cleaner"></div>
      </div>
    
        
	
		
      <?php  
				$ami->ChercherDesAmis();
		?>
   	    
  </div> <!-- end of templatmeo_content -->
    
    
</div> <!-- end of templatemo_wrapper -->
<div id="templatemo_footer_wrapper">

	<div id="templatemo_footer">
    
    	
       <font color="#000000"><marquee>Ce travail réalisé par Merrouche Asma et Ould heiba  Mohamed Moustapha.  '2014'</marquee> </font>
    </div>
<!-- end of footer -->

	</div>
</body>
</html>

<?php } else
header("Location: connexion.php"); ?>