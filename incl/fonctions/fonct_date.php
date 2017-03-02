<?php


	//Change le la présentation de la date en 'd-m-Y à H\h:i\m\i\n'
	function afficherDate($date) {
	   $phpdate = strtotime( $date );
	   return date( 'd-m-Y à H\hi\m\i\n', $phpdate );
	};
	
?>