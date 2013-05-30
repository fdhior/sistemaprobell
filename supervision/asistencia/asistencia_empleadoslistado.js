// JavaScript Document

// stores the reference to the XMLHttpRequest object
var xmlHttp = createXmlHttpRequestObject();
// the file that returns the requested data in XML format
var feedGridUrl = "asistencia_ejecutamodificar.php";
// ID del la fila que esta siendo editada
var editableId = null;

// creates an XMLHttpRequest instance
function createXmlHttpRequestObject() 
{
  // will store the reference to the XMLHttpRequest object
  var xmlHttp;
 
  // this should work for all browsers except IE6 and older
  try
  {
    // try to create XMLHttpRequest object
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    // assume IE6 or older
    var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
                                    "MSXML2.XMLHTTP.5.0",
                                    "MSXML2.XMLHTTP.4.0",
                                    "MSXML2.XMLHTTP.3.0",
                                    "MSXML2.XMLHTTP",
                                    "Microsoft.XMLHTTP");
    // try every prog id until one works
    for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++) 
    {
      try 
      { 
        // try to create XMLHttpRequest object
        xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
      } 
      catch (e) {}
    }
  }
  // return the created object or display an error message
  if (!xmlHttp)
    alert("Error creating the XMLHttpRequest object.");
  else 
    return xmlHttp;
}


var maxAnchoDisp=screen.availWidth, maxAltoDisp=screen.availHeight; // Se determina el espacio disponible en la pantalla


function recapFoto(idEmpleado)
{
	// Centrar la ventana en la pantalla
	var anchoVent=500, altoVent=470; // Se determina el ancho y el alto iniciales de la ventana
	
    	/* En las líneas siguientes se calcula la posición inicial de la ventana. Para ello, se resta el tamaño inicial del tamaño disponible y se divide por dos */
	var esqIzq=(maxAnchoDisp-anchoVent)/2;
	var esqSup=(maxAltoDisp-altoVent)/2;

	var nomArchivo = 'asistencia_recapturafoto.php';
	var nomVent = 'recapFoto';
	abreVentana(nomArchivo, idEmpleado, nomVent, anchoVent, altoVent, esqSup, esqIzq);

}

function muestraMasOp(idEmpleado)
{

	var anchoVent=630, altoVent=320; // Se determina el ancho y el alto iniciales de la ventana
	
   	/* En las líneas siguientes se calcula la posición inicial de la ventana. Para ello, se resta el tamaño inicial del tamaño disponible y se divide por dos */
	var esqIzq=(maxAnchoDisp-anchoVent)/2;
	var esqSup=(maxAltoDisp-altoVent)/2;

	var nomArchivo = 'asistencia_editamasopciones.php';
	var nomVent = 'masOpciones';
	abreVentana(nomArchivo, idEmpleado, nomVent, anchoVent, altoVent, esqSup, esqIzq);

}

function abreVentana(nomArchivo, idEmpleado, nomVent, anchoVent, altoVent, esqSup, esqIzq)
{

	ventParaAbrir = window.open(nomArchivo+'?idempleado='+idEmpleado, nomVent, 'width='+ anchoVent +',height='+ altoVent +',top='+ esqSup +',left='+ esqIzq +',scrollbars=NO,resizable=NO,directories=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO');

	ventParaAbrir.focus();

}

function editId(id, editMode)
{  
  var productRow = document.getElementById(id).cells;  

  if(editMode)
  {
    // we can have only one row in edit mode at one time
    if(editableId) editId(editableId, false);
    // store current data, in case the user decides to cancel the changes
    save(id);    
    
	// gets the <tr> element of the table that contains the table
	// create editable text boxes
   	productRow[1].innerHTML = '<div class="resaltaedicion"><a ref="#fila'+ id +'" onclick="javascript: recapFoto('+ id +');" '+
							  'title="Da Click para Volver a Capturar la Foto">'+
							  productRow[1].innerHTML +'</a></div';
    productRow[3].getElementsByTagName("input")[0].disabled = false;
   	productRow[4].getElementsByTagName("select")[0].disabled = false;
   	productRow[5].getElementsByTagName("select")[0].disabled = false;
    productRow[6].innerHTML = 
   	     '<input class="input1" type="text" name="contra" ' + 
       	 'value="">';   
//    productRow[7].getElementsByTagName("select")[0].disabled = false;
	productRow[8].innerHTML = 
		 '<a href="#fila'+ id +'"' + 
       	 'onclick="updateRow(document.forms.grid_form_id,' + id + 
         ')">[Actualizar]</a><br/><a href="#fila'+ id +'" onclick="editId(' + id + 
   	     ',false)">[Cancelar]</a>';
		 
	    // save the id of the product being edited
    editableId = id;
  }
  // if disabling edit mode...
  else
  {    

	productRow[1].innerHTML = tempRow[1];
    productRow[3].getElementsByTagName("input")[0].disabled = true;
    productRow[4].getElementsByTagName("select")[0].disabled = true;
    productRow[5].getElementsByTagName("select")[0].disabled = true;
   	productRow[6].innerHTML = 
       	 '<input class="input1" type="password" name="contra" ' + 
         'value="32659898656566466" disabled="disabled">'; 
//	productRow[7].getElementsByTagName("select")[0].disabled = true;
    productRow[8].innerHTML = '<a href="#fila'+ id +'" onclick="editId(' + id +  
                              ',true)">[Editar]</a>' +
							  '<br /><a href="#fila'+ id +'" ' +
							  'onclick="javascript: ' +
							  'muestraMasOp('+ id +')">' +
							  '[Más opciones]</a>';
	
    // no product is being edited    
    editableId = null;
  }
}

