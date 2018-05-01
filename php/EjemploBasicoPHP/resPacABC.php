<?php
/*
Archivo:  resABC.php
Objetivo: ejecuta la afectación al personal y retorna a la pantalla de consulta general
Autor:  BAOZ  
*/
echo "estas aqui";
include_once("modelo\PacienteHospitalario.php");
session_start();

echo "estas aqui respacabc";

$sErr=""; $sOpe = ""; $sCve = "";
$oPacHosp = new PacienteHospitalario();
	echo " llegaste a la clase resultado pac";
	/*Verificar que exista la sesión*/
	if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		/*Verifica datos de captura mínimos*/
		echo " reconoce var de sesion";
		if (isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
			isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])){
			echo " muestra variables de clave y op";
			$sOpe = $_POST["txtOpe"];
			$sCve = $_POST["txtClave"];
			echo "esttosss datosss: ".$sOpe." y ".$sCve;
			$oPacHosp->setIdPaciente($sCve);
			
			if ($sOpe != "b"){

				$oPacHosp->setNombre($_POST["txtNombre"]);
				$oPacHosp->setApePat($_POST["txtApePat"]);
				$oPacHosp->setApeMat($_POST["txtApeMat"]);
				//$oPacHosp->setFechaNacim(DateTime::createFromFormat('Y-m-d', $_POST["txtFecNacim"]));
				$oPacHosp->setSexo($_POST["rbSexo"]);
				$oPacHosp->setAlergias($_POST["txtAlergias"]);
			}
			try{
				if ($sOpe == 'a'){
					echo "vas  agregar un paciente";
					$nResultado = $oPacHosp->insertar();
				}
				if ($sOpe == 'b'){
					echo "quieres borrar un paciente: ";
					$nResultado = $oPacHosp->borrar();
				}
				if ($sOpe == 'm'){ 
					echo "quieres modificar";
					$nResultado = $oPacHosp->modificar();
					echo "resultado es: ".$nResultado;
				}
				if ($nResultado != 1){
					$sError = "Error en bd";
					echo "este es el error ".$sError;
				}else{
					echo "la consulta se ejecuto correctamente";
				}
			}catch(Exception $e){
				//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
				error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
				$sErr = "Error en base de datos, comunicarse con el administrador respacb";
			}
		}
		else{
			$sErr = "Faltan datos";
		}
	}
	else{
		$sErr = "Falta establecer el login";
	}
	
	if ($sErr == ""){
		header("Location: tabpacientes.php");
	}
	else{
		header("Location: error.php?sError=".$sErr);
	}
	exit();
?>