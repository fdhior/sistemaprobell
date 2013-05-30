// JavaScript Document

// ID del la fila que esta siendo editada
var editableId = null;

var editableId2 = null;


function enableSelectSearch(id, editMode)
{  
//  alert(id);
//  id = parseint(id, 10);
 
  // gets the <tr> element of the table that contains the table
  var busquedaRow = document.getElementById(id).cells;  
    // are we enabling edit mode?
  if(editMode)
  {
    // we can have only one row in edit mode at one time
 
    if(editableId) enableSelectSearch(editableId, false);
    // store current data, in case the user decides to cancel the changes
    save(id);    
    // enable radio and select items
    busquedaRow[0].getElementsByTagName("input")[0].disabled = false;
    busquedaRow[0].getElementsByTagName("input")[1].disabled = false;
    busquedaRow[0].getElementsByTagName("input")[2].disabled = false;
//    busquedaRow[0].getElementsByTagName("input")[3].disabled = false;

    busquedaRow[0].getElementsByTagName("select")[0].disabled = false;
    busquedaRow[0].getElementsByTagName("select")[1].disabled = false;

    editableId = id;
  }
  // if disabling edit mode...
  else
  {    

    // disable radio and select items
    busquedaRow[0].getElementsByTagName("input")[0].disabled = true;
    busquedaRow[0].getElementsByTagName("input")[1].disabled = true;
    busquedaRow[0].getElementsByTagName("input")[2].disabled = true;
    busquedaRow[0].getElementsByTagName("select")[0].disabled = true;
    busquedaRow[0].getElementsByTagName("select")[1].disabled = true;

    // no item is being enabled
    editableId = null;
  }
}


function enableTimeSearch(id, editMode)
{  
//  alert(id);
//  id = parseint(id, 10);
 
  // gets the <tr> element of the table that contains the table
  var busquedaTRow = document.getElementById(id).cells;  
    // are we enabling edit mode?
  if(editMode)
  {
    // we can have only one row in edit mode at one time
 
    if(editableId2) enableTimeSearch(editableId2, false);
    // store current data, in case the user decides to cancel the changes
    save(id);    
   

    // enable input items
	busquedaTRow[0].innerHTML = 
		 '<input name="activa_tiempo" type="checkbox" id="activa_tiempo" value="on" checked="checked" onclick="javascript: enableTimeSearch(3, false)" />';
    busquedaTRow[1].getElementsByTagName("input")[0].disabled = false;
    busquedaTRow[1].getElementsByTagName("input")[1].disabled = false;
    busquedaTRow[1].getElementsByTagName("input")[2].disabled = false;
    busquedaTRow[1].getElementsByTagName("input")[3].disabled = false;
    busquedaTRow[1].getElementsByTagName("input")[4].disabled = false;
    busquedaTRow[1].getElementsByTagName("input")[5].disabled = false;
    busquedaTRow[1].getElementsByTagName("input")[6].disabled = false;
    busquedaTRow[1].getElementsByTagName("input")[7].disabled = false;
    busquedaTRow[1].getElementsByTagName("input")[8].disabled = false;
    busquedaTRow[1].getElementsByTagName("input")[9].disabled = false;
    busquedaTRow[1].getElementsByTagName("select")[0].disabled = false;
    busquedaTRow[1].getElementsByTagName("select")[1].disabled = false;

    editableId2 = id;
  }
  // if disabling edit mode...
  else
  {    

    // disable input items
	busquedaTRow[0].innerHTML = 
		 '<input name="activa_tiempo" type="checkbox" id="activa_tiempo" value="on" onclick="javascript: enableTimeSearch(3, true)" />';
	busquedaTRow[1].getElementsByTagName("input")[0].disabled = true;
	busquedaTRow[1].getElementsByTagName("input")[1].disabled = true;
    busquedaTRow[1].getElementsByTagName("input")[2].disabled = true;
    busquedaTRow[1].getElementsByTagName("input")[3].disabled = true;
    busquedaTRow[1].getElementsByTagName("input")[4].disabled = true;
    busquedaTRow[1].getElementsByTagName("input")[5].disabled = true;
    busquedaTRow[1].getElementsByTagName("input")[6].disabled = true;
    busquedaTRow[1].getElementsByTagName("input")[7].disabled = true;
    busquedaTRow[1].getElementsByTagName("input")[8].disabled = true;
    busquedaTRow[1].getElementsByTagName("input")[9].disabled = true;
    busquedaTRow[1].getElementsByTagName("select")[0].disabled = true;
    busquedaTRow[1].getElementsByTagName("select")[1].disabled = true;

    // no item is being enabled
    editableId2 = null;
  }
}

function save(id)
{
  // retrieve the product row
  var tr = document.getElementById(id).cells;
  // save the data
  tempRow = new Array(tr.length); 
  for(var i=0; i<tr.length; i++)   
    tempRow[i] = tr[i].innerHTML;   
}
