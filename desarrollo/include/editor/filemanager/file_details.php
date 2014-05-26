<?php
include("confic.inc.php");
$fil = isset($_GET['file']) ? $_GET['file'] : '';
$file=substr($fil, "3");
?>
<div id="optionsWrapper2">
	<p>
 <b>URL:</b> <?php echo C70d7bd0f.$file; ?><br />
 <a href="javascript:Fa6ccfa7b();">Eliminar este archivo</a>
 &nbsp;&nbsp;-&nbsp;&nbsp;
<a href="javascript:Fe9b0cef7('<?php echo C70d7bd0f.$file; ?>');">Inserte esta imagen</a>
 </p>
</div>
 <?php
	$extension=substr($fil, -4, 4);
if ($extension==".jpg" || $extension==".gif" || $extension==".png") {
 echo '
 <div id="imgWrapper">
 <img src="'.$_GET['file'].'">
 </div>
 ';
} else {
 echo '<a href="'.$fil.'" target="_blank">Ver el archivo</a>';
}
?>	
<script language="javascript">
function Fa6ccfa7b(codigo) {
	var fRet;
fRet = confirm('¿Quieres eliminar este archivo?');
if (fRet==false) {
 return;
} else { 
 window.location='index.php?action=delete&file=<?php echo $fil; ?>';
}
};
function Fe9b0cef7(cual) {
	//var o = opener.document.getElementById("42_textInput");
	var o = $("div.cke_dialog_body input:first", window.opener.document).val(cual);
	//o.value = cual;
	self.close();	
}
</script>