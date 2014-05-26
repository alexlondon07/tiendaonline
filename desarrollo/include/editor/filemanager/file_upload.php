Subir en la carpeta: <?php echo isset($_GET['folder']) ? $_GET['folder'] : ''; ?>
<div id="optionsWrapper"> 
	<form id="uploadForm" method="post" action="index.php?action=upload" enctype="multipart/form-data">
 <input type="file" name="ffoto">
 <input type="hidden" name="folder" value="<?php echo isset($_GET['folder']) ? $_GET['folder'] : ''; ?>" />
 <input type="submit" value="Upload" class="btn" target="_self" />
 </form>
 <div id="uploadOutput"></div>
</div>	
<br />
Crear carpeta
<div id="optionsWrapper"> 
	<form id="folderForm" method="post" action="index.php?action=create_folder">
 <?php echo isset($_GET['folder']) ? $_GET['folder'] : ''; ?>&nbsp;<input type="text" name="fname" size="20" />
 <input type="hidden" name="folder" value="<?php echo isset($_GET['folder']) ? $_GET['folder'] : ''; ?>" />
 <input type="submit" name="submit" value="Create" class="btn" target="_self" />
 </form>
</div>
Eliminar esta carpeta
<div id="optionsWrapper"> 
	<a href="index.php?action=delete_folder&id=<?php echo isset($_GET['folder']) ? $_GET['folder'] : ''; ?>" target="_self">Eliminar carpeta y todo su contenido</a>
</div>