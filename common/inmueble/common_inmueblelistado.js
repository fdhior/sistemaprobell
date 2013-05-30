

// stores the reference to the XMLHttpRequest object
var xmlHttp = createXmlHttpRequestObject();
// the file that returns the requested data in XML format
var feedGridUrl = "common_modificarejilla.php";
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

function editId(id, editMode)
{  
  // gets the <tr> element of the table that contains the table
  var productRow = document.getElementById(id).cells;  
  // are we enabling edit mode?
  if(editMode)
  {
    // we can have only one row in edit mode at one time
 
    if(editableId) editId(editableId, false);
    // store current data, in case the user decides to cancel the changes
    save(id);    
    // create editable text boxes
    /*roductRow[2].innerHTML = 
         '<input class="editEnc" type="text" name="nombre" ' + 

         'value="' + productRow[2].innerHTML+'">';*/   

	/*productRow[6].getElementsByTagName("textarea")[0].disabled = false;*/

	/*productRow[4].innerHTML = 
         '<input class="editName" name="direccion" value="' + productRow[4].innerHTML + '"><a href="#" ' + 
         'onclick="updateRow(document.forms.grid_form_id,' + id + 
         ')">Actualizar</a><br/><a href="#" onclick="editId(' + id + 
         ',false)">Cancelar</a>';*/

//	alert(productRow[4].innerHTML);


/*  productRow[3].innerHTML = 
         '<input class="editName" type="text" name="name" ' + 
         'value="' + productRow[1].innerHTML+'">';   
    productRow[4].innerHTML = 
*/		 
    productRow[3].getElementsByTagName("select")[0].disabled = false;

	/*productRow[3].innerHTML = 
         '<select class="select1" name="razonsc"><option selected="selected">' + 
         productRow[3].innerHTML+'</option></select>';*/  

         /*'<select class="select1" name="razonsc"><option selected="selected">'+ 
		  productRow[3].innerHTML+'</option></select>';*/

	productRow[4].innerHTML = 
         '<textarea class="editDirec" name="direccion" cols="17" rows="8">' + 
         productRow[4].innerHTML+'</textarea>';
    productRow[5].getElementsByTagName("select")[0].disabled = false;
    productRow[6].getElementsByTagName("textarea")[0].disabled = false;
    productRow[7].getElementsByTagName("select")[0].disabled = false;
	productRow[8].innerHTML = 
		 '<a href="#fila'+ id +'"' + 
         'onclick="updateRow(document.forms.grid_form_id,' + id + 
         ')">Actualizar</a><br/><a href="#fila'+ id +'" onclick="editId(' + id + 
         ',false)">Cancelar</a>'
    /*productRow[5].innerHTML = '<a href="#" ' + 
         'onclick="updateRow(document.forms.grid_form_id,' + id + 
         ')">Actualizar</a><br/><a href="#" onclick="editId(' + id + 
         ',false)">Cancelar</a>'; */
    // save the id of the product being edited
    editableId = id;
  }
  // if disabling edit mode...
  else
  {    
//  productRow[1].innerHTML = document.forms.grid_form_id.idinmu.value;
//  productRow[2].innerHTML = document.forms.grid_form_id.nombreinmu.value;

 	productRow[3].getElementsByTagName("select")[0].disabled = true;
    productRow[4].innerHTML = document.forms.grid_form_id.direccion.value;
 	productRow[5].getElementsByTagName("select")[0].disabled = true;
 	productRow[6].getElementsByTagName("textarea")[0].disabled = true;
    productRow[7].getElementsByTagName("select")[0].disabled = true;
	/*  productRow[3].getElementsByTagName("input")[0].disabled = true;    */
    productRow[8].innerHTML = '<a href="#fila'+ id +'" onclick="editId(' + id +  
                               ',true)">Editar</a>';
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
	
	if (escape(grid.elements[1].value) == '') {
		if (confirm('La tienda debe tener una dirección\nasociada con ella ¿Deseas Eliminar\nla dirección de esta tienda?')) {
			errorId = 0;
		} else {
			errorId = 1;
		}
	} 
	
	if ((errorId == 0) && (escape(grid.elements[3].value) == '')) {
		if (confirm('La ubicación de la tienda esta en blanco\n¿Deseas Eliminar dejarla en blanco?')) {
			errorId = 0;
		} else {
			errorId = 2;
		}
	} 

	// alert(escape(grid.elements[3].value));
	
	switch(errorId) {
		case 1:
			alert('Teclea una dirección');
			break;
		case 2:
			alert('Ingresa Una Ubicación');
			break;
	}	

	
	if (errorId == 0) 
	{

  		// continue only if the XMLHttpRequest object isn't busy
		if (xmlHttp && (xmlHttp.readyState == 4 || xmlHttp.readyState == 0))
		{  

			var query = "action=UPDATE_ROW&id=" + productId + 
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
} // Cierre de Funcion
 
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
//	alert(grid.elements[i].name);	
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




