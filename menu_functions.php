<?php

// ESTA FUNCION ACTIVA EL ITEM EN SIDE MENU
function makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2)
{

	echo '<div class="mainmenu-active">
          	<table class="mainmenu-active-table" border="0" cellspacing="0" cellpadding="0">
        		<tr>
        			<td class="mainmenu-active-td1"></td>
        			<td class="mainmenu-active-td2"><a href="'.$hrefstring.'" '.$Hidlinkonstbar.' '.$Hidlinkonstbar2.'>'.$highlightitem.'</a></td>
                    <td class="mainmenu-active-td3">&nbsp;</td>
				</tr>
   		 	</table>
         </div>';
		return(0);

}





?>