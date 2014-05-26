<?php
include("confic.inc.php");
//include 'classes/Upload.php';
// upload
 /*
if ($_GET['action']=="upload") {
$uploadFileInfoArr = $_FILES['ffoto'];
$up = new Upload();
//echo $up->get_directory();

$uploadPath = "C:".DIRECTORY_SEPARATOR."Inetpub".DIRECTORY_SEPARATOR."vhosts".DIRECTORY_SEPARATOR."vps.secuencia24.com".DIRECTORY_SEPARATOR."ykkjen.com.co".DIRECTORY_SEPARATOR."admin".DIRECTORY_SEPARATOR."editor".DIRECTORY_SEPARATOR."files".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR;

//echo "<BR/>".$uploadPath;
//echo "<BR/>";
$respuesta=$up->uploadSingleFile(6, $uploadFileInfoArr, $uploadPath, "txt|rtf|pdf|doc|docx|xls|xlsx|ppt|pptx|avi|mp3|jpg|jpeg|gif|png|zip|rar", "no");
$message='<p><b>Tu imagen subio con exito</b></p>';
}
 else if ($_GET['action']=="delete") {
	unlink($_GET['file']);
}
 */
$accion = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
//if ($_GET['action']=="upload") {
if ($accion=="upload") {
	$file_name=$_FILES["ffoto"]["name"];
$file_size=$_FILES["ffoto"]["size"];
$file_type=$_FILES["ffoto"]["type"];
//$path.="http://www.ykkjen.com.co/admin/editor";
//$path.= str_replace('..','',$_POST['folder']);
$path=$_POST['folder'];

move_uploaded_file($_FILES['ffoto']['tmp_name'], $path.$file_name) ;
$message='<p><b>Su archivo se ha subido correctamente</b></p>';
//} else if ($_GET['action']=="delete") {
} else if ($accion=="delete") {	
	unlink($_GET['file']);
}
// Crear carpeta
//if ($_GET['action']=="create_folder") {
if ($accion=="create_folder") {
	$path=$_POST['folder'];
mkdir($path.$_POST['fname'], 0777);
}

//if ($_GET['action']=="delete_folder") {
if ($accion=="delete_folder") {
	//echo 'folder deleted:'.$_GET['id'];
 
	rmdir($_GET['id']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editor</title>
<script language="javascript" src="js/jquery-1.2.6.min.js"></script>
<script language="javascript" src="js/jqueryFileTree.js"></script>
<script language="javascript" src="js/jquery.form.js"></script>
<script language="javascript" src="js/jquery.jframe.js"></script>
<link href="css/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/file_manager.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function F8669f9aa(url,target){
	jQuery(target).loadJFrame(url);
$(target).loadJFrame(url);
}
</script>
<script language="javascript">
$(document).ready(function(){
 $('#navBar').fileTree({ 
		//root: '../../userfiles/',
 root: '<?php echo C4d28b848; ?>', 
 script: 'jqueryFileTree.php', 
 loadMessage: 'Cargando...',
 exts: 'jpeg,jpg,png,gif,tiff,pdf' }
, function(file) { 
			//alert(file);
 
 F8669f9aa('file_details.php?file='+file, '#fileDetails');
});
jQuery.fn.waitingJFrame = function () {
 $(this).html("<b>cargando...</b>");
};	
	$('.op_menu').hover(function () { 
 alert("funka");
}); 
});
</script>
</head>
<body>
<div id="fileWrapper" src="#"> 
	<h2>Administrador de archivos</h2>
 <a href="index.php" target="_self">Actualizar</a>
	<div id="navBar" class="demo" src="#"></div>
 <div id="fileDetails">
 <?php
 $message = isset($message) ? $message : '';
 echo $message;
?>
 Por favor, seleccione el archivo para editar
 </div>
</div>	
<ul id="myMenu" class="contextMenu" style="-moz-user-select: none; top: 191px; left: 319px; display: none;">
	<li class="edit">
 <a href="#edit">Editar</a>
	</li>
	<li class="cut separator">
 <a href="#cut">Cortar</a>
	</li>
	<li class="copy">
 <a href="#copy">Copiar</a>
	</li>
	<li class="paste">
 <a href="#paste">Pegar</a>
	</li>
	<li class="delete">
 <a href="#delete">Eliminar</a>
	</li>
	<li class="quit separator">
 <a href="#quit">Salir</a>
	</li>
</ul>
<script language="javascript">
function Fc310bc56(cual) {
	//alert(cual);
 
	F8669f9aa('file_upload.php?folder='+cual, '#fileDetails');	
}
</script> 
</body>
</html>
