<?php

include ("menu_functions.php");


function selectmenu($itnum, $subitnum)
{ // inicia función
	// iniciamnos sesión
	session_start();

	$idtipousr = $_SESSION['idtipousr'];
	$permisos  = $_SESSION['permisos'];
	$idusrarea = $_SESSION['idusrarea'];
	
	// Almacenamos la variables de control
	$activestr = 'class="submenu-active" ';
	$offstr    ='class="submenu-last"';
	
	$Hidlinkonstbar  = 'onMouseover="return hidestatus()"';
	$Hidlinkonstbar2 = 'onclick="return hidestatus()"';


	// SUBITEMS MODULO TIENDAS
	if ($permisos[usa_tiendas] == 1 && $itnum == 'active_TIE') {
	// Sub Menu Resumen
?>
<!--<link href="styles.css" rel="stylesheet" type="text/css" /> -->


<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="submenu-td1">&nbsp;</td>
		<td class="submenu-td2"><?php 
									if ($permisos[usa_tie_1] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_TIE_1") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=TIE_1" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Resumen</a>
                              <?php } // Resumen Tiendas ?>        

								<?php 
									if ($permisos[usa_tie_2] == 1) {	
        						?>
				                <a <?php
										if ($subitnum == "active_TIE_2") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
									?>
								    href="iniciolinker.php?linkid=TIE_2" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Crear Tienda</a>
                              <?php } // Eliminar Tienda ?>    

							    <?php 
									if ($permisos[usa_tie_3] == 1) {	
        						?>
				                <a <?php
										if ($subitnum == "active_TIE_3") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
									?>
								    href="iniciolinker.php?linkid=TIE_3" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Eliminar Tienda</a>
                              <?php } // Eliminar Tienda ?>        
									 	
									 
							    <?php 
									if ($permisos[usa_tie_4] == 1) {	
        						?>
                                <a <?php
										if ($subitnum == "active_TIE_4") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
									?>
                                    href="iniciolinker.php?linkid=TIE_4" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Modificar Tienda</a>
                              <?php } // Modificar Tienda ?>        
                                
							    <?php 
									if ($permisos[usa_tie_5] == 1) {	
        						?>
                                 <a <?php
										if ($subitnum == "active_TIE_5") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
									?>
							    	href="iniciolinker.php?linkid=TIE_5" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Consultar Tiendas</a>
                              <?php } // Consultar Tiendas ?>        

                                    
                                </td>
							  <td class="submenu-td3">&nbsp;</td>
							</tr>
						</table>
					</div>
<?php
	} // CIERRE MODULO TIENDAS
	

	// SUBITEMS MODULO CURSOS
	if ($permisos[usa_cursos] == 1 && $itnum == 'active_CUR') {
	// Sub Menu Resumen
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="submenu-td1">&nbsp;</td>
		<td class="submenu-td2"><?php 
									if ($permisos[usa_cur_1] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_CUR_1") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=CUR_1" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Alta de Cursos</a>
                              <?php } // Alta de Cursos ?>

							   <?php 
									if ($permisos[usa_cur_2] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_CUR_2") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=CUR_2" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Modificar Cursos</a>
                              <?php } // Modificar Cursos ?>

							   <?php 
									if ($permisos[usa_cur_3] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_CUR_3") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=CUR_3" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Editar T&eacute;cnicos</a>
                              <?php } // Editar Técnicos ?>

							   <?php 
									if ($permisos[usa_cur_4] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_CUR_4") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=CUR_4" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Editar L&iacute;neas</a>
                              <?php } // Modificar Cursos ?>

							   <?php 
									if ($permisos[usa_cur_5] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_CUR_5") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=CUR_5" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Consultar Cursos</a>
                              <?php } // Modificar Cursos ?></td>
		  <td class="submenu-td3">&nbsp;</td>
		</tr>
	</table>
</div>
<?php
	} // CIERRE MODLULO CURSOS

	// MODULO ALMACEN
	if ($permisos[usa_almacen] == 1 && $itnum == "active_ALM") {
	// Sub Menu Resumen y oopciones de area
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="submenu-td1">&nbsp;</td>
		<td class="submenu-td2"><?php 
									if ($permisos[usa_alm_1] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_ALM_1") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=ALM_1" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Resumen</a>
                              <?php } // Resumen Adminstracion ?></td>
	  		<td class="submenu-td3">&nbsp;</td>
		</tr>
	</table>
</div>

<?php
	} // CIERRE MODULO ALMACEN


	// MODULO SUPERVISION
	if ($permisos[usa_sprv] == 1 && $itnum == "active_SUP") {
	// Sub Menu Resumen y oopciones de area
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="submenu-td1">&nbsp;</td>
		<td class="submenu-td2"><?php 
									if ($permisos[usa_sprv_1] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_SUP_1") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=SUP_1" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Resumen</a>
                              <?php } // Resumen Adminstracion ?></td>
	  		<td class="submenu-td3">&nbsp;</td>
		</tr>
	</table>
</div>

<?php
	} // CIERRE MODULO SUPERVISION
	

	// MODULO ADMINISTRACION
	if ($permisos[usa_admon] == 1 && $itnum == "active_ADM") {
	// Sub Menu Resumen y oopciones de area
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="submenu-td1">&nbsp;</td>
		<td class="submenu-td2"><?php 
									if ($permisos[usa_adm_1] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_ADM_1") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=ADM_1" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Resumen</a>
                              <?php } // Resumen Adminstracion ?></td>
	  		<td class="submenu-td3">&nbsp;</td>
		</tr>
	</table>
</div>

<?php
	} // CIERRE MODULO ADMINISTRACION
	
	// MODULO PEDIDOS
	if ($permisos[usa_pedidos] == 1 && $itnum == "active_PED") {
// Sub Menu Tiendas
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="submenu-td1">&nbsp;</td>
		<td class="submenu-td2"><?php 
									if ($permisos[usa_ped_1] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_PED_1") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=PED_1" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Pedidos Enviados</a>
                              <?php } // Pedidos Enviados ?>        
                              
							   <?php 
									if ($permisos[usa_ped_2] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_PED_2") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=PED_2" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Enviar Pedidos</a>
                              <?php } // Enviar Pedidos ?>                              

							  <?php 
									if ($permisos[usa_ped_3] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_PED_3") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=PED_3" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Pedidos Descargados</a>
                              <?php } // Pedidos Descargados ?>        
                              
							   <?php 
									if ($permisos[usa_ped_4] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_PED_4") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=PED_4" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Descargar Pedidos</a>
                              <?php } // Descargar Pedidos ?> 
                              
                              <?php 
									if ($permisos[usa_ped_5] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_PED_5") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=PED_5" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Consultar Pedidos</a>
                              <?php } // Consultar Pedidos ?>        
                              
							   <?php 
									if ($permisos[usa_ped_6] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_PED_6") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=PED_6" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Administrar Pedidos</a>
                              <?php } // Administrar Pedidos ?>
           	</td>
		  <td class="submenu-td3">&nbsp;</td>
		</tr>
	</table>
</div>
<?php
	} // CIERRE MODULO PEDIDOS
	
	// MODULO TRASLADOS
	if ($permisos[usa_traslados] == 1 && $itnum == 'active_TRAS') {

?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="submenu-td1">&nbsp;</td>
		<td class="submenu-td2"><?php 
									if ($permisos[usa_tras_1] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_TRAS_1") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=TRAS_1" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Traslados Descargados</a>
                              <?php } // Traslados Descargados ?>


								<?php 
									if ($permisos[usa_tras_2] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_TRAS_2") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=TRAS_2" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Descargar Traslados</a>
                              <?php } // Descargar Traslados ?>

								<?php 
									if ($permisos[usa_tras_3] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_TRAS_3") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=TRAS_3" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Traslados Enviados</a>
                              <?php } // Traslados Enviados ?>

								<?php 
									if ($permisos[usa_tras_4] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_TRAS_4") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=TRAS_4" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Enviar Traslados</a>
                              <?php } // Enviar Descargados ?>


								<?php 
									if ($permisos[usa_tras_5] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_TRAS_5") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=TRAS_5" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Consultar Traslados</a>
                              <?php } // Consultar Traslados ?>

								<?php 
									if ($permisos[usa_tras_6] == 1) {	
        						?>
								<a <?php
										if ($subitnum == "active_TRAS_6") {
											echo $activestr;
										} else {
											echo $offstr;	
										}
				                    ?>
                    	            href="iniciolinker.php?linkid=TRAS_6" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Administrar Traslados</a>
                              <?php } // Asministrar Traslados ?></a>		
										
    					  	    </td>
							  <td class="submenu-td3">&nbsp;</td>
							</tr>
						</table>
					</div>
<?php
	} // CIERRE MODLULO TRASLADOS
	
	
	// MODULO ASISTENCIA
	if ($permisos[usa_asistencia] == 1 && $itnum == 'active_ASIS') {
// Sub Menu Tiendas
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="submenu-td1">&nbsp;</td>
		<td class="submenu-td2">
 		                 <?php
				   		   if ($permisos[usa_asis_1] == 1) { ?> 
                                <a
									<?php
                                    if ($subitnum == "active_ASIS_1") {
										echo $activestr; 
									} else {
										echo $offstr;
									}
									?>
									href="iniciolinker.php?linkid=ASIS_1" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Checar Asistencia</a>
                      <?php } ?>

						  <?php			
						  	if ($permisos[usa_asis_2] == 1) { ?> 
                                <a
                                    <?php
									if ($subitnum == "active_ASIS_2") {
										echo $activestr; 
									} else {
										echo $offstr;
									}
									?>
	  								href="iniciolinker.php?linkid=ASIS_2" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Registro Empleados</a>
                      <?php } ?>


						  <?php			
						  	if ($permisos[usa_asis_3] == 1) { ?> 
                                <a
                                    <?php
									if ($subitnum == "active_ASIS_3") {
										echo $activestr; 
									} else {
										echo $offstr;
									}
									?>
                                   	href="iniciolinker.php?linkid=ASIS_3" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Administrar Empleados</a>
                      <?php } ?>

						  <?php	
							if ($permisos[usa_asis_4] == 1) { ?>
                                <a
									<?php	
									if ($subitnum == "active_ASIS_4") {
										echo $activestr; 
									} else {
										echo $offstr;
									}
									?>
                                  	href="iniciolinker.php?linkid=ASIS_4" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Reportes Asistencia</a>
					  <?php } ?>			


					      <?php
							if ($permisos[usa_asis_5] == 1) { ?> 
	                           	<a
									<?php	
									if ($subitnum == "active_ASIS_5") {
										echo $activestr; 
									} else {
										echo $offstr;
									}
									?>
									href="iniciolinker.php?linkid=ASIS_5" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Historial de Cambios</a>
					  <?php } ?>
         </td>      
		<td class="submenu-td3">&nbsp;</td>
	</tr>
</table>
</div>
<?php
	} // CIERRE MODLULO ASISTENCIA


	// MODULO USUARIOS
	if ($permisos[usa_usuarios] == 1 && $itnum == "active_USU") {
// Sub Menu Usuarios
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="submenu-td1">&nbsp;</td>
        <td class="submenu-td2"><?php
							if ($permisos[usa_usu_1] == 1) { ?> 
	                           	<a
									<?php	
									if ($subitnum == "active_USU_1") {
										echo $activestr; 
									} else {
										echo $offstr;
									}
									?>
									href="iniciolinker.php?linkid=USU_1" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Agregar Usuarios</a>
					  <?php } ?>

                                    
						<?php
							if ($permisos[usa_usu_2] == 1) { ?> 
	                           	<a
									<?php	
									if ($subitnum == "active_USU_2") {
										echo $activestr; 
									} else {
										echo $offstr;
									}
									?>
									href="iniciolinker.php?linkid=USU_2" 
									<?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Modificar Usuarios</a>
					  <?php } ?></td>
		  <td class="submenu-td3">&nbsp;</td>
	</tr>
</table>
</div>
<?php
	} // CIERRE DE MODULO USUARIOS




if ($itnum == "active1") {
// Sub Menu SUPERVISION
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
						<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="submenu-td1">&nbsp;
									
								</td>
								<td class="submenu-td2">
                                    <a
  									<?php
                                    if ($subitnum == "active1") {
										echo "$activestr"; 
									} 
									?>
									href="iniciolinker.php?linkid=0" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Resumen</a>		
				           								
  					                <a 
                                    <?php
									if ($subitnum == "active2") {
										echo "$activestr"; 
									}
									?>
								    href="iniciolinker.php?linkid=S_1" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Visitas</a>
                                    
                                    <a
                                    <?php
									if ($subitnum == "active4") {
										echo "$activestr"; 
									}
									?>
									href="iniciolinker.php?linkid=S_2" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Tickets de Soporte</a>

                                    <a
									<?php
                                    if ($subitnum == "active6") {
										echo "$activestr"; 
									}
									?>
									href="iniciolinker.php?linkid=S_5" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Rutas</a>

	                                <a
                                    <?php
									if ($subitnum == "active7") {
										echo "$activestr"; 
									}
									?>
									href="iniciolinker.php?linkid=S_6" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Archivos</a>

	                                <a
                                    <?php
									if ($subitnum == "active8") {
										echo "$activestr"; 
									}
									?>
									href="iniciolinker.php?linkid=S_7" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Reportes</a>

<?php
if ($permisos[usa_conf] == '1') {
?>
                                    <a
									<?php	
									if ($subitnum == "active9") {
										echo "$activestr"; 
									}
									?>
									 class="submenu-last" href="iniciolinker.php?linkid=S_8" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Administraci&oacute;n</a> 
<?php
} // cierre de if tipousr
?>




										
    					  	    </td>
							  <td class="submenu-td3">&nbsp;
									
							  </td>
							</tr>
						</table>
					</div>
<?php
	} // Cierre de Sub Mmenú SUPERVISION

	if ($itnum == "active_MANT_1") {
// Sub Menu SISTEMAS
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
						<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="submenu-td1">&nbsp;
									
								</td>
								<td class="submenu-td2">
                   		            <a
									<?php
  									if ($subitnum == "active_MANT_1") {
										echo "$activestr"; 
									}
									?> 
									href="iniciolinker.php?linkid=MANT_1" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Inventario</a>
									
  					                <a
                                    <?php
									if ($subitnum == "active_MANT_2") {
										echo "$activestr"; 
									}
									?>
									href="iniciolinker.php?linkid=MANT_2" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Agregar Equipos</a>

                                    <a
                                    <?php
									if ($subitnum == "active_MANT_3") {
										echo "$activestr"; 
									}
									?>
									href="iniciolinker.php?linkid=4" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Buscar En Inventario</a>
                                    
                                    <a
									<?php
                                    if ($subitnum == "active_MANT_4") {
										echo "$activestr"; 
									}
									?>
									 class="submenu-last" href="iniciolinker.php?linkid=5" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Modificar Inventario</a>
						  		</td>
								<td class="submenu-td3">&nbsp;
									
								</td>
							</tr>
						</table>
					</div>                  
<?php
} // Cierre de Sub Menu Sistemas                  

if ($itnum == "active4") {
// Sub Menu MENSAJES
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
						<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="submenu-td1">&nbsp;
									
								</td>
								<td class="submenu-td2">
                                   <a
                                    <?php
  									if ($subitnum == "active1") {
										echo "$activestr"; 
									}
									?> 
									href="iniciolinker.php?linkid=lk_sp_1" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Resumen</a>		
                                    <a
                                    <?php
  									if ($subitnum == "active2") {
										echo "$activestr"; 
									}
									?> 
									href="iniciolinker.php?linkid=lk_sp_2" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Tickets de Ayuda</a>		

  					           		<a
                                    <?php
  									if ($subitnum == "active3") {
										echo "$activestr"; 
									}
									?> 
									href="iniciolinker.php?linkid=lk_sp_3" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Centro de Soluciones</a>
									
	  					           	<a
                                    <?php
									if ($subitnum == "active4") {
										echo "$activestr"; 
									}
									?>
									 class="submenu-last" href="iniciolinker.php?linkid=lk_sp_4" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Administraci&oacute;n</a>


						  		</td>
								<td class="submenu-td3">&nbsp;
									
								</td>
							</tr>
						</table>
					</div>                    
<?php
} // Cierre de Menu MenSAJES


if ($itnum == "active5") {
// Sub Menu EVENTOS
?>
<div class="submenu-position"><!--SUBMENU: Muss vor Mainmenu stehen-->
						<table class="submenu-table" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="submenu-td1">&nbsp;
									
								</td>
								<td class="submenu-td2">
                                    <a
                                    <?php
  									if ($subitnum == "active1") {
										echo "$activestr"; 
									}
									?> 
				     				href="iniciolinker.php?linkid=0" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Ultimos Eventos</a>

         			           		<a
                                    <?php
  									if ($subitnum == "active2") {
										echo "$activestr"; 
									}
									?> 
									href="iniciolinker.php?linkid=1&orden=tiendacount" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Eventos Proximos</a>
									
  					           		<a
                                    <?php
									if ($subitnum == "active3") {
										echo "$activestr"; 
									}
									?>
									 class="submenu-last" href="iniciolinker.php?linkid=2" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Administrar Eventos</a>
																		
						  		</td>
								<td class="submenu-td3">&nbsp;
									
								</td>
							</tr>
						</table>
					</div>
<?php                                      
} // Cierre de Sub Menu EVENTOS

// MENU PRINCIPAL 
?>
<div class="mainmenu">


<?php

	// SE ACTIVA EL ELMENTO SEGUN SE NECESITE		
	if ($permisos[usa_usuarios] == "1") {
		$highlightitem = 'Usuarios';

		if ($permisos[usa_usu_2] == 1) {		
			$hrefstring = 'iniciolinker.php?linkid=USU_2';
		}

		if ($permisos[usa_usu_1] == 1) {		
			$hrefstring = 'iniciolinker.php?linkid=USU_1';
		}
		
		if ($itnum == "active_USU") { 
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {	  
?>
			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Usuarios</a>
<?php
	    } // Cierre de else
	} // Cierre if usa_conf	


	// MODULOS TRASLADOS 
	if ($permisos[usa_traslados] == "1") { 
		$highlightitem = 'Traslados';
		
		if ($permisos[usa_tras_6] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TRAS_6';
		}

		if ($permisos[usa_tras_5] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TRAS_5';
		}

		if ($permisos[usa_tras_4] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TRAS_4';
		}

		if ($permisos[usa_tras_3] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TRAS_3';
		}

		if ($permisos[usa_tras_2] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TRAS_2';
		}

		if ($permisos[usa_tras_1] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TRAS_1';
		}
		
		if ($itnum == "active_TRAS") { 
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {	  
?>

			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Traslados</a>

<?php
	    } // Cierre de else
	} // Cierre de if


	// MODULO PEDIDOS
	if ($permisos[usa_pedidos] == "1") { 
		$highlightitem = 'Pedidos';

		if ($permisos[usa_ped_6] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=PED_6';
		}

		if ($permisos[usa_ped_5] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=PED_5';
		}

		if ($permisos[usa_ped_4] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=PED_4';
		}

		if ($permisos[usa_ped_3] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=PED_3';
		}

		if ($permisos[usa_ped_2] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=PED_2';
		}

		if ($permisos[usa_ped_1] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=PED_1';
		}

		if ($itnum == "active_PED") { 
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {	  

?>

			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Pedidos</a>

<?php

	    } // Cierre de else
	} // Cierre de if

	
	// MODULO ASISTENCIA
	if ($permisos[usa_asistencia] == "1") { 
		$highlightitem = 'Asistencia';

		if ($permisos[usa_asis_5] == 1) {	
			$hrefstring = 'iniciolinker.php?linkid=ASIS_5';
		}
		
		if ($permisos[usa_asis_4] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=ASIS_4';
		}

		if ($permisos[usa_asis_3] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=ASIS_3';
		}

		if ($permisos[usa_asis_2] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=ASIS_2';
		}

		if ($permisos[usa_asis_1] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=ASIS_1';
		}
		
		if ($itnum == "active_ASIS") { 
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {	  
?>

			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Asistencia</a>

<?php

    	} // Cierre de else
	} // Cierre de if
	

	// INICIO AREA TIENDAS
	if ($permisos[usa_tiendas] == "1") {
		$highlightitem = 'Tiendas';

		if ($permisos[usa_tie_5] == 1) {	
			$hrefstring = 'iniciolinker.php?linkid=TIE_5';
		}
		
		if ($permisos[usa_tie_4] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TIE_4';
		}

		if ($permisos[usa_tie_3] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TIE_3';
		}

		if ($permisos[usa_tie_2] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TIE_2';
		}

		if ($permisos[usa_tie_1] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=TIE_1';
		}

		if ($itnum == "active_TIE") { 
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {	  
?>

			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Tiendas</a>

<?php
	    } // Cierre de else
	} // Cierre de if	


	// MODULO CURSOS
	if ($permisos[usa_cursos] == "1") {
		$highlightitem = 'Cursos';

		if ($permisos[usa_cur_5] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=CUR_5';
		}

		if ($permisos[usa_cur_4] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=CUR_4';
		}

		if ($permisos[usa_cur_3] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=CUR_3';
		}

		if ($permisos[usa_cur_2] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=CUR_2';
		}

		if ($permisos[usa_cur_1] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=CUR_1';
		}

		if ($itnum == "active_CUR") { 
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {
?>
			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Cursos</a>
<?php
        }	  
	} // CIERRE MODULO CURSOS
	

	// INICIO AREA ADMINISTRACION
	if ($permisos[usa_admon] == 1) {
		$highlightitem = 'Administraci&oacute;n';

		if ($permisos[usa_adm_1] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=ADM_1'; 
		}

		if ($itnum == "active_ADM") { 
			
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {	  
?>
		<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Administraci&oacute;n</a>
<?php
	    } // Cierre de else
	} // Cierre de if	

	// INICIO AREA ALMACEN
	if ($permisos[usa_almacen] == 1) {
		$highlightitem = 'Almacen';
		
		if ($permisos[usa_alm_1] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=ALM_1'; 
		}

		if ($itnum == "active_ALM") { 
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {	  
?>
			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Almacen</a>
<?php
	    } // Cierre de else
	} // Cierre de if	

	// MODULO SOLUCIONES EN LINEA
	if ($permisos[usa_sol] == "1") {
		$hrefstring = 'iniciolinker.php?linkid=lk_sp_1';
		if ($itnum == "active4") { 
			$highlightitem = 'Soporte En Linea';
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {
?>   
	    <a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Soporte En Linea</a>
<?php
	     }				  
	}

	// MODULO SOPORTE TECNICO
	if ($permisos[usa_soporte] == "1") {
		$hrefstring = 'iniciolinker.php?linkid=1';
		if ($itnum == "active2") { 
			$highlightitem = 'Soporte T&eacute;cnico';
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {
?>
			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Soporte T&eacute;cnico</a>

<?php
		}
	}			
	
	
	// MODULO MANTENIMIENTO	
	if ($permisos[usa_man] == "1") {
		$hrefstring = 'iniciolinker.php?linkid=MANT_1';
		if ($itnum == "active_MANT_1") { 
			$highlightitem = 'Mantenimiento';
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {
?>
			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Mantenimiento</a>
<?php
        }	  
	} // cierre permisos usa_man
	

	// INICIO AREA SUPERVISION
	if ($permisos[usa_sprv] == 1) {
		$highlightitem = 'Supervisi&oacute;n';

		if ($permisos[usa_sprv_1] == 1) {
			$hrefstring = 'iniciolinker.php?linkid=SUP_1';
		}
		
		if ($itnum == "active_SUP") { 
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {	  
?>
			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Supervisi&oacute;n</a>
<?php
		} // Cierre de else	        
	} // Cierre de if area	


	// INICIO AREA SISTEMAS
	if ($idusrarea == "1") {
		$hrefstring = 'iniciolinker.php?linkid=SIS_1';
		if ($itnum == "active_SIS_1") { 
			$highlightitem = 'Sistemas';
	  		makeitactive($hrefstring, $highlightitem, $Hidlinkonstbar, $Hidlinkonstbar2);                  
		} else {	  
?>
			<a href="<?php echo $hrefstring; ?>" <?php echo $Hidlinkonstbar.' '.$Hidlinkonstbar2; ?>>Sistemas</a>
<?php
		} // Cierre de else	        
	} // Cierre de if area	
?> 

</div> <!-- // FIN DEL CODIGO DEL MENU -->

					
<?php
} // Cierre de función
					
					
?>					
