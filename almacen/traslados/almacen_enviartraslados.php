<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<link href="../Stickman.MultiUpload.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">

.pedlayout_panel1 {
        position: absolute;
        width: 1024px;
}

#apDiv1 {
        position:absolute;
        left:27px;
        top:30px;
        width:442px;
        height:19px;
        z-index:1;
}
#apDiv2 {
        position:absolute;
        left:540px;
        top:30px;
        width:480px;
        height:400px;
        z-index:2;
        border: 1px solid #000000;
}

#apDiv3 {
        position:absolute;
        left:27px;
        top:438px;
        width:181px;
        height:31px;
        z-index:3;
}

#apDiv4 {
        position:absolute;
        left:541px;
        top:441px;
        width:483px;
        height:43px;
        z-index:4;
}

.letra_alertaestado {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #CC0000;

}


.browse_frmpos {
        position: absolute;
        top: 0px;
        height: 100%;
        width: 100%;
}
</style>




<?php


        /**************************************************************************************/
        /* Carga los archivos de Traslado en una carpeta del servidor donde se encotraran     */
        /* disponibles para ser descargados por cada tienda/usuario que lo necesite           */
        /* este script contiene el applet de Java que se encarga de enviar los achivos        */
        /* una vez que se han agregado a la lista de envio, aqui mismo se realiza la          */
        /* configuracion de apariencia y funcionamiento del applet, tambien contiene rutinas  */
        /* en javascript para procesar el estado del applet (callbacks), son eventos que se   */
        /* dan cuando el applet agrega, envia o realiza alguna otra accion, de esta manera es */
        /* es que se logra mostrar en otro marco flotante (iframe) el resumen de los archivos */
        /* procesados                                                                         */
        /**************************************************************************************/


        session_start();
		
		$hostname    = $_SESSION['hostname'];
        $userinmuid  = $_SESSION['userinmuid'];
        $userespname = $_SESSION['userespname'];
        $loggeduser  = $_SESSION['compltusrname'];
        $idusrarea   = $_SESSION['idusrarea'];
        $tipousr     = $_SESSION['tipousr'];
        $iduser      = $_SESSION['iduser'];

        if (isset($_SESSION['upload_log'])) {
                unset($_SESSION['upload_log']);
        }


        $_SESSION['i'] = 0;

        switch ($userinmuid) {
                case "0":
                        $upload_dir = $hostname.'tras_almacen';
                        break;
                case "20":
                        $upload_dir = $hostname.'tras_muebles'; 
                        break;
        }               

//  Mostrar los valores de _SESSION
/*      echo "Valores de _SESSION <br />";
        foreach ($_REQUEST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
                }
        } */
        
/*      echo "<span class=\"tipoletra\">Valores de _SESSION</span><br />";
        foreach ($_SESSION as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
                }
        } */

//echo "".$_REQUEST['dir']."";

        if (isset($_SESSION['error_id'])) {
                $errorpass = $_SESSION['errorpass'];
                $error_id = $_SESSION['error_id'];
                $destino = $_SESSION['destino'];
                $mensaje = $_SESSION['mensaje'];
    }
        unset($_SESSION['errorpass']);
        unset($_SESSION['error_id']);
        unset($_SESSION['destino']);
        unset($_SESSION['mensaje']);    

?>


<script type="text/javascript">

// Este codigo es el que aparece en una p�gina que clama "simplificar" el uso del applet
// lo inclui completo para no afectar la funcionalidad pero la mayor parte de el no
// lo utilizo en la carga de archivos.

