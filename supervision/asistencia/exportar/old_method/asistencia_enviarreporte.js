// JavaScript Document

// stores the reference to the XMLHttpRequest object
var xmlHttp = createXmlHttpRequestObject();
// the file that returns the requested data in XML format
var targetLink = "asistencia_generareporte.php";

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

// update one row in the grid if the connection is clear
function enviaReporte()
{  
	var trDescarga = document.getElementById(1).cells;
	// continue only if the XMLHttpRequest object isn't busy
	if (xmlHttp && (xmlHttp.readyState == 4 || xmlHttp.readyState == 0))
	{  
		var variables_post = "<?php echo $post_string; ?>";
		xmlHttp.open("POST", targetLink, true);

		//Send the proper header information along with the request
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", variables_post.length);
		xmlHttp.setRequestHeader("Connection", "close");

	    xmlHttp.onreadystatechange = handleGenerarReporte;

		xmlHttp.send(variables_post);
		
	}
	trDescarga[0].innerHTML = '<input name="button" ' +
							  'type="submit" ' +
							  'id="botonDescarga" ' +
							  'value="Descargar Reporte" onclick="javascript: cierraVentana();" />' +
							  '<input name="formato" ' +
							  'type="hidden" ' +
							  'id="hiddenField" ' +
							  ' value="<?php echo $formato; ?>" />';
	
}// Cierre funcion enviaReporte	


function handleGenerarReporte()
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
//    else 
//      editId(editableId, false);
    }
    else 
    {    
      // undo any changes in case of error
//      undo(editableId);
      alert("Error on server side.");    
    }
  } 
}

function cierraVentana()
{
//	document.forms[0].submit();
	setTimeout ("window.close()", 1000);
	
}