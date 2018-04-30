<?php 
function concatenar(&$msg)  // se pasa el parametro por referencia
{ 
// en este programa se referencian los parametros con el &.
// al ponerlo la variable es la misma aunque con distinto nombre y se concatenann. 
//sin el & so unico a mostrar es la variable str
   	 $msg .= ' y algo m&aacutes.'; // aqui se esta concatenando el parametro  y algo mas 
   	 // $msg = $msg. ' y algo m&aacutes.'; es igual
} 
$str = 'Esto es una cadena, '; 
concatenar($str); // se envia el parametro actual
echo $str;    // Saca 'Esto es una cadena, y algo más.' 
?>
