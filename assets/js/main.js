var main = new Main();
main.init();

function Main() {
	var is_show = false;

	this.init = function() {
		hamburgerMenuListener();
		// categoryPageListener();
	}

	function hamburgerMenuListener() {
		$("#hamburger-menu").click(function() {
		   $( "#app-menu" ).show("slide", {direction: "left"}, 300, function(){
		   	  $("#overlay-body").fadeIn("fast");

		   });
		});

		$("#overlay-body").click(function(){
			     $("#app-menu").hide("slide", {direction: "left"}, 300, function(){
			         $("#overlay-body").fadeOut("fast");
		     	 });
				
				 $(".cart-modal-container").hide("slide", {direction: "right"}, 300, function(){
					 $("#overlay-body").fadeOut("fast");
				 });

				 $(".slide-modal-container").hide("slide", {direction: "right"}, 300, function(){
					 $("#overlay-body").fadeOut("fast");
				 });

				 $("#transaction-history-slide-container").hide("slide", {direction: "right"}, 300, function(){
					 $("#overlay-body").fadeOut("fast");
				 });

				 $("#transaction-detail-slide-container").hide("slide", {direction: "right"}, 300, function(){
					 $("#overlay-body").fadeOut("fast");
				 });
		});

		$("#close-menu").click(function(){
			if($( "#app-menu" ).show()){
			   $( "#app-menu" ).hide("slide", {direction: "left"}, 300, function(){
			   		  $("#overlay-body").fadeOut("fast");
		      });
			}
		});
	}

	function categoryPageListener() {
		if($('#page-selection').length > 0){
			$('#page-selection').bootpag({
			   total: 23,
			   page: 1,
			   maxVisible: 5
			}).on('page', function(event, num){
			});
		}
	}

}
