$(document).ready(function() {
	
    $('#ratingdiv img').each(function(i) {
        $(this).mouseover(function() { setRating(i + 1) });
        $(this).mouseout(function(){
        	setRating($('#currate').val());
        });
        $(this).click(function() {
        	confirmRating($(this).parent().attr('ref'), i + 1) 
        });
    })
});

function setRating(point){
	  	stars = new Array("R1","R2","R3","R4","R5");
	  	start = parseInt(point);
	  	
	  	for(i=0; i<5; i++){
	  		if(i >= start){
	  			src = baseUrl + "javascripts/icampus/rating/images/rate0.png";
	  			$('#'+stars[i]).attr("ref", '');
	  		}
		  	if(i < parseInt(point)){
		  		src = baseUrl + "javascripts/icampus/rating/images/rate1.png";
		  		$('#'+stars[i]).attr("ref", 'star');
		  	}

		  	$('#'+stars[i]).attr("src", src);
	  	}
}

function confirmRating(objId, p){
		html  =  '<span id="logintorate"><a href="'+baseUrl+'users/login">Login to rate</a></span>';
		if(logged == 1) 
			html = '<span id="rateit" onclick="rateit();">Rate it</span> | <span id="cancelrate" onclick="cancelrate();">Cancel</span>';
		
			iscript = '<script>'+
					'	function rateit(){'+
					'		vsf.get("textbooks/rate/' + objId + '/' + p + '", "confirmrating");return false;'+
					'	};'+
//					'	function logintorate(){'+
//					'		location.href="'+baseUrl+'users/login"'+
//					'	};'+
					'	function cancelrate(){'+
					'		$("#confirmrating").html("");'+
					'	};'+
					'</script>';
		 
		$('#confirmrating').html(html + iscript);
}