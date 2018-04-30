<?php
/*
Archivo:  tabpacientes.php
Objetivo: consulta general sobre pacientes y acceso a operaciones detalladas
Autor:    
*/
include_once("modelo\Usuario.php");
include_once("modelo\PacienteHospitalario.php");
session_start();
$sErr="";
$sNom="";
$arrPacHosp=null;
$oUsu = new Usuario();
$oPacHosp = new PacienteHospitalario();
	/*Verificar que exista sesión*/
	if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		$oUsu = $_SESSION["usu"];
		$sNom = $oUsu->getPersHosp()->getNombre();
		try{
			//Buscar lista de pacientes
			$arrPacHosp = $oPacHosp->buscarTodos();
			echo "este tamaño ".sizeof($arrPacHosp);
		}catch(Exception $e){
			//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
			error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
			$sErr = "Error en base de datos, comunicarse con el administrador";
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
			<h3>Pacientes</h3>
			<!--<form name="formTablaGral" method="post">
				<input type="hidden" name="txtClave">
				<input type="hidden" name="txtOpe">
				EN CONSTRUCCI&Oacute;N
			</form> -->
			<form name="formTablaGral" method="post" action="abcPacHosp.php">
				<input type="hidden" name="txtClave">
				<input type="hidden" name="txtOpe">
				<table border="1">
					<tr><!-- nombres de mis columnas en la tabla a pintar-->
						<td>Clave</td>
						<td>Nombre</td>
						<td>Apellido Paterno</td>
						<td>Apellido Materno</td>
						
						<td>sexo</td>
						<td>Alergias</td>
						<td>Operaciones</td>
						
					</tr>
					<?php
					echo "este tamaño 2 ".sizeof($arrPacHosp);
						if ($arrPacHosp!=null){
							foreach($arrPacHosp as $oPacHosp){
								echo "1";
					?>
					<tr> <!-- va a pintar los datos en la tabla-->
						<td class="llave"><?php echo $oPacHosp->getIdPaciente(); ?></td>
						<td><?php echo $oPacHosp->getNombre(); ?></td>
						<td><?php echo $oPacHosp->getApePat(); ?></td>
						<td><?php echo $oPacHosp->getApeMat(); ?></td>
						
						<td><?php echo $oPacHosp->getSexo(); ?></td>
						<td><?php echo $oPacHosp->getAlergias(); ?></td>

						<td>
							<input type="submit" name="Submit" value="Modificar" onClick="txtClave.value=<?php echo $oPacHosp->getIdPaciente(); ?>; txtOpe.value='m'">
							<input type="submit" name="Submit" value="Borrar" onClick="txtClave.value=<?php echo $oPacHosp->getIdPaciente(); ?>; txtOpe.value='b'">
						</td>
					</tr>
					<?php 
							}//foreach
						}else{
					?>     
					<tr>
						<td colspan="2">No hay datos</td>
					</tr>
					<?php
						}
					?>
				</table>
				<input type="submit" name="Submit" value="Crear Nuevo" onClick="txtClave.value='-1';txtOpe.value='a'">
			</form>
		</section>
<?php
include_once("pie.html");
?>