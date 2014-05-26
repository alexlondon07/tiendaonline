<?php
session_start();
include 'includes/ControllerIncludes.php';
include 'includes/funciones.php';
$CDB = new ConectionDb();
$CDB->openConect();
$conexion = $CDB;
$suma = 0;
if (!isset($_SESSION ['carrito'])) {
    addCart();
} else {
    validateCart();
}
if (!empty($_GET['borrarItem']) && $_GET['borrarItem'] > 0) {
    deleteFromArray($_GET['borrarItem']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>::tiendaonline::</title>
        <link href="css/carrito.css" rel="stylesheet" type="text/css" />
        <link href="css/tienda.css" rel="stylesheet" type="text/css" />
        <link href="css/pie.css" rel="stylesheet" type="text/css" />
        <link href="css/repo-tienda.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <div id="carrito">
                <tr>
                    <td>
                        <div id="scroll_cat1">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <?php
                                        if (isset($_SESSION ['carrito']) && count($_SESSION ['carrito'] > 0) && $_SESSION ['contador'] > 0) {
                                            //Recorro la variable y muestro los datos de los productos.
                                            for ($i = 0; $i < count($_SESSION ['carrito']); $i++) {
                                                $q = "SELECT * FROM tiendaonline_producto WHERE product_id =" . $_SESSION ['carrito'] [$i] ['producto'];
                                                $con = mysql_query($q) or die(mysql_error() . "***ERROR: " . $q);
                                                $resultado = mysql_num_rows($con);
                                                $arr = array();
                                                while ($obj = mysql_fetch_object($con)) {
                                                    $arr[] = array(
                                                        'nombre' => ($obj->product_nombre),
                                                        'precio' => ($obj->product_precio));
                                                }
                                                $ietm = $_SESSION ['carrito'] [$i] ['producto'];
                                                ?> 
                                                <table style="margin-top:5px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><strong><?php ?></strong> </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:0.813em">Producto:<strong> <?php echo $arr[0]['nombre']; ?></strong> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tex_contenido11px">Cantidad: <?php echo $_SESSION ['carrito'] [$i] ['cantidad']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tex_contenido11px">Precio: <?php echo $arr[0]['precio']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td >Valor: <strong> <?php echo $arr[0]['precio'] * $_SESSION ['carrito'] [$i] ['cantidad'] ?></strong> </td>
                                                    </tr>
                                                    <tr>
                                                        <!-- RETIRAR PRODUCTOS DEL CARRITO DE COMPRAS-->
                                                        <td align="right" valign="middle" class="tex_contenido11px"> <a class="btnRetirar" href="<?php echo "carrito.php?borrarItem=$ietm"; ?>" target="_self">Retirar del carrito</a></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                $suma+=($arr[0]['precio'] * $_SESSION ['carrito'] [$i] ['cantidad']);
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </div>
            <tr>
                <td>
                    <div class="boxTotalPesos">SUBTOTAL:<strong>$<?php echo number_format(($suma), 2, ',', '.'); ?></span></strong></div>
                </td>
            </tr>
        </table>
        <?php include 'includes/tipoenvio.php'; ?>
    </body>
</html>

