<?php
include 'include/generic_validate_session.php';
include 'lib/ControllerIncludes.php';
/**
 * se cargan datos
 */
$CATEGORIA = new ControllerCategoria();
$CATEGORIA->categoriaget();
$arrCategoria = $CATEGORIA->getResponse();
$isvalid = $arrCategoria['output']['valid'];
$arrCategoria = $arrCategoria['output']['response'];
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
                <h2>Categorías</h2>
                <a href="#" id="crearcategoria" class="btn btn-info botoncrear">Crear</a>
                <div>
                    <table class="table table-hover dyntable" id="dynamictable">
                        <thead>
                            <tr>
                                <th class="head0" style="width: 70px;">Acciones</th>
                                <th class="head1">Nombre de Categoría</th>
                                <th class="head1">Estado</th>
                            </tr>
                        </thead>
                        <colgroup>
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                        </colgroup>
                        <tbody>
                            <?php
                            $c = count($arrCategoria);
                            if ($isvalid) {
                                for ($i = 0; $i < $c; $i++) {
                                    ?>
                                    <tr class="gradeC">
                                        <td class="con0">
                                            <a href="#" onclick="CATEGORIA.editdata(<?php echo $arrCategoria[$i]['id']; ?>);"><span class="icon-pencil"></span></a><span>&nbsp;&nbsp;</span>
                                            <a href="#" onclick="CATEGORIA.deletedata(<?php echo $arrCategoria[$i]['id']; ?>);"><span class="icon-trash"></span></a><span>&nbsp;&nbsp;</span>
                                        </td>
                                        <td class="con1"><?php echo $arrCategoria[$i]['nombre']; ?></td>
                                        <td class="con1"><?php echo $arrCategoria[$i]['habilitado']; ?></td>
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
        <div id="dialog-form" title="Categorías" style="display: none;">
            <p class="validateTips"></p>
            <table>
                <tr>
                    <td>
                        <form id="formcreate1" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Nombres de la Categoría</label>
                                <div class="controls"><input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Estado</label>
                                <div class="controls"><select name="habilitado" id="habilitado" class="text ui-widget-content ui-corner-all">
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
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
        <script type="text/javascript" src="js/categoria.js"></script>
    </body>
</html>