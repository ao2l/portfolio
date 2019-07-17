$(document).ready(function()
{
	$(".year-item").click
	(
		function(e){
			var year = $(e.target).text();
			var urlBuilt = "https://aotoole.net/work/list/" + year + "/";

			$.ajax({
	            url: urlBuilt,
	            type: "GET",

	            contentType: 'application/json; charset=utf-8',
	            success: function(resultData) {
	            	$(".my-work").remove(); //Remove old my_work.

	            	//loop through positions and display information for each
	            	resultData.positions.forEach(function (position, index) {
  						$(".work-body").append("<h5 class = \"my-work card-title\">"+ position.title + "</h5>");	      
	            		$(".work-body").append("<p class = \"my-work my-card-text\">"+ position.company + " (" + position.city + ", " + position.state + ")</p>");  						      		
	            		$(".work-body").append("<p class = \"my-work my-card-text\">"+ position.description + "</p>");

					});
	            },
	            error : function(jqXHR, textStatus, errorThrown) {
	            		$(".my-work").remove(); //Remove old my_work.
	            		$(".work-body").append("<p class = \"my-work my-card-text\"> An error occured: "+ errorThrown + "</p>");
	            },

	            timeout: 120000,
	        	});

			    $([document.documentElement, document.body]).animate({
        			scrollTop: $("#summary-work-service").offset().top
    				}, 2000);
		}
	)

	$(".all-item").click
	(
		function(){
			var urlBuilt = "https://aotoole.net/work/list/";

			$.ajax({
	            url: urlBuilt,
	            type: "GET",

	            contentType: 'application/json; charset=utf-8',
	            success: function(resultData) {
	            	$(".my-work").remove(); //Remove old my_work.

	            	//loop through positions and display information for each
	            	resultData.positions.forEach(function (position, index) {
  						$(".work-body").append("<h5 class = \"my-work card-title\">"+ position.title + "</h5>");	      
	            		$(".work-body").append("<p class = \"my-work my-card-text\">"+ position.company + " (" + position.city + ", " + position.state + ")</p>");  						      		
	            		$(".work-body").append("<p class = \"my-work my-card-text\">"+ position.description + "</p>");

					});
	            },
	            error : function(jqXHR, textStatus, errorThrown) {
	            		$(".my-work").remove(); //Remove old my_work.
	            		$(".work-body").append("<p class = \"my-work my-card-text\"> An error occured: "+ errorThrown + "</p>");
	            },

	            timeout: 120000,
	        	});
		}
	)

	$(".dropdown-menu a").click(function(){
		$(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
		$(this).parents(".dropdown").find('.btn').val($(this).data('value'));
	});
});