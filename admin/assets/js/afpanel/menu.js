// Versi komputer
$(".panel-nav-button").click(function(){
	$(".panel-nav-button").hide(500);
	$("#menu-bar").css("width","17%");
	$("#panel-content").css("margin-left","17%");

});

$(".menu-bar-close").click(function(){
	$("#menu-bar").css("width","0%");
	$(".panel-nav-button").show(500);
	$("#panel-content").css("margin-left","1.4%");
});

// Versi Android | MOBILE DEVICE
$(".panel-nav-button-mobile").click(function(){
	$("#menu-bar-mobile").css("width","100%");
});

$(".menu-bar-close-mobile").click(function(){
	$("#menu-bar-mobile").css("width","0%");
})