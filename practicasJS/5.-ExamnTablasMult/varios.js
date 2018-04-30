/*
Archivo:  varios.js
Objetivo: funciones relacionadas con el "examen de tablas de multiplicar" en JS
Autor:    BAOZ
*/

/*
* Función: muestra
* Objetivo: llena la información para el examen y muestra tabla y botón
* Parámetros: recibe el valor de la base (es cadena), el identificador de la tabla visual y el elemento a mostrar
*/
function muestra(sValor, oTbl, oElemento){
var nTabla=0, i=0;
var oLinea;
var oCeldaOpe, oCeldaRes;
var oCtrl;
	if (isNaN(sValor))
		alert("Debe elegir la tabla de multiplicar");
	else{
		nTabla = parseInt(sValor, 10);
		if (oElemento != null){
			oElemento.style.visibility = "visible";

			if (oTbl != null){
				//Si la tabla está llena, vaciarla primero
				if (oTbl.rows.length>1){
					for (i=1; i<=10; i++)
						oTbl.deleteRow(-1);
				}

				//Colocar operaciones y campos para resultado en la tabla
				for (i=1; i<=10; i++){
					oLinea = oTbl.insertRow(-1);
					oCeldaOpe = oLinea.insertCell(0);
					oCeldaRes = oLinea.insertCell(1);

					oCeldaOpe.innerHTML = nTabla + " * " + i;

					oCtrl = document.createElement("input");
					oCtrl.type="text";
					oCtrl.id = "txtResultado"+i;
					oCeldaRes.appendChild(oCtrl);
				}
			}
		}
	}
}

/*
* Función: califica
* Objetivo: verifica las respuestas capturadas en cada celda de la tabla
* Parámetros: recibe el valor de la base (es cadena), el identificador de la tabla visual y el elemento a mostrar
*/
function califica(sValor, oTbl){
var nTabla=0, i=0, nCapturado=0, nCalif=0;
var sValorCapturado="", sErr="";
	if (isNaN(sValor))
		sErr = "Debe elegir la tabla de multiplicar";
	else{
		nTabla = parseInt(sValor, 10);

		//Recorrer los campos si ya están pintados
		if (oTbl.rows.length>1){
			for (i=1; i<=10; i++){
				sValorCapturado = document.getElementById("txtResultado"+i).value;
				if (isNaN(sValorCapturado))
					sErr = sErr + "Error de captura en el resultado "+i + "\n";
				else{
					nCapturado = parseInt(sValorCapturado,10);
					if (nCapturado == (nTabla*i)){
						
					document.getElementById("txtResultado"+i).style.backgroundColor = "green";
						nCalif++;
					}
					else{
						document.getElementById("txtResultado"+i).style.backgroundColor = "red";
					}
				}
			}
		}
	}
	if (sErr == "")
		alert("Calif = "+nCalif);
	else
		alert(sErr);
}
