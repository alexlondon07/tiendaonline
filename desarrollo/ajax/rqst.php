<?php

include '../lib/ControllerIncludes.php';
/**
 * en este archivo se atienden todas las peticiones AJAX
 */
$rqst = $_REQUEST;
$op = isset($rqst['op']) ? $rqst['op'] : '';
header("Content-type: application/javascript; charset=utf-8");
header("Cache-Control: max-age=15, must-revalidate");
header('Access-Control-Allow-Origin: *');

if ($op == 'usrsave' || $op == 'usrget' || $op == 'usrdelete' || $op == 'usrlogin') {
    $CONTROL = new ControllerUser();
    echo $CONTROL->getResponseJSON();
} else if ($op == 'galeriasave' || $op == 'galeriaget' || $op == 'galeriadelete') {
    $CONTROL = new ControllerGaleria();
    echo $CONTROL->getResponseJSON();
} else if ($op == 'categoriasave' || $op == 'categoriaget' || $op == 'categoriadelete') {
    $CONTROL = new ControllerCategoria();
    echo $CONTROL->getResponseJSON();
} else if ($op == 'productosave' || $op == 'productoget' || $op == 'productodelete') {
    $CONTROL = new ControllerProducto();
    echo $CONTROL->getResponseJSON();
} else if ($op == 'galeriasave' || $op == 'galeriaget' || $op == 'galeriadelete' || $op == 'prod_catget') {
    $CONTROL = new ControllerGaleria();
    echo $CONTROL->getResponseJSON();
} else {
    echo 'OPERACION NO DISPONIBLE';
}
?>
