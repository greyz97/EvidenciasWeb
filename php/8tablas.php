<?php
$ciudad[] = "París";// aunque los vectores no esten inizializados php por defaul toma la numeracion de acuerdo al orden de la eszcritura
$ciudad[] = "Roma";
$ciudad[] = "Sevilla";
$ciudad[] = "Londres";
print ("<h3>Juan vive en " . $ciudad[0] . "<BR><h3>");
print ("<h3>Rosa vive en " . $ciudad[2] . "<BR></h3>");
?>

<br><hr>
<p>
<?php
$ciudad = array("París", "Roma", "Sevilla", "Londres");
//se cuenta el número de elementos de la tabla
$numelentos = count($ciudad);
//mostrar todos los elementos de la tabla
for ($i=0; $i < $numelentos; $i++)
{
	print ("La ciudad $i es $ciudad[$i] <BR>\n");
}
?>
</p>
<br><hr>

<?php
//Si no se especifica, el primer índice es el cero, pero se puede utilizar el operador => 
//para especificar el indice inicial.
$ciudad = array(1=>"París", "Roma", "Sevilla", "Londres");// el uno indica que el vector comienza en 1 y no en 0
//se cuenta el número de elementos de la tabla
$numelentos = count($ciudad);
//mostrar todos los elementos de la tabla
for ($i=1; $i <= $numelentos; $i++)
{
print ("La ciudad $i es $ciudad[$i] <BR>\n");
}
?>
<br><hr>

<?php
$semana = array("lunes", "martes", "miércoles", "jueves", "viernes", "sábado", "domingo");
echo "<h3>El total de días de la semana es: ".count($semana)."</h3><br>"; //7(count cuenta los elementos del arreglo)
//se coloca el índice en el primer elemento del array
reset($semana); //donde se encuentra el apuntador
echo current($semana),"<br>"; //lunes(valor actual del apuntador)
next($semana);//el apuntador pasa al siguiente 
echo pos($semana),"<br>"; //martes
end($semana);
echo pos($semana),"<br>"; //domingo
prev($semana);
echo current($semana); //sábado
?>

<br><hr>

<?php
$visitas = array("lunes"=>200, "martes"=>186, "miércoles"=>190, "jueves"=>175, "viernes"=>350);
reset($visitas);
while (list($clave, $valor) = each($visitas))
{
	echo "el día $clave ha tenido $valor visitas<BR>";
}
?>


<br><hr>
<?php
$calendario[] = array (1, "enero", 31);
$calendario[] = array (2, "febrero", 28);
$calendario[] = array (3, "marzo", 31);
$calendario[] = array (4, "abril", 30);
$calendario[] = array (5, "mayo", 31);
while (list($clave, $valor ) = each($calendario))
{
	$cadena = $valor[1];
	$cadena .= " es el mes número " . $valor[0];
	$cadena .= "y tiene " . $valor[2] . " días<BR>";
	echo $cadena;
}
?>


<br/><hr/>
<?php
$entrada = array ("Miguel", "Pepe", "Juan", "Julio", "Pablo"); 

//modifica el tamaño 
$salida = array_slice ($entrada, 0, 3); //UTILIZADO Para agregar
//muestro el array 
foreach ($salida as $actual) 
    echo $actual . "<br>"; 

echo "<p>"; 

//modifica otra vez 
$salida = array_slice ($salida, 1); 
//muestro el array 
foreach ($salida as $actual) 
    echo $actual . "<br>"; 
?> 


<?php
$entrada = array ("Miguel", "Pepe", "Juan", "Julio", "Pablo"); 
 //quito la primera casilla 
$salida = array_shift ($entrada); // utilizado para eliminAR
//muestro el array 
echo "La función devuelve: " . $salida . "<br>"; 
foreach ($entrada as $actual) 
echo $actual . "<br>"; 
echo "<p>"; 
//quito la primera casilla, que ahora sería la segunda del array original 
$salida = array_shift ($entrada); 
echo "La función devuelve: " . $salida . "<br>"; 
//muestro el array 
foreach ($entrada as $actual)  
echo $actual . "<br>"; 
?> 


<?php
$estadios_futbol = array("Barcelona"=> "Nou Camp","Real Madrid" => "Santiago Bernabeu","Valencia" => "Mestalla","Real Sociedad" => "Anoeta"); 

//mostramos los estadios 
foreach ($estadios_futbol as $indice=>$actual) 
    echo $indice . " -- " . $actual . "<br>"; 
echo "<p>"; 
//eliminamos el estadio asociado al real madrid 
unset ($estadios_futbol["Real Madrid"]); // utilizado para eliminar
//mostramos los estadios otra vez 
foreach ($estadios_futbol as $indice=>$actual) 
echo $indice . " -- " . $actual . "<br>"; 
?>  


<?php
$tabla = array ("Lagartija", "Araña", "Perro", "Gato", "Ratón"); 
//aumentamos el tamaño del array 
array_push($tabla, "Gorrión", "Paloma", "Oso"); 
foreach ($tabla as $actual) 
    echo $actual . "<br>"; 
?>  


<?php
$tabla = array ("Lagartija", "Araña", "Perro", "Gato", "Ratón"); 
$tabla2 = array ("12","34","45","52","12"); 
$tabla3 = array ("Sauce","Pino","Naranjo","Chopo","Perro","34"); 
//aumentamos el tamaño del array 
$resultado = array_merge($tabla, $tabla2, $tabla3); // aumenta el tamaño de el arreglo
foreach ($resultado as $actual) 
    echo $actual . "<br>"; 
?>  