function uploaderFilesReset( uploader ) {return JL.onreset(uploader)} 
//followed by the other ~300 lines of JL.js sourcecode 
//... 
JL = { 
     'applet' : function () {return document.jumpLoaderApplet}, 
     /*returns Jumploader version number as splitted array, e.g. "JumpLoader v2.10.3" => [2, 10, 3] */ 
     'version': function() { 
         var version_arr = JL.applet().getAppletInfo().split(' ')[1].substr(1).split('.'); 
         for (var i=0;i < version_arr.length; i++){ 
             version_arr[i] = parseInt(version_arr[i]); 
         } 
         return version_arr; 
      }, 
     'getUploader' : function () { 
         return this.applet().getUploader(); 
      }, 
     '_init': function () {}, 
     //also fire an onready event after applet is initialized 
     '_onload': function (applet) { 
                     this._init(); 
                     this.onready(JL.getUploader()); 
                     this.onload(applet); 
                 },     
     'onload': function (applet) {}, 
     'onstatuschanged': function (uploader) {}, 
     'onupload': function (uploader, file) {}, 
     'onready': function (uploader) {}, 
     'onreset': function (uploader) {}, 
     //view interface 
     'view' : { 
         'SHOW_CONTROL': true, 
         'HIDE_CONTROL': false, 
         'TOGGLE_CONTROL': -1, 
         '_controls' : { 
             UploadView : ['MenuBar','AddAction','RemoveAction','RetryAction','StartAction','StopAction','ListStatus','ProgressPane','FilesSummaryBar'], 
             MainView  : ['FileTreeView', 'FileListView' ], 
             FileTreeView : ['ShowFiles', 'ShowFileLength' ] 
         }, 
  
         '_set_state' : function (control, value) { 
             //here we set the state of the ui component and retrieve it from the controls object above.  
             // setstate will automatically refresh the corresponding view. 
             var view = this._get_view(control); 
             var method_suffix; 
             JL.util.starts_with(control,"Show")? method_suffix = '': method_suffix = 'Visible'; 
             var set_method = 'set' + view + control + method_suffix; 
             var view_method = 'get' + view; 
             this.get_config()[set_method](value); 
             if (view === "MainView"){ 
                 this.get_main_view()['updateView']() 
             } 
             else { 
                 this.get_main_view()[view_method]()['updateView'](); 
             } 
         }, 
         '_get_view': function (control){ 
          //find the view a control belongs to 
             var view = false; 
             for (view in JL.view._controls){ 
                     if (JL.util.in_array (control, JL.view._controls[view])){ 
                         return view 
                     } 
                 } 
            // return view; 
         }, 
          '_get_state' : function (control) { 
            //fetches the state of the given control element - needed for toggling contols. 
            var view =  this._get_view(control); 
            var method_suffix; 
            JL.util.starts_with(control,"Show")? method_suffix = '': method_suffix = 'Visible'; 
            //pattern of get Method: is + name of view + name of control + Visible,  
            //e.g. isUploadViewRemoveActionVisible() 
            var get_method = "is" + view + control + method_suffix; 
            return this.get_config()[get_method]() 
         }, 
  
         '_multi_setter': function (controls, value){ 
         //sets the states of one or multiple controls 
             if (typeof(controls) == "object"){ 
                 for (ctrl_num in controls){ 
                     var control = controls[ctrl_num]; 
                     value === this.TOGGLE_CONTROL? this._set_state(control, !this._get_state(control)):this._set_state(control, value); 
                   } 
             } 
             else { 
                  value === this.TOGGLE_CONTROL? this._set_state(controls, !this._get_state(controls)):this._set_state(controls, value);    
             } 
         }, 
  
         'get_config' : function () { 
             return JL.applet().getViewConfig(); 
         }, 
          'get_main_view' : function () { 
             return JL.applet().getMainView(); 
         }, 
          'show' : function (controls) { 
             this._multi_setter (controls, this.SHOW_CONTROL);           
         }, 
          'hide' : function (controls) { 
            this._multi_setter (controls, this.HIDE_CONTROL);  
              
         }, 
          'toggle' : function (controls) { 
            this._multi_setter (controls, this.TOGGLE_CONTROL);  
         } 
     }, 
     //actions can be assigned to buttons 
     'actions': { 
         start_upload: function () { 
                         var start_upload = JL.upload.onstart(); 
                         if (start_upload === false){ 
                             return false; 
                         } 
                         var error = JL.getUploader().startUpload(); 
                         if( error != null ) { 
                             JL.upload.onerror(error); 
                         } 
                     }, 
         stop_upload: function (){ 
                         JL.upload.onstop(index); 
                         var error = JL.getUploader().stopUpload(); 
                         if( error != null ) { 
                             JL.upload.onerror(error); 
                         } 
             }, 
         //remove all files from jumploader 
         remove_files: function (){ 
             filenum = JL.upload.files(); 
             for (var i=0;i < filenum; i++){ 
                 JL.getUploader().removeFileAt(i); 
             } 
         }, 
         //remove selected files from jumploader 
         remove_selected: function (){}, 
         //reload the applet (but not containing page?) 
         reload_applet: function (options) {} 
         }, 
     //upload interface 
     'upload': { 
         //event handlers 
         'onstart': function () {}, 
         'onstop': function () {}, 
         'onerror': function (error) {}, 
         //these parameters have getter methods starting with 'is' 
         '_is_params' : ['directoriesEnabled', 'duplicateFileEnabled', 'imageEditorEnabled', 'preserveRelativePath', 'sendExif', 
                         'sendFileLastModified', 'sendFilePath', 'sendIptc', 'stretchImages', 'zipDirectoriesOnAdd', 'uploadOriginalImage', 
                         'uploadQueueReorderingAllowed', 'uploadScaledImages', 'uploadScaledImagesNoZip', 'urlEncodeParameters', 
                         'useMainFile', 'useMd5', 'usePartitionMd5'].join(""), 
         //abbreviation functions 
         '_set_param': function (key, value){ 
             set_method =  'set' + key.substr(0,1).toUpperCase() + key.substr(1); 
             this.get_config()[set_method](value); 
         }, 
         /*(re) enable upload*/ 
         'enable': function (){ 
             JL.getUploader().setUploadEnabled(true); 
         }, 
         /*disable upload*/ 
         'disable': function (){ 
             JL.getUploader().setUploadEnabled(false); 
         }, 
         'is_enabled': function(){ 
             return JL.getUploader().isUploadEnabled(); 
         }, 
         '_get_param': function (key, value){ 
             var get_prefix = 'get'; 
             if (this._is_params.indexOf(key) > -1){ 
                 get_prefix = 'is'; 
              } 
             get_method =  get_prefix + key.substr(0,1).toUpperCase() + key.substr(1); 
             return this.get_config()[get_method](); 
         }, 
          'add': function (filepaths){ 
              /*filepaths can be: 
                 - a string identifying one file or directory 
                 - an array holding multiple files or directories 
             */ 
             if (typeof(filepaths) === "string"){ 
                 filepaths = [filepaths];             
             } 
             for (num in filepaths){ 
                 JL.getUploader().addFile(filepaths[num]); 
                 } 
          }, 
        'files': function(findex) { 
             /*when invoked without parameter, returns the file count 
                                  when invoked with index parameter (number), returns the corresponding file 
                                  when invoked with a string id, tries to retrieve the file by id  
                              */ 
             if (findex === undefined) { 
                 return JL.getUploader().getFileCount(); 
             } else if (typeof(findex) === "number") { 
                 return JL.getUploader().getFile(findex); 
             } //iterate through the files and retrieve them by id 
             else if (typeof(findex) === "string") { 
                 var filelist = JL.getUploader().getAllFiles(); 
                 for (var i = 0; i < filelist.length; i++) { 
                     if (filelist[i].getId() === findex) { 
                         return filelist[i]; 
                     } 
                 } 
             } 
             return null; 
         }, 
         'params': function (key, val){ 
         /*user submits upload configuration parameters like scaledInstanceDimensions,... 
               defined here: http://jumploader.com/api/jmaster/jumploader/model/api/config/UploaderConfig.html 
         */ 
             //key is either a dictionary or a parameter to look up 
             if (val === undefined){ 
                 //set or get multiple params at once 
                 if (typeof(key) == "object"){ 
                     //key is an array with multiple params - we return their values in an array 
                     if (typeof(key.join) == "function"){ 
                         var valarr = []; 
                         for (param in key){ 
                             valarr.push(this._get_param (key[param])); 
                         } 
                         return valarr 
                     } 
                     //key is an object with multiple key/value pairs - we set their values 
                     for (param in key){ 
                         this._set_param (param, key[param]); 
                         } 
                 } 
                 //get the value of a param 
                 else { 
                    return this._get_param (key); 
                 } 
             } 
             //key,value pair to set a parameter 
             else { 
                 this._set_param(key, val); 
             } 
      
         }, 
         'get_config' : function (){ 
             return JL.applet().getUploaderConfig(); 
          }, 
         '_get_attr_set': function () { 
             var uploader = JL.getUploader(); 
             var attr_set = uploader.getAttributeSet(); 
             return attr_set; 
         }, 
         'set_attr': function (key, value){ 
             var attr_set = this._get_attr_set(); 
             var attr = attr_set.createStringAttribute(key, value); 
             attr.setSendToServer(true); 
          }, 
         'get_attr': function (key) { 
             var attr_set = this._get_attr_set(); 
             return      attr_set.getAttributeByName(key); 
         } 
     }, 
     'file': { 
             //event handlers 
             'onstatuschanged': function (uploader, file) {}, 
             'onadd': function (uploader, file) {}, 
             'onremove': function (uploader, file) {}, 
             //filetypes 
             'types': { 
                 'image': ['jpeg', 'jpe', 'jpg', 'gif', 'png'], 
                 'source': ['js','py','php','c','rb','as', 'asp','pas','bat','sh','txt','html','htm'], 
                 'video': ['avi','mov','flv','mpg','wmv','vob','3gp','vp3'], 
                 'audio': ['wav','ogg','mp3','wma','aiff','au','ra'], 
                 'documents': ['doc','docx','sxw','odt','txt', 'pdf','xls','xlsx', 'csv', 'ods', 'sxc', 'ppt','pptx','odp', 'sxi','pdf'] 
             }, 
             'get_ratio': function (file){ 
                 var ext = this.get_extension(file); 
                 if (ext === undefined){ 
                     return 0.66; 
                 } 
                 if (JL.util.in_array(ext,['jpg','jpe','jpeg']) ||JL.util.in_array(ext,this.types.video)){ 
                     return 0.05; 
                 } 
                 if (JL.util.in_array(ext,this.types.source)){ 
                     return 0.85; 
                 } 
                 return 0.66; 
              
             }, 
             //enhancement functions - tbd 
             'get_extension': function (file) { 
                 var fname = file.getName(); 
                 var ext = fname.split('.'); 
                 if (ext.length === 1){ 
                     return undefined; 
                 } 
                 else { 
                     return ext[ext.length -1].toLowerCase(); 
                 } 
             }, 
             'get_info': function (file) { 
                 //TODO: distinguish between files and directories safely                 
                 /*if (file.isFile() == false){ 
                     return {} 
                 }*/ 
                 
                 return {'filename': file.getName(), 
                         'path': file.getPath(), 
                         'extension': this.get_extension(file), 
                         'length': file.getLength(), 
                         'kind': undefined 
                         } 
              }, 
             'set_attr': function (file, name, value){ 
                 var attrSet = file.getAttributeSet(); 
                 var attr = attrSet.createStringAttribute( name, value ); 
                 attr.setSendToServer(true); 
              }, 
               
              'get_attr': function (file, name){ 
                 var attrSet = file.getAttributeSet(); 
                 return  attrSet.getAttributeByName(name); 
              }, 
             
             '_is_filetype': function (file, extarr) { 
                 if (JL.util.in_array (JL.file.get_extension(file), JL.file.types[extarr])){ 
                     return true; 
                 } 
                 return false; 
             }, 
             'is_image': function (file) {return _is_filetype(file,'image') }, 
             'is_document': function (file) {return _is_filetype(file,'documents')}, 
             'is_video': function (file) {return _is_filetype(file,'video')}, 
             'is_sourcecode': function (file) {return _is_filetype(file,'source')}, 
             'get_filetype': function (file) {}, 
             'estimate_upload_size': function (file) { 
                 //no image scaling or zipped upload --> return actual filesize 
                 if (JL.upload.params(['zipDirectoriesOnAdd','uploadScaledImages']) === [false, false]){ 
                     return file.getLength();                 
                 } 
                 //zip compression is on --> estimate compression ratio 
                 if (JL.upload.params('zipDirectoriesOnAdd') === true){ 
                     //calculate size by using estimated compression ratio 
                     return file.getLength()*(1- JL.file.get_ratio(file)); 
                 } 
                 //uploadScaledImages --> estimate filesize of generated JPEGs 
                 if (JL.upload.params('uploadScaledImages') === true && JL.file.is_image(file) === true){ 
                    var inst_dims = JL.upload.params('scaledInstanceDimensions').split(','); 
                    var inst_qual = JL.upload.params('scaledInstanceQualityFactors').split(','); 
                    var est_size = 0; 
                    var dim_x, dim_y, qual; 
                    for (num in inst_dims) { 
                       [dim_x,dim_y] = inst_dims[num].split('x'); 
                       qual = inst_qual[num]; 
                       //very simple formula for estimating compressed JPEG filesize 
                       //take 75% of the scaled InstanceDimensions area and multiply with a quality setting to the square 
                       est_size += parseInt(dim_x)*parseInt(dim_y)*0.75*Math.pow(parseInt(qual)/1000,2); 
                     }  
                   return Math.round(est_size); 
                 } 
             } 
          }, 
     //utility functions 
     'util' : { 
         'ebid': function (eid){return document.getElementById(eid);}, 
         'ebtn': function (tn) {return document.getElementByTagName(tn);}, 
         'starts_with': function (haystack, needle){ 
             return (haystack.match("^"+needle)==needle)         
         }, 
         'in_array': function (item, arr){ 
             if (arr.join(',').indexOf(item) > -1){ 
                 return true; 
             } 
             return false; 
         } 
     } 
 } 

