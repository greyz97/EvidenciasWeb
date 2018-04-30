<?php
$pregunta[0] = "¿Cuanto es 8 + 3 ?";
$pregunta[1] = "¿Cuantos dias tiene una semana?";
$pregunta[2] = "¿Cuato es 9 manzanas + 1 manzan?";
$pregunta[3] = "¿Cuantos dias tiene el mes de Abril?";
$pregunta[4] = "¿Cuantos planetas tiene el sistema solar?";

$resp[0] = "11";
$resp[1] = "7";
$resp[2] = "10";
$resp[3] = "30";
$resp[4] = "8";


function validaRango($numero, $vector){
	$estaEnRango=false;
	$tamvect=sizeof($vector);//sizeof calcula es tamaño del vector y la guarda en $tamvector
	if($numero>0&&$numero<=$tamvect){// valida los rangos
		$estaEnRango=true;//afirmativo
	}
	return $estaEnRango;
}

function validaVariablesRespuesta(){
	$varRes=false;
	if(isset($_POST['respuesta'])){
		if(isset($_POST['index'])){
			$varRes=true;	
		}
	}
	return $varRes;
}

function comparaRespuesta($respuestaUsuario, $respuestavector){
	if($respuestaUsuario==$respuestavector){
		echo "tu respuesta fue ".$_POST['respuesta']." y es <b>correcta</b>";
	}else{
		echo "tu respuesta fue ".$_POST['respuesta']." y es <b>incorrecta</b>";
	}
}


/******************SECCION DE LA PREGUNTA*****************************/

if(isset($_POST['num'])){//isset valida que la variable exista
	if(validaRango($_POST['num'], $pregunta)){// este if valida la funcion validaRango pasando la variable que el 
		//usuario introdujo y el vector de las preguntas
		$num=$_POST['num']-1;
		echo $pregunta[$num];

		?><!-- uso de codigo html para insertar respuesta-->
		<form action="quiz.php" method="POST">
			Ingresa una Respuesta: <input type='text' name='respuesta'>
			<input type="hidden" name="index" value="<?php echo $_POST['num']; ?>"><!-- hidden guarda el valor de la variable de manera oculta para que esta no se pierda la cual es la posicion-->
			<button type="submit">Enviar</button>
		</form>
		<?php

	}else{
		echo "el numero insertado fuera de rango";
	}

	echo "<br /> <h3>Para continuar ingrese otro numero <a href='numero.php'>Volver</a></h3>";
	
}

/****************FIN DE SECCION DE LA PREGUNTA****************************/


/*****************SECCION DE LA RESPUESTA**********************************/

if(validaVariablesRespuesta()){
	$num=$_POST['index']-1;
	comparaRespuesta($_POST['respuesta'], $resp[$num]);

	echo "<br /> <h3>Para continuar ingrese otro numero <a href='numero.php'>Volver</a></h3>";
	

	}

?> 