//Barre de recherche animation
$("#inputRecherche").mouseover(function() {
	$(this).animate({ width: "200px" }, 500);
}).mouseout(function() {
	$(this).animate({ width: "100px" }, 500);
});
