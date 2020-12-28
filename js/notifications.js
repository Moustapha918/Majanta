function cacher(){
if($('#notifications').css('visibility')== 'hidden')
	$('#notifications').css('visibility',' visible');
	else
	$('#notifications').css('visibility',' hidden');
}

function recup_not()
{
$.getJSON('notifications.php',
	function(data){
		
		var nb_not = '<a href="#post"><div  id="noti" class="noti" onclick= "cacher();"> ' + data['not'][0] +  '</div></a>';
		var notifications = '',i;
		if(data['not'][0] == 0)
		nb_not = '';
		$("#notif1").html(nb_not);
		if(data['not'][0] != 0){
			for (i=1 ; i <= data['not'][0]; i++)
			{
				notifications = notifications + '<li>'+ data['not'][i] + ' a vous envoyé un message</li>' ;
			}
			notifications = '<ul>' + notifications+ '</ul>';
			$('#notifications').html(notifications);
		}
		else
		$('#notifications').html('');
	});

}

setInterval(recup_not,2000);
recup_not();