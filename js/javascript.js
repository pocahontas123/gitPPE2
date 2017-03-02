//Barre de recherche animation
$("#inputRecherche").mouseover(function() {
	$(this).animate({ width: "200px" }, 500);
}).mouseout(function() {
	$(this).animate({ width: "100px" }, 500);
});


//animation menu utilisateur
$(document).ready(function() {
	var nav = $("#nav-bar");
	var button = $("#button-menu");
	$(button).on("click", function() {
		$(nav).toggleClass("expand");
		$("#button-menu i").toggleClass("fa-rotate-90");
	});	
});