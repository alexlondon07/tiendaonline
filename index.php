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
            <?php
            $c = count($arrproductos);
            if ($isvalidproduct) {
                for ($i = 0; $i < $c; $i++) {
                    ?>
                    <div class="cajaPrin">
                        <div class="texprincipal">
                            <div class="boxfoto">
                                <a href="detallesproducto.php?id=<?php echo $arrproductos[$i]['id']; ?>"><img  src="vergaleria.php?ac=view&id=<?php echo $arrproductos[$i]['id']; ?>" /></a>
                            </div>
                            <div class="boxContTex"><?php echo $arrproductos[$i]['nombre']; ?></div>
                            <div class="boxContTex">precio:<?php echo '$ ' . number_format($arrproductos[$i]['precio'], 0, ",", "."); ?></div>
                            <div class="boxContTex">Cantidad:<input name="cantidad_<?php echo $arrproductos[$i]['id']; ?>" type="number" class="texInputFor" title="Cantidad" id="cantidad_<?php echo $arrproductos[$i]['id']; ?>" size="10" />
                            </div>
                            <div>
                                <button  value="<?php echo $arrproductos[$i]['id']; ?>" class='botoncompra'>
                                    <img title="Añadir al carrito"  src="images/icocar.png" width="22" height="22"  alt></img>
                                </button>
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

