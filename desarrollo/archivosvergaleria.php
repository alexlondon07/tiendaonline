<?php
require 'lib/ConectionDb.php';
$conexionDB = new ConectionDb();
$conexion = $conexionDB->openConect();
$rqst = $_REQUEST;
$ac = isset($rqst['ac']) ? $rqst['ac'] : '';
$id = isset($rqst['id']) ? intval($rqst['id']) : 0;

$tipo = '';
$contenido = '';

if ($ac != '' && $id > 0) {
    $q = "SELECT * FROM tiendaonline_archivos WHERE arc_id = " . $id;
    $result = mysql_query($q, $conexion) or die("ERROR. ***isset***" . mysql_error());
    $resultado = mysql_num_rows($result);
    while ($rowSelect = mysql_fetch_object($result)) {
        $nombrearchivo = ($rowSelect->arc_nombre);
        $tipo = $rowSelect->arc_tipo;
        $contenido = $rowSelect->arc_contenido;
    }
    //PARA IMAGENES Y PDF
    if ($tipo == "image/jpeg" or $tipo == "image/png" or $tipo == "application/pdf" or $tipo == "application/gif" or $tipo == "image/bmp") {
        header("Content-Type: $tipo");
        if ($ac == 'download') {
            header('Content-Disposition: attachment; filename="' . $nombrearchivo . '"');
        }
    }
//    //PARA ARCHIVOS .ZIP
//    if ($tipo == "application/octet-stream" || $tipo == "text/plain") {
//        header('Content-Type: application/octet-stream');
//        header('Content-Disposition: attachment; filename="' . $nombrearchivo . '"');
//        header('Content-Transfer-Encoding: binary');
//    }
//    //PARA ARCHIVOS .MP3
//    if ($tipo == "audio/mp3") {
//        header('Content-Type: audio/mp3');
//        header('Content-Disposition: attachment; filename="' . $nombrearchivo . '"');
//        header('Content-Transfer-Encoding: binary');
//    }
    echo $contenido;
} else {

}
?>