JL.onload = function (){ 

} 


</script>


<!-- callback methods -->
<script language="javascript">

// Estas rutinas son de la pagina de el applet son callbacks que envia el applet que informan de estado del mismo
        /**
         * applet initialized notification
         */
        function appletInitialized( applet ) {
                traceEvent( "Applet Incializado, " + applet.getAppletInfo() );
        }
        /**
         * files reset notification
         */
        function uploaderFilesReset( uploader ) {
                traceEvent( "Reset Archivos, CuentaArchivos=" + uploader.getFileCount() );
        }
        /**
         * file added notification
         */
        function uploaderFileAdded( uploader, file ) {
                traceEvent( "Archivos Añadido a la Lista, Indice=" + file.getIndex() + ", Ruta=" + file.getPath() );
        }
        /**
         * file removed notification
         */
        function uploaderFileRemoved( uploader, file ) {
                traceEvent( "Archivo Quitado de la Lista, Ruta=" + file.getPath() );
        }
        /**
         * file moved notification
         */
        function uploaderFileMoved( uploader, file, oldIndex ) {
                traceEvent( "Archivo Movido, Ruta=" + file.getPath() + ", IndiceAnterior=" + oldIndex );
        }
        /**
         * file status changed notification
         */
/*      function uploaderFileStatusChanged( uploader, file ) {
                traceEvent( "Cambio de Estado de Archivo, indice=" + file.getIndex() + ", estado=" + file.getStatus() );
//               + ", contenido=" + file.getResponseContent() );
        } */
        
        // MODIFICACION
        function uploaderFileStatusChanged( uploader, file ) {
                traceEvent( file.getStatus() );
        } 

        
        /**
         * uploader status changed notification
         */
