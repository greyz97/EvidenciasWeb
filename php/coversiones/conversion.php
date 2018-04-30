<?php 

 $num=isset($_POST['num'])?$_POST['num']:0;
 $accion=isset($_POST['conver'])?$_POST['conver']:0;
 

function convierteBin($num){

   echo "la conversion es: ".decbin($num);
  
}

function convierteHexa($num){
	echo "la conversion es: ".dechex($num);
}

switch ($accion) {
	case 'convierteBin':
		convierteBin($num);
		break;
	
	case 'convierteHexa':
		 convierteHexa($num);
		break;

	default:
		# code...
		break;
}

 ?>
