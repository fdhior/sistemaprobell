// JavaScript Document

var editableId = null;

var editableId2 = null;


function enableMods(id, editMode, inputName, modTitle)
{  
//  alert(id);
//  id = parseint(id, 10);

  if (!inputName && !modTitle) 
  {
  	inputName == '';
	modTitle == '';
  }
  
  // gets the <tr> element of the table that contains the table
  var inputRule = document.getElementById(id).cells;  
    // are we enabling edit mode?
  if(editMode)
  {
    // we can have only one row in edit mode at one time
 
    // if(editableId) enableMods(editableId, false, inputName, modTitle);
    // store current data, in case the user decides to cancel the changes
    save(id);    
    // enable radio and select items
    // busquedaRow[0].getElementsByTagName("input")[0].disabled = false;
	inputRule[0].innerHTML = '<input name="'+inputName+'" type="checkbox" id="'+inputName+'"'+
							 'checked="checked" value="1" onclick="javascript: enableMods('+ id +', false, \''+inputName+'\', \''+modTitle+'\')"/>'+
                             '<label for="'+inputName+'">'+modTitle+'</label>';
    inputRule[1].getElementsByTagName("input")[0].disabled = false;
    inputRule[1].getElementsByTagName("input")[1].disabled = false;
    inputRule[1].getElementsByTagName("input")[2].disabled = false;
    inputRule[1].getElementsByTagName("input")[3].disabled = false;
    inputRule[1].getElementsByTagName("input")[4].disabled = false;
    inputRule[1].getElementsByTagName("input")[5].disabled = false;


//    busquedaRow[0].getElementsByTagName("input")[3].disabled = false;


    editableId = id;
  }
  // if disabling edit mode...
  else
  {    

//	save(id);
	// disable radio and select items
	inputRule[0].innerHTML = '<input name="'+inputName+'" type="checkbox" id="'+inputName+'"'+
							 'value="1" onclick="javascript: enableMods('+ id +', true, \''+inputName+'\', \''+modTitle+'\')"/>'+
                             '<label for="'+inputName+'">'+modTitle+'</label>';
    inputRule[1].getElementsByTagName("input")[0].disabled = true;
    inputRule[1].getElementsByTagName("input")[1].disabled = true;
    inputRule[1].getElementsByTagName("input")[2].disabled = true;
    inputRule[1].getElementsByTagName("input")[3].disabled = true;
    inputRule[1].getElementsByTagName("input")[4].disabled = true;
    inputRule[1].getElementsByTagName("input")[5].disabled = true;


    // no item is being enabled
    editableId = null;
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

