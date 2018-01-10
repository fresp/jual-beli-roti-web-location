$(document).ready(function() {
$("#hidden").css('display', 'block');
$("#progress-bar").animate({width:"65%"}, 500); });
$(window).bind('load', function() {
$("#progress-bar").stop().animate({width:"100%"}, 1000, function() {
$("#hidden").fadeOut(500); }); });