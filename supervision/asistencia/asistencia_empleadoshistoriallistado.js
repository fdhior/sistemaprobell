// JavaScript Document

// var maxAnchoDisp=screen.availWidth, maxAltoDisp=screen.availHeight; // Se determina el espacio disponible en la pantalla

function muestraMasOp(noUsuario)
{

	// var anchoVent=630, altoVent=320; // Se determina el ancho y el alto iniciales de la ventana
	
   	/* En las líneas siguientes se calcula la posición inicial de la ventana. Para ello, se resta el tamaño inicial del tamaño disponible y se divide por dos */
//	var esqIzq=(maxAnchoDisp-anchoVent)/2;
//	var esqSup=(maxAltoDisp-altoVent)/2;

	var nomArchivo = 'asistencia_empleadohistorialdetalle.php';
	var nomVent = 'frmHistorialDetalle';
	abreVentana(nomArchivo, noUsuario, nomVent, 962, 160, 0, 0);
}

function abreVentana(nomArchivo, noUsuario, nomVent, anchoVent, altoVent, esqSup, esqIzq)
{

	ventParaAbrir = window.open(nomArchivo+'?busca=pornousuario&nousuario='+noUsuario, nomVent, 'width='+ anchoVent +',height='+ altoVent +',top='+ esqSup +',left='+ esqIzq +',scrollbars=NO,resizable=NO,directories=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO');

	ventParaAbrir.focus();

}