/*      function uploaderStatusChanged( uploader ) {
                traceEvent( "Cmabio de Estado del Applet, estado=" + uploader.getStatus() );
        } */

        // MODIFICACION
        function uploaderStatusChanged( uploader ) {
                traceEvent( uploader.getStatus() );
        }  

        /**
         * uploader selection changed notification
         */
        function uploaderSelectionChanged( uploader ) {
                traceEvent( "Seleccion del Applet Cambiada" );
        }
</script>
 
<!-- debug auxiliary methods -->
<script language="javascript"> 
        /**
         * trace event to events textarea
         */
        function traceEvent( message ) {

                if (message == "2") {
//                      window.parent.browser_frame.location.replace('http://learningjavascript.info/framea.htm');
                        window.open("almacen_trasladoenviar.php","browser_frame","width=600,height=600,top=150,left=200,scrollbars=YES,resizable=NO,directories=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO");
                } else {
                        if (message == "0") {
//                      window.alert("");
//                              var timerID = setTimeout("",1000);
                                var result = confirm("La transferencia de Archivos ha concluido.\r\n�Deseas subir mas Traslados?");
                                if (result == true) {
                                        window.location.reload();
                                } else {
//
//                              document.debugForm.txtEvents.value += message + "\r\n";
                                <?php
                                unset($_SESSION['upload_log']);
                                $_SESSION['i'] = 0;
                                ?>
                                document.forms[0].submit();
                                }
                        }
                } // Cierre de  if
        } // Cierre de funcion
        /**
         * dump status of uploader into html
         */
         function dumpUploaderStatus() {
                var uploader = document.jumpLoaderApplet.getUploader();
                //
                //      dump uploader
                var uploaderDump = "<strong>Uploader</strong><br>" +
                        "Status: " + uploader.getStatus() + "<br>" +
                        "Files total: " + uploader.getFileCount() + "<br>" +
                        "Ready files: " + uploader.getFileCountByStatus( 0 ) + "<br>" +
                        "Uploading files: " + uploader.getFileCountByStatus( 1 ) + "<br>" +
                        "Finished files: " + uploader.getFileCountByStatus( 2 ) + "<br>" +
                        "Failed files: " + uploader.getFileCountByStatus( 3 ) + "<br>" +
                        "Total files length: " + uploader.getFilesLength() + " bytes<br>" +
                        "";
                //
                //      dump files
                var filesDump = "<strong>Files</strong><br>";
                for( i = 0; i < uploader.getFileCount(); i++ ) {
                        var file = uploader.getFile( i );
                        filesDump += "" + ( i + 1 ) + ". path=" + file.getPath +
                                ", length=" + file.getLength() +
                                ", status=" + file.getStatus() +
                                "<br>";
                }
                //
                //      set text
                document.getElementById( "uploaderStatus" ).innerHTML = uploaderDump + "<br>" + filesDump;
         }
