<?php
include 'include/generic_validate_session.php';
include 'lib/ControllerIncludes.php';

/**
 * se cargan datos
 */
$GALERIA = new ControllerGaleria();
$GALERIA->galeriaget();
$arrgaleria = $GALERIA->getResponse();
$isvalid = $arrgaleria['output']['valid'];
$arrgaleria = $arrgaleria['output']['response'];
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
                include 'include/generic_navbar.php';
                ?>
            </div>
            <div class="container">
                <h2>Galerías de Fotos</h2>
                <a href="#" id="creargaleria" class="btn btn-info botoncrear">Crear</a>
                <div>
                    <table class="table table-hover dyntable" id="dynamictable">
                        <thead>
                            <tr>
                                <th class="head0" style="width: 70px;">Acciones</th>
                                <th class="head1">Categoría</th>
                                <th class="head0">Producto</th>
                                <th class="head0">Estado</th>
                                <th class="head0">Foto</th>
                            </tr>
                        </thead>
                        <colgroup>
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                        </colgroup>
                        <tbody>
                            <?php
                            $c = count($arrgaleria);
                            if ($isvalid) {
                                for ($i = 0; $i < $c; $i++) {
                                    ?>
                                    <tr class="gradeC">
                                        <td class="con0">
                                            <a href="#" onclick="GALERIA.editdata(<?php echo $arrgaleria[$i]['id']; ?>);"><span class="icon-pencil"></span></a><span>&nbsp;&nbsp;</span>
                                            <a href="#" onclick="GALERIA.deletedata(<?php echo $arrgaleria[$i]['id']; ?>);"><span class="icon-trash"></span></a><span>&nbsp;&nbsp;</span>
                                        </td>
                                        <td class="con1"><?php echo $arrgaleria[$i]['nom_cat'] ?></td>
                                        <td class="con1"><?php echo $arrgaleria[$i]['nom_prod'] ?></td>
                                        <td class="con1"><?php echo $arrgaleria[$i]['habilitado'] ?></td>
                                        <td class="con1"><a target="_blank" href="archivosvergaleria.php?ac=view&id=<?php echo $arrgaleria[$i]['id']; ?>"><img src="archivosvergaleria.php?ac=view&id=<?php echo $arrgaleria[$i]['id']; ?>" width="80" height="80" /></a>
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
        <div id="dialog-form" title="Galerías de Fotos" style="display: none;">
            <p class="validateTips"></p>
            <table>
                <tr>
                    <td>
                        <form id="formcreate1" class="form-horizontal" method="POST" action="galeriacreate.php" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Categoría</label>
                                <div class="controls">
                                    <select onChange="GALERIA.getproductosdisponibles();" name="idcategoria" id="idcategoria" class="text ui-widget-content ui-corner-all">
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Producto</label>
                                <div class="controls">
                                    <select name="idproducto" id="idproducto" class="text ui-widget-content ui-corner-all">
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
                                    <textarea style="margin: 0px; height: 135px; width: 280px;" name="descrip" id="descrip" class="text ui-widget-content ui-corner-all"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <input type="hidden" name="op" id="op" value="galeriasave"/>
                                <input type="hidden" name="ke" id="ke"/>
                                <input type="hidden" name="lu" id="lu"/>
                                <input type="hidden" name="ti" id="ti"/>
                                <!--MANDO LA INFORMACIÓN DE LA IMAGEN-->
                                <input type="hidden" vale="<?php $_SESSION["nombrearchivo"]; ?>" name="nom_arc" id="nom_arc"/>
                                <input type="hidden" vale="<?php $_SESSION["tipoarchivo"]; ?>" name="tipo_arc" id="tipo_arc"/>
                                <input type="hidden" vale="<?php $_SESSION["contenidooarchivo"]; ?>" name="cont_arc" id="cont_arc"/>
                                <input type="hidden" vale="<?php $_SESSION["tamanio"]; ?>" name="tam_arc" id="tam_arc"/>
                                <input type="hidden" vale="<?php $_SESSION["error"]; ?>" name="error_arc" id="error_arc"/>
                                <input type="hidden" name="keyid" id="keyid"/>
                            </div> 
                            <div class="control-group">
                                <label class="control-label">Seleccionar archivo Tamaño 750x600</label>
                                <div class="controls">
                                    <iframe id='ifm' name='ifm' src="subir_archivos.php" width="200" height="60" frameborder="0"></iframe> 
                                </div>
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
        <script type="text/javascript" src="js/galeria.js"></script>
    </body>
</html>