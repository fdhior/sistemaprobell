// JavaScript Document

var maxAnchoDisp=screen.availWidth, maxAltoDisp=screen.availHeight; // Se determina el espacio disponible en la pantalla

function muestraMasOp(idEmpleado, periodoChecada)
{

	var anchoVent=971, altoVent=320; // Se determina el ancho y el alto iniciales de la ventana
	
   	/* En las líneas siguientes se calcula la posición inicial de la ventana. Para ello, se resta el tamaño inicial del tamaño disponible y se divide por dos */
	var esqIzq=(maxAnchoDisp-anchoVent)/2;
	var esqSup=(maxAltoDisp-altoVent)/2;

	var nomArchivo = 'asistencia_empleadoperiodochecadasdetalle.php';
	var nomVent = 'detallePeriodo';
	abreVentana(nomArchivo, idEmpleado, periodoChecada, nomVent, anchoVent, altoVent, esqSup, esqIzq);

}

function abreVentana(nomArchivo, idEmpleado, periodoChecada, nomVent, anchoVent, altoVent, esqSup, esqIzq)
{

	ventParaAbrir = window.open(nomArchivo+'?idempleado='+idEmpleado+'&periodoChecada='+periodoChecada, nomVent, 'width='+ anchoVent +',height='+ altoVent +',top='+ esqSup +',left='+ esqIzq +',scrollbars=NO,resizable=NO,directories=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO');

	ventParaAbrir.focus();

}

