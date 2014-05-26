<?php
   /**
    * Clase que contiene metodos para subir archivos al servidor
    * @author Camilo Garzon Calle
    * @version 1.0
    */
class Upload {
    /**
	* Valor de un KB = 1024 bytes
	* @var int 
	*/
    public $KB_BYTE = 1024;
    /**
	* Valor de un MB = 1024 KB
	* @var int 
	*/
    public $MB_BYTE = 1048576;

    public function __construct() {
	//$this->UTILITY = new Util();
    }

    /**
	* metodo para conocer la ubicacion del archivo donde es llamado
	* @return string
	*/
    public function get_directory() {
	$d = getcwd();//sirve para conocer la ubicacion del archivo donde es llamado
	//$d = dirname(__FILE__);//solo sirve para conocer la ubicacion del propio archivo
	return $d;
    }

    public function remove_weird_char($str) {
	    if ($str == null || count($str) <= 0) { return $str;}
	    $realstr = ereg_replace("Ã¡","a",$str);
	    $realstr = ereg_replace("Ã©","e",$realstr);
	    $realstr = ereg_replace("Ã­","i",$realstr);
	    $realstr = ereg_replace("Ã³","o",$realstr);
	    $realstr = ereg_replace("Ãº","u",$realstr);
	    return $realstr;
    }

    /**
	* Metodo para cargar archivos al servidor. Importante asegurarse que 
	* la carpeta de destino tiene permiso de escritura.
	* <br/><br/>Ejemplo de uso:
	* <code>
	* $up = new Upload();
	* $uploadPath = $up->get_directory().DIRECTORY_SEPARATOR;
	* $result = $up->uploadImage(6, $uploadFileInfoArr, $uploadPath, "txt|pdf|sql|dicom"));
	* </code>
	* @param int $maxSizeMB Tamano maximo del archivo a subir
	* @param array $uploadFileInfoArr Parametro capturado en $_FILE[]
	* @param string $uploadPath Directorio fisico donde se almacena el archivo que se sube
	* @param string $validType Los tipo de archivo validos por defecto son: "txt|rtf|pdf|doc|docx|xls|xlsx|ppt|pptx|avi|mp3|jpg|jpeg|gif|png|zip|rar"
	* @param string $overWrite Por defecto se re-escribe todo archivo con el mismo nombre
	* @param string $newName Si NO se re-escribe el archivo, este toma el nombre aqui ingresado o por defecto el TIMESTAMP
	* @return array array('code' => $code, 'filename' => $safe_filename, 'content' => $content)
	*/
    public function uploadSingleFile($maxSizeMB, $uploadFileInfoArr, $uploadPath, $validType="txt|rtf|pdf|doc|docx|xls|xlsx|ppt|pptx|avi|mp3|jpg|jpeg|gif|png|zip|rar", $overWrite="yes", $newName="_") {
	$fileTmpName = $uploadFileInfoArr['tmp_name'];
	$fileNameUser = $uploadFileInfoArr['name'];
	$fileName = $uploadFileInfoArr['name'];
	$fileSize = $uploadFileInfoArr['size'];
	$fileError = $uploadFileInfoArr['error'];
	//Se establece el Tamaño maximo permitido para cargar un archivo
	$fileMaxSize = $maxSizeMB * $this->MB_BYTE; 
	//Se establecen las Extensiones válidas de archivos para cargar
	$fileValidType = $validType;
	$rEFileTypes = "/^\.($fileValidType){1}$/i"; 
	//Se verifica que el archivo se ha cargado de manera apropiada
	$isFile = is_uploaded_file($fileTmpName); 
	$code = 10;
	if ($isFile) {
	    //se eliminan las tildes en el nombre del archivo
	    $fileName = $this->remove_weird_char($fileName);
	    $safe_filename = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($fileName)); 
	    $safe_filename = ereg_replace("Ã","_",$safe_filename);
	    if ($fileSize <= $fileMaxSize && preg_match($rEFileTypes, strrchr($safe_filename, '.'))) {
		if ($overWrite!="yes") {
		    if ($newName=="_") {
			$today = date("YmdHis"); 
			$safe_filename = $today."_".$safe_filename;
		    } else {
			$safe_filename = $newName;
		    }
		}
		$moved = move_uploaded_file ($fileTmpName, $uploadPath.$safe_filename);
		if($moved) { 
		    $content = "Archivo subido con exito a ".$uploadPath.$safe_filename;
		} else { 
		    $code = 11;
		    $content = " Se ha producido un error al cargar el archivo. Codigo de error: ".$fileError." , ubicacion: ".$uploadPath.$safe_filename."  #Esto probablemente se debe a que necesita asignar permisos de lectura-escritura a la carpeta de destino: ".$uploadPath;
		}
	    } else {
		$content = "El archivo *" .$fileNameUser. "* no se pudo cargar";
		if ($fileSize >= $fileMaxSize) {
		    $code = 12;
		    $content = $content." debido a que su tamaño es Mayor que " .$fileMaxSize/$this->MB_BYTE. " MB."; 	
		}
		if (!preg_match($rEFileTypes, strrchr($safe_filename, '.'))) {
		    $code = 13;
		    $content = $content." debido a que la extensión del archivo es incorrecto. Sólo se permite cargar archivos con las siguientes extensiones: ". $fileValidType .".";
		}
	    }
	} else {
	    $code = 14;
		$safe_filename = $fileNameUser;
	    $content = $content."El archivo *" .$fileNameUser. "* no se pudo cargar.\n\nSe ha prevenido una falla en la seguridad del sistema.";
	}

	if($fileError == UPLOAD_ERR_OK) {
	    $code = $fileError;$content = $content." 0### File uploaded with success.";
	} else if($fileError == UPLOAD_ERR_INI_SIZE) {
	    $code = $fileError;$content = $content." 1### ERROR: The uploaded file exceeds the upload_max_filesize directive in php.ini.";
	} else if($fileError == UPLOAD_ERR_FORM_SIZE) {
	    $code = $fileError;$content = $content." 2### ERROR: The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
	} else if($fileError == UPLOAD_ERR_PARTIAL) {
	    $code = $fileError;$content = $content." 3### ERROR: The uploaded file was only partially uploaded.";
	} else if($fileError == UPLOAD_ERR_NO_FILE) {
	    $code = $fileError;$content = $content." 4### ERROR: No file was uploaded.";
	} else if($fileError == UPLOAD_ERR_NO_TMP_DIR) {
	    $code = $fileError;$content = $content." 6### ERROR: Missing a temporary folder.";
	} else if($fileError == UPLOAD_ERR_CANT_WRITE) {
	    $code = $fileError;$content = $content." 7### ERROR: Failed to write file to disk.";
	} else if($fileError == UPLOAD_ERR_EXTENSION) {
	    $code = $fileError;$content = $content." 8### ERROR: A PHP extension stopped the file upload.";
	} else {
	    $code = 100;$content = $content." ### ERROR: Maybe File is empty... fileError=".$fileError."_WTF_";
	}
	return array('code' => $code, 'filename' => $safe_filename, 'content' => $content);
    }


}

?>
