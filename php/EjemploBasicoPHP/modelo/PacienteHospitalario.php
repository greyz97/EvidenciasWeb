<?php
/*
Archivo:  PersonalHospitalario.php
Objetivo: clase que encapsula la información de una persona que labora en el hospital
Autor:    
*/
echo "estas aqui paciente hospitalario";
include_once("AccesoDatos.php");
include_once("Paciente.php");
class PacienteHospitalario extends Paciente{
	
	private $nIdPaciente=0;
	
    function setIdPaciente($pnIdPaciente){
       $this->nIdPaciente = $pnIdPaciente;
    }   
    function getIdPaciente(){
       return $this->nIdPaciente;
    }
	
	/*Busca por clave, regresa verdadero si lo encontró*/
	function buscar(){
		echo "estas en la funcion buscar";
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$bRet = false;
	echo "1";
		if ($this->nIdPaciente==0){
			echo "no trae id";
			throw new Exception("PacienteHospitalario->buscar(): faltan datos");
		}
		else{
			echo "si trae id ".$this->nIdPaciente;
			if ($oAccesoDatos->conectar()){
				echo "se conecto";
		 		$sQuery = " SELECT nidpac, snombre, sapepat, sapemat, dfecnacim, 
								  ssexo, salergias
							FROM paciente 
							WHERE nidpac = ".$this->nIdPaciente;
				$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
				$oAccesoDatos->desconectar();
				echo "estodevuelve".$arrRS[0][6]." ...ya fue";
				if ($arrRS){
					echo "se ejecuto la consulta";
					$this->sNombre = $arrRS[0][1];
					$this->sApePat = $arrRS[0][2];
					$this->sApeMat = $arrRS[0][3];
					//$this->dFechaNacim = DateTime::createFromFormat('Y-m-d',$arrRS[0][4]);
					$this->sSexo = $arrRS[0][5];
					$this->sAlergias = $arrRS[0][6];
					$bRet = true;
				}else{
					echo "no devolvio nada";
				}
			} 
		}
		return $bRet;
	}
	/*Insertar, regresa el número de registros agregados*/
	function insertar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->sNombre == "" OR $this->sApePat == "" OR 
		    $this->sSexo == "" OR $this->sAlergias == "")//falta fecha
			throw new Exception("PacienteHospitalario->insertar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
				$fech= "11-10-1970";
		 		$sQuery = "INSERT INTO paciente (snombre, sapepat, sapemat, dfecnacim,
											ssexo, salergias) 
					VALUES ('".$this->sNombre."', '".$this->sApePat."', 
					 '".$this->sApeMat."', 
					'".Datetime::createFromFormat('d-m-Y', $fech)->format('Y-m-d')."', 
					'".$this->sSexo."', '".$this->sAlergias."');";
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				echo "Este es el resultado del query agregar :  ".$nAfectados." <- fin y query: ".$sQuery;
				$oAccesoDatos->desconectar();			
			}else{
				echo "no se pudo conectar";
			}
		}
		return $nAfectados;
	}
	
	/*Modificar, regresa el número de registros modificados*/
	function modificar(){
		echo "has llegado al metodo mofidicar";
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->nIdPaciente==0 OR $this->sNombre == "" OR $this->sApePat == "" OR 
		    $this->sSexo == "" OR $this->sAlergias == ""){
			echo "hay datos vacios".$this->nIdPaciente.$this->sNombre.$this->sApePat .$this->sSexo. $this->sAlergias;
			throw new Exception("PacienteHospitalario->modificar(): faltan datos");
		}		
		else{
			echo "en el metodo moficiar traes datis ahora intentemos ";
			if ($oAccesoDatos->conectar()){
				echo "se realico la conexion ahora a modificar";
		 		$sQuery = "UPDATE paciente 
					SET snombre= '".$this->sNombre."', 
					sapepat= '".$this->sApePat."', 
					sapemat= '".$this->sApeMat."',					
					ssexo = '".$this->sSexo."', 
					salergias = '".$this->sAlergias."'
					WHERE nidpac = ".$this->nIdPaciente."";
					echo "consulta : ".$sQuery;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				echo "este es el resultado de modificar: ".$nAfectados;
				$oAccesoDatos->desconectar();
			}else{
				echo "ha ocurrido un error en la conexion no se por que";
			}
		}
		return $nAfectados;
	}
	
	/*Borrar, regresa el número de registros eliminados*/
	function borrar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->nIdPaciente==0){
			echo "faltan datos por borrar";
			throw new Exception("PacienteHospitalario->borrar(): faltan datos");

		}
		else{
			if ($oAccesoDatos->conectar()){
				echo "se hizo la conexion y estas a punto de  borrar ";
		 		$sQuery = "DELETE FROM paciente WHERE nidpac= ".$this->nIdPaciente;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				echo "consulta es : ".$sQuery;
				echo "este es el resultado de borrar el id ".$this->nIdPaciente." y el resultado es ".$nAfectados."<- fin";
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}
	
	/*Busca todos los registros del personal hospitalario, 
	 regresa falso si no hay información o un arreglo de PersonalHospitalario*/
	function buscarTodos(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$aLinea=null;
	$j=0;
	$oPacHosp=null;
	$arrResultado=false;
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT nidpac,snombre, sapepat, sapemat, 
							  dfecnacim, ssexo, salergias
				FROM paciente 
				ORDER BY nidpac";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $aLinea){
					$oPacHosp = new PacienteHospitalario();
					$oPacHosp->setIdPaciente($aLinea[0]);
					$oPacHosp->setNombre($aLinea[1]);
					$oPacHosp->setApePat($aLinea[2]);
					$oPacHosp->setApeMat($aLinea[3]);
					$oPacHosp->setFechaNacim(DateTime::createFromFormat('Y-m-d',$aLinea[4]));
					$oPacHosp->setSexo($aLinea[5]);
					$oPacHosp->setAlergias($aLinea[6]);
            		$arrResultado[$j] = $oPacHosp;
					$j=$j+1;
                }
			}
			else
				$arrResultado = false;
        }
		return $arrResultado;
	}
}
?>