<?php
include 'include/generic_validate_session.php';
include 'lib/ControllerIncludes.php';

/**
 * se cargan datos
 */
$PRODUCTO = new ControllerProducto();
$PRODUCTO->productoget();
$arrproductos = $PRODUCTO->getResponse();
$isvalid = $arrproductos['output']['valid'];
$arrproductos = $arrproductos['output']['response'];

//NOMBRE DE LA CATEGORÍA
$NOM_CAT = new ControllerCategoria();
$NOM_CAT->categoriaget();
$arrnomcat = $NOM_CAT->getResponse();
$isvalid1 = $arrnomcat['output']['valid'];
$arrnomcat = $arrnomcat['output']['response1'];
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'include/generic_head.php'; ?>
    </head>
    <body>
        <header>
            <?php
            include 'include/generic_header.php';
            ?>
        </header>
        <section id="section_wrap">
            <div class="container">
                <?php
                $_ACTIVE_SIDEBAR = 'producto';
                include 'include/generic_navbar.php';
                ?>
            </div>
            <div class="container">
                <h2>Productos</h2>
                <a href="#" id="crearproducto" class="btn btn-info botoncrear">Crear</a>
                <div>
                    <table class="table table-hover dyntable" id="dynamictable">
                        <thead>
                            <tr>
                                <th class="head0" style="width: 70px;">Acciones</th>
                                <th class="head1">Producto</th>
                                <th class="head0">Catergoría</th>
                                <th class="head1">Precio</th>
                                <th class="head1">Cantidad</th>
                                <th class="head1">Activo en Carrito</th>
                                <th class="head1">Habilitado</th>
                            </tr>
                        </thead>
                        <colgroup>
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                        </colgroup>
                        <tbody>
                            <?php
                            $c = count($arrproductos);
                            if ($isvalid) {
                                for ($i = 0; $i < $c; $i++) {
                                    ?>
                                    <tr class="gradeC">
                                        <td class="con0">
                                            <a href="#" onclick="PRODUCTO.editdata(<?php echo $arrproductos[$i]['id']; ?>);"><span class="icon-pencil"></span></a><span>&nbsp;&nbsp;</span>
                                            <a href="#" onclick="PRODUCTO.deletedata(<?php echo $arrproductos[$i]['id']; ?>);"><span class="icon-trash"></span></a><span>&nbsp;&nbsp;</span>
                                        </td>
                                        <td class="con1"><?php echo $arrproductos[$i]['nombre']; ?></td>
                                        <td class="con0"><?php echo $arrnomcat[$i]['nombre']; ?></td>
                                        <td class="con0"><?php echo '$' . number_format($arrproductos[$i]['precio'], 0, ",", "."); ?></td>
                                        <td class="con0"><?php echo $arrproductos[$i]['cantidad']; ?></td>
                                        <td class="con0"><?php echo $arrproductos[$i]['estado_carrito']; ?></td>
                                        <td class="con0"><?php echo $arrproductos[$i]['habilitado']; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>	    
        </section>
        <footer id="footer_wrap">
            <?php include 'include/generic_footer.php'; ?>
        </footer>
        <div id="dialog-form" title="Producto" style="display: none;">
            <p class="validateTips"></p>
            <table>
                <tr>
                    <td>
                        <form id="formcreate1" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Nombre</label>
                                <div class="controls"><input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Categoría</label>
                                <div class="controls">
                                    <select name="idcategoria" id="idcategoria" class="text ui-widget-content ui-corner-all">
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Precio</label>
                                <div class="controls"><input type="text" name="precio" id="precio" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Cantidad en unidades</label>
                                <div class="controls"><input type="number" name="cantidad" id="cantidad" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Carrito de Compras</label>
                                <div class="controls"><select name="estado_carrito" id="estado_carrito" class="text ui-widget-content ui-corner-all">
                                        <option value="si">Si</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Estado</label>
                                <div class="controls"><select name="habilitado" id="habilitado" class="text ui-widget-content ui-corner-all">
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Descripción</label>
                                <div class="controls">
                                    <textarea style="margin: 0px; height: 135px; width: 325px;" id="descrip" class="text ui-widget-content ui-corner-all"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="controls">&nbsp;</div>
                            </div>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
        <?php include 'include/generic_script.php'; ?>
        <link rel="stylesheet" media="screen" href="css/dynamictable.css" type="text/css" />
        <script type="text/javascript" src="js/jquery/jquery-dataTables.js"></script>
        <script type="text/javascript" src="js/lib/data-sha1.js"></script>
        <script type="text/javascript" src="js/producto.js"></script>
    </body>
</html>