</script>


</head>

<body>

<br />
<h2><?php echo $loggeduser; ?>,  Envia Traslados a Tiendas: </h2>


<!-- CONFIGURACION DEL APPLET -->
<div id="apDiv1">
<applet id="jumploader"
        name="jumpLoaderApplet"
        code="jmaster.jumploader.app.JumpLoaderApplet.class"
        archive="messages_es-mx.zip,jumploader_z.jar"
        width="500"
        height="400" 
        mayscript>

        <!-- CONFIGURACION DE TRASFERENCIA DE ARCHIVOS -->
        <param name="uc_directoriesEnabled" value="true" /> 
    <param name="uc_fileNamePattern" value=".*\.zip$">
        <param name="uc_fileNamePatternDescription" value="Archivos de Traslado">
    <param name="uc_uploadUrl" value="uploadHandler.mod.php" />


        <!-- CONFIGURACION DE LA VISTA (ELEMENTOS VISUALES) -->
 
        <param name="vc_FILE_DEFAULT" value="C:\TRASLADOS" />
        <param name="vc_FILE_HOME" value="C:\TRASLADOS" />
        <param name="vc_FILE_ROOTS" value="C:\TRASLADOS" />


        <param name="vc_fileBrowserInitialLocation" value="C:\TRASLADOS" />     <!-- Directorio Local Inicial -->
        <param name="vc_mainViewFileListViewVisible" value="false" />                   <!-- Mostrar la lista de archivos en el directorio local -->
        <param name="vc_fileNamePattern" value=".*\.zip$" />                    <!-- Filtra por tipo de archivo -->  
        <param name="vc_fileListViewShowFolders" value="false" />                       <!-- Se queda en la ubucacion actual -->
    <param name="vc_disableLocalFileSystem" value="false" />                    <!-- Permite acceso al sistema de archivos local -->
    <param name="vc_mainViewShowUploadErrors" value"true" />                        <!-- Muestra los errores de trasferencia de archivos -->
