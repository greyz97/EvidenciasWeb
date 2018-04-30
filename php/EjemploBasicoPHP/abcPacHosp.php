<?php
/*
Archivo:  abcPersHosp.php
Objetivo: edición sobre Personal Hospitalario
Autor:    
*/
include_once("modelo\PacienteHospitalario.php");
session_start();

$sErr=""; $sOpe = ""; $sCve = ""; $sNomBoton ="Borrar";
$oPacsHosp=new PacienteHospitalario();
$bCampoEditable = false; $bLlaveEditable=false;

$oPacHosp = new PacienteHospitalario();
	/*Verificar que haya sesión*/
	if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		/*Verificar datos de captura*/
		if (isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
			isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])){
			echo "llegaste y hay variables";
			$sOpe = $_POST["txtOpe"];
			$sCve = $_POST["txtClave"];
			if ($sOpe != 'a'){
				echo "esta a punto de hacer una busqueda de ".$sCve;
				$oPacHosp->setIdPaciente($sCve);
				try{
					if (!$oPacHosp->buscar()){
						$sError = "El paciente no existe";
					}else{
						echo "se hizo la busqueda";
					}
				}catch(Exception $e){
					error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
					$sErr = "Error en base de datos, comunicarse con el administrador";
				}
			}
			if ($sOpe == 'a'){
				$bCampoEditable = true;
				$bLlaveEditable = true;
				$sNomBoton ="Agregar";
			}
			else if ($sOpe == 'm'){
				$bCampoEditable = true; //la llave no es editable por omisión
				$sNomBoton ="Modificar";
				echo "el boton es modificar";
			}
			//Si fue borrado, nada es editable y es el valor por omisión
		}
		else{
			$sErr = "Faltan datos";
		}
	}
	else
		$sErr = "Falta establecer el login";
	
	if ($sErr == ""){
		include_once("cabecera.html");
		include_once("menu.php");
		include_once("aside.html");
	}
	else{
		header("Location: error.php?sError=".$sErr);
		exit();
	}
?>
		<section>
			<form name="abcPH" action="resPacABC.php" method="post">
				<input type="hidden" name="txtOpe" value="<?php echo $sOpe;?>">
				<input type="hidden" name="txtClave" value="<?php echo $sCve;?>"/>
				Nombre
				<input type="text" name="txtNombre" 
					<?php echo ($bCampoEditable==true?'':' disabled ');?>
					value="<?php echo $oPacHosp->getNombre();?>"/>
				<br/>
				Apellido Paterno
				<input type="text" name="txtApePat" 
					<?php echo ($bCampoEditable==true?'':' disabled ');?>
					value="<?php echo $oPacHosp->getApePat();?>"/>
				<br/>
				Apellido Materno
				<input type="text" name="txtApeMat" 
					<?php echo ($bCampoEditable==true?'':' disabled ');?>
					value="<?php echo $oPacHosp->getApeMat();?>"/>
				<br/>
				
				Sexo
				<input type="radio" name="rbSexo" value="F"
					<?php echo ($bCampoEditable==true?'':' disabled ');?>
					<?php echo ($oPacHosp->getSexo()=='F'?'checked="true"':'');?>/>Femenino
				<input type="radio" name="rbSexo" value="M"
					<?php echo ($bCampoEditable==true?'':' disabled ');?>
					<?php echo ($oPacHosp->getSexo()=='M'?'checked="true"':'');?>/>Masculino
				<br/>
				Alergias
				<input type="text" name="txtAlergias" 
					<?php echo ($bCampoEditable==true?'':' disabled ');?>
					value="<?php echo $oPacHosp->getAlergias();?>"/>
				<br/>

				<input type ="submit" value="<?php echo $sNomBoton;?>" 
				onClick="return evalua(txtNombre, txtApePat, rbSexo, txtFecNacim);"/>
				<input type="submit" name="Submit" value="Cancelar" 
				 onClick="abcPH.action='tabpacientes.php';">
			</form>
		</section>
<?php
include_once("pie.html");
?>