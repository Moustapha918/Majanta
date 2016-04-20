function suprimer_not(pseudo){

$.ajax({
	url : 'delete_notifications.php',
	type : 'GET',
	dataType : 'html',
	data : 'pseudo=' + pseudo
	
});
}

function ajouter_div(pseudo)
{
$('#chat_priv').html('<div class="templatemo_box"><div class="body"><div id="messages"><h2><a id="hello" href="#post" onclick=\" $(\'#chat_priv\').html(\'\');  \">'+pseudo+'</a></h2><p></p></div><textarea id="tchatarea" ></textarea></div></div>');

envoi_msg(pseudo);
}

function recup_list_amis()
{	
var list_pseudo = new Array(),i=0;
	$.getJSON('membre_enligne.php',
			function(data){
			var i = 0,pseudo ='';
			var liste_mbr = '';

			while (data["list"][i])
			{
			pseudo = data["list"][i]["pseudo"];
			liste_mbr+='<li><a class = "mbr_enligne" "href="#post" onclick="ajouter_div(\'' + pseudo+'\');">'+ pseudo +'</a>';
			liste_mbr += '<img class="status" src="images/'+data["list"][0]["status"]+ '.png"></li>';
			i++;
			}
			$("#liste_membre").html(liste_mbr);
			
			});
			
}

setInterval(recup_list_amis,2000);
recup_list_amis();

//la fonction qui va  recuperer les informations de la bdd
function recup_msg()
{
var pseudo = $('#messages a').html();
$.post('recup_msg.php',
{pseudo:pseudo},
function(data){
$('#messages p').html(data);
});

setInterval("suprimer_not('"+pseudo+"');",2000);
}
setInterval(recup_msg,2000);
recup_msg();

function envoi_msg(pseudo)
{
$('#tchatarea').keyup(function(e) {
var message = $('#tchatarea').val();
message = $.trim(message);
if(message != '' && e.keyCode===13 && e.shiftKey===false)
{
 $.post('envoi_msg.php',
 {message:message,
  pseudo : pseudo},function(){
 recup_msg();
 $('#tchatarea').val('');
 });
}
});
}