// saves the original product data before editing row
function save(id)
{
  // retrieve the product row
  var tr = document.getElementById(id).cells;
  // save the data
  tempRow = new Array(tr.length); 
  for(var i=0; i<tr.length; i++)   
    tempRow[i] = tr[i].innerHTML;   
}

// cancels editing a row, restoring original values
function undo(id)
{
  // retrieve the product row
  var tr = document.getElementById(id).cells;
  // copy old values
  for(var i=0; i<tempRow.length; i++) 
    tr[i].innerHTML = tempRow[i];
  // no editable row 
  editableId = null;    
}

// update one row in the grid if the connection is clear
function updateRow(grid, productId)
{  

	var errorId = 0;
	
	if (escape(grid.elements[0].value) == '0') {
		if (confirm('El valor del campo No. Empleado Probell\n es 0 ¿Deseas dejar sin especificar\nel número de este empleado?')) {
			errorId = 0;
		} else {
			errorId = 1;
		}
	} 
	
	if ((errorId == 0) && (escape(grid.elements[0].value) != '0')) {
		if (isNaN(escape(grid.elements[0].value)) == false) {
			errorId = 0;
		} else {
			errorId = 2;
		}
	} 

	if ((errorId == 0) && (escape(grid.elements[3].value) == '')) {
		if (confirm('La contraseña no tiene valor\n¿Deseas conservar el valor anterior?')) {
			errorId = 0;
		} else {
			errorId = 3;
		}
	}
	
	// alert('Valor de elemento 0: '+escape(grid.elements[0].value));
	// alert('Valor de elemento 0: '+isNaN(escape(grid.elements[0].value)));
	
	switch(errorId) {
		case 1:
			alert('Ingresa un número diferente a 0');
			break;
		case 2:
			alert('El dato ingresado en el campo:\n"No. Empleado Probell" no\nes un número');
			break;
	}	

	
	if (errorId == 0) 
	{

		// continue only if the XMLHttpRequest object isn't busy
		if (xmlHttp && (xmlHttp.readyState == 4 || xmlHttp.readyState == 0))
		{  
 
			var query = "action=UPDATE_ROW&list=empSis&id=" + productId + 
				  	    "&" + createUpdateUrl(grid);
			xmlHttp.open("POST", feedGridUrl, true);

			//Send the proper header information along with the request
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.setRequestHeader("Content-length", query.length);
			xmlHttp.setRequestHeader("Connection", "close");

	    	xmlHttp.onreadystatechange = handleUpdatingRow;
			xmlHttp.send(query);

		} 
	}
} // Cierre de función

// handle receiving a response from the server when updating a product
function handleUpdatingRow()
{ 
  // when readyState is 4, we read the server response
  if(xmlHttp.readyState == 4)
  {
    // continue only if HTTP status is "OK"
    if(xmlHttp.status == 200)
    {
      // read the response
      response = xmlHttp.responseText;
      // server error?
      if (response.indexOf("ERRNO") >= 0 
          || response.indexOf("error") >= 0
          || response.length == 0)
        alert(response.length == 0 ? "Server serror." : response);
      // if everything went well, cancel edit mode
      else 
        editId(editableId, false);
    }
    else 
    {    
      // undo any changes in case of error
      undo(editableId);
      alert("Error on server side.");    
    }
  } 
}

// creates query string parameters for updating a row
function createUpdateUrl(grid)
{
  // initialize query string
  var str = "";
  // build a query string with the values of the editable grid elements
  for(var i=0; i<grid.elements.length; i++) 
//	alert(grid.elements[i].id);	
    switch(grid.elements[i].type) 
    {
	  case "select-one":
		if (!grid.elements[i].disabled)
//		alert(grid.elements[i].selectedIndex);	

//		var selectBox = grid.elements[i].select;
			str += grid.elements[i].name + "=" +
				(grid.elements[i].selectedIndex) + "&";
//		alert(str);
		break;		
      case "text": 
      case "textarea":
//		alert(grid.elements[i].value);
		if (!grid.elements[i].disabled)
		    str += grid.elements[i].name + "=" + 
				escape(grid.elements[i].value) + "&";             
//		alert(str);
        break; 
      case "checkbox":
        if (!grid.elements[i].disabled) 
          str += grid.elements[i].name + "=" + 
                 (grid.elements[i].checked ? 1 : 0) + "&";
        break;
    }
  // alert(str);		
  // return the query string
  return str;
}



