<?php

session_start();
$_SESSION["nombrearchivo"] = "";
$_SESSION["tipoarchivo"] = "";
$_SESSION["contenidooarchivo"] = "";
$_SESSION["tamanio"] = "";
$_SESSION["error"] = "";

$archivo = $_FILES["userfile"]["tmp_name"];
$tamanio = $_FILES["userfile"]["size"];
$tipo = $_FILES["userfile"]["type"];
$nombre = $_FILES["userfile"]["name"];
$error = $_FILES["userfile"]["error"];
if ($archivo != "none") {
    $fp = fopen($archivo, "rb");
    $contenido = fread($fp, $tamanio);
    $contenido = addslashes($contenido);
    fclose($fp);
}
$_SESSION["nombrearchivo"] = $nombre;
$_SESSION["tipoarchivo"] = $tipo;
$_SESSION["contenidooarchivo"] = $contenido;
$_SESSION["tamanio"] = $tamanio;
$_SESSION["error"] = $error;
?>