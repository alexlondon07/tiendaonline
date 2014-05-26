<?php
session_start();
include 'includes/ControllerIncludes.php';
/**
 * se cargan datos
 */
if (!isset($_SESSION['carrito']) && (!isset($_SESSION['contador']))) {
    $_SESSION['contador'] = 0;
    $_SESSION ['id_produc'] = 0;
}

$PRODUCTO = new ControllerProducto();
$PRODUCTO->productotiendaget();
$arrproductos = $PRODUCTO->getResponse();
$isvalidproduct = $arrproductos['output']['valid'];
$arrproductos = $arrproductos['output']['response'];

$GALERIA = new ControllerGaleria();
$GALERIA->galeria_detalleget();
$arrgaleria = $GALERIA->getResponse();
$isvalid = $arrgaleria['output']['valid'];
$arrgaleria = $arrgaleria['output']['response'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>tiendaonline</title>
        <link href="css/tienda.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/tienda.js"></script>
    </head>
    <body>
        <section  class="boxIzqu" >
            <div class="texRes">
                <div class="boxContTex">
                    <div id="carrito">
                        <!--AQUI ES DONDE VOY A MOSTRAR LOS DATOS DEL PRODUCTOS AÑADITOS AL CARRITO DE COMPRAS.-->
                    </div>
                </div>
            </div>
        </section>
        <section class="boxDere" >
            <div>
                <h1><a href="index.php" title="Volver">Volver a la Tienda</a></h1>
            </div>
            <div><h3><?php echo $arrproductos[0]['nombre']; ?></h3></div>
            <div><h3>Precio:<?php echo '$ ' . number_format($arrproductos[0]['precio'], 0, ",", "."); ?></h3></div>
            <?php
            $c = count($arrgaleria);
            if ($isvalid) {
                for ($i = 0; $i < $c; $i++) {
                    ?>
                    <div class="cajaPrin">
                        <div class="texprincipal">
                            <div class="boxfoto">
                                <a href="#" title="Ver Detalles"><img src="verdetalles.php?ac=view&id=<?php echo $arrgaleria[$i]['id']; ?>" /></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>  
        </section>
    </body>
</html>

