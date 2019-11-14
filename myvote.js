$(document).ready(function(){
	$('.total').click(function() {
		var costVal = parseInt($(this).find('.number').text(), 10);
		if($(this).hasClass('toggled') ) {
			var code = $(this).find('.number').attr('id');
			// Vote Count Down
			$.ajax({
				type: "GET",
				url: "https://poll-upvoting.herokuapp.com/count-down.php",
				data: ({'votecode' : code}),
				success: function(data){	
					var myvar = data;
					//alert (myvar);	
					}	
				});			
			$(this).find('.number').text(costVal-1);
			$(this).removeClass('toggled');
			$(this).css("background", "#fff");
			$(this).css("border-color", "#6e6e71");	 
		}
		else
		{
			var code = $(this).find('.number').attr('id');
			// Vote Count Up
			$.ajax({
				type: "GET",
				url: "https://poll-upvoting.herokuapp.com/getting-count.php",
				data: ({'txtcode' : code}),
				success: function(data){	
					var myvar = data;
					//alert (myvar);	
					}	
				});			
			$(this).find('.number').text(costVal+1);
			$(this).addClass('toggled');
			$(this).css("background", "#f4511c");
			$(this).css("border-color", "#f4511c");
			$(this).find('.toggled .number').css("color", "#fff");
		}	
	});	
});	