<!--    <param name="vc_uploadViewAddActionVisible" value="false" />                    <!-- Mostrar el botón Start Upload -->
<!--    <param name="vc_uploadViewRemoveActionVisible" value="false" />                 <!-- Mostrar el botón Start Upload -->
        <param name="vc_uploadViewRetryActionVisible" value="false" />                  <!-- Mostrar el botón Start Upload -->

        <param name="vc_uploadViewStartActionVisible" value="false" />                  <!-- Mostrar el botón Start Upload -->
        <param name="vc_uploadViewStopActionVisible" value="false" />                   <!-- Mostrar el botón Stop Upload -->
        
        <!-- CONFIGURACION DEL APPLET -->
    <param name="ac_fireAppletInitialized" value="true"/>
    <param name="ac_fireUploaderFileAdded" value="true"/> 
    <param name="ac_fireUploaderFileReset" value="true"/>
    <param name="ac_fireUploaderFileRemoved" value="true"/>
    <param name="ac_fireUploaderSelectionChanged" value="true"/>
    <param name="ac_fireUploaderFileStatusChanged" value="true"/>
    <param name="ac_fireUploaderStatusChanged" value="true"/> 
</applet>

</div>

<div id="apDiv2">
<iframe class="browse_frmpos" name="browser_frame" id="browser_frame"  title="browser_frame" src="<?php echo $upload_dir; ?>/browser.php" vspace="0" hspace="0" marginheight="0" marginwidth="0" frameborder="0" align="top" scrolling="yes"></iframe> 
<!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

</div>

<form id="form0" name="form0" action="../../iniciolinker.php?linkid=TRAS_1" method="post" target="_top">
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

  <!--<form name="debugForm" id="debugForm">
    <textarea name="txtEvents" rows="25" wrap="off" id="txtEvents" style="width:100%; font:10px monospace;"></textarea>
  </form>-->

<div id="apDiv3">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
<!--    <form name="form0" action="almacen_trasladoenviar.php" method="get" id="form0" target="browser_frame"> -->
      <td><span class="parrafo-4">
        <button onclick="JL.actions.start_upload()">Subir Traslados</button>
      </span></td>
    </form> 
<!--  <td><label>
        <button onclick="JL.actions.stop_upload()">Detener</button>
      </label></td>
      <td><label></label></td> -->
    </tr>
  </table>
</div>
<!-- </form> -->

</body>
</html>

