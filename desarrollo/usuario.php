<?php
include 'include/generic_validate_session.php';
include 'lib/ControllerIncludes.php';

/**
 * se cargan datos
 */
$USUARIO = new ControllerUser();
$USUARIO->usrget();
$arrusuarios = $USUARIO->getResponse();
$isvalid = $arrusuarios['output']['valid'];
$arrusuarios = $arrusuarios['output']['response'];
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
                $_ACTIVE_SIDEBAR = 'usuario';
                include 'include/generic_navbar.php';
                ?>
            </div>
            <div class="container">
                <h2>Usuarios</h2>
                <a href="#" id="crearusuario" class="btn btn-info botoncrear">Crear</a>
                <div>
                    <table class="table table-hover dyntable" id="dynamictable">
                        <thead>
                            <tr>
                                <th class="head0" style="width: 70px;">Acciones</th>
                                <th class="head1">Nombre completo</th>
                                <th class="head0">Email</th>
                                <th class="head1">Telefono / Celular</th>
                                <th class="head0">Pa&iacute;s</th>
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
                            $c = count($arrusuarios);
                            if ($isvalid) {
                                for ($i = 0; $i < $c; $i++) {
                                    ?>
                                    <tr class="gradeC">
                                        <td class="con0">
                                            <a href="#" onclick="USUARIO.editdata(<?php echo $arrusuarios[$i]['id']; ?>);"><span class="icon-pencil"></span></a><span>&nbsp;&nbsp;</span>
                                            <a href="#" onclick="USUARIO.deletedata(<?php echo $arrusuarios[$i]['id']; ?>);"><span class="icon-trash"></span></a><span>&nbsp;&nbsp;</span>
                                        </td>
                                        <td class="con1"><?php echo $arrusuarios[$i]['nombre'] . ' ' . $arrusuarios[$i]['apellido']; ?></td>
                                        <td class="con0"><?php echo $arrusuarios[$i]['email']; ?></td>
                                        <td class="con1"><?php echo $arrusuarios[$i]['telefono'] . ' / ' . $arrusuarios[$i]['celular']; ?></td>
                                        <td class="con0"><?php echo $arrusuarios[$i]['pais']; ?></td>
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
        <div id="dialog-form" title="Usuario" style="display: none;">
            <p class="validateTips"></p>
            <table>
                <tr>
                    <td>
                        <form id="formcreate1" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Nombres</label>
                                <div class="controls"><input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Apellidos</label>
                                <div class="controls"><input type="text" name="apellido" id="apellido" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls"><input type="email" name="email" id="email" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contrase&ntilde;a</label>
                                <div class="controls"><input type="password" name="pass" id="pass" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Identificaci&oacute;n</label>
                                <div class="controls"><input type="text" name="identificacion" id="identificacion" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Cargo</label>
                                <div class="controls"><input type="text" name="cargo" id="cargo" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Celular</label>
                                <div class="controls"><input type="text" name="celular" id="celular" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form id="formcreate2" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Telefono</label>
                                <div class="controls"><input type="text" name="telefono" id="telefono" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Pa&iacute;s</label>
                                <div class="controls"><input type="text" name="pais" id="pais" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Departamento</label>
                                <div class="controls"><input type="text" name="departamento" id="departamento" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ciudad</label>
                                <div class="controls"><input type="text" name="ciudad" id="ciudad" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Direcci&oacute;n</label>
                                <div class="controls"><input type="text" name="direccion" id="direccion" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Habilitado</label>
                                <div class="controls"><select name="habilitado" id="habilitado" class="text ui-widget-content ui-corner-all">
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
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
        <script type="text/javascript" src="js/usuario.js"></script>
    </body>
</html>