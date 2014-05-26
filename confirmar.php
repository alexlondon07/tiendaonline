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
            <td>
                <table width="100%" border="0" cellspacing="4" cellpadding="0">
                    <tr>
                        <td><h1>Datos para iniciar sesi&oacuten</h1></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="tex_contenido">Usuario:*</td>
                        <td><label>
                                <input id="usuario" name="usuario" type="text" onKeyUp="javascript:verificarUsuarioAjax('usuario');" class="texformulario1" size="35" required/>
                            </label></td>
                    </tr>
                    <tr>
                        <td class="tex_contenido">Clave:*</td>
                        <td><label>
                                <input name="clave" type="password" class="texformulario1" id="textfield9" size="35" required/>
                            </label></td>
                    </tr>
                    <tr>
                        <td height="10" colspan="2" class="tex_contenido"></td>
                    </tr>
                </table>

            </td>
        </section>
    </body>
</html>

