<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="" method="post" source="this"> 
Ingresa un numero: <input type="text" name="num" size=""> 

     <legend>Conversion a realizar :</legend>
        <select  name="conver" >
           <option value="convierteBin">Binario</option>
           <option value="convierteHexa">Hexadecimal</option>        
        </select>

	<input type="submit" name="boton" value="Aceptar"> 
</form> 
<?php 
if(isset($_POST['boton']))

include_once("conversion.php")
 ?>


</body>
</html>