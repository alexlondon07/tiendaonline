<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Archivos</title>
        <!-- SUBIR IMAGEN AJAX -->
        <script language="javascript" src="lib/imagen_uploader/js/jquery-1.3.1.min.js"></script>
        <script language="javascript" src="lib/imagen_uploader/js/AjaxUpload.2.0.min.js"></script>
        <script language="javascript">
            $(document).ready(function() {
                var button = $('#upload_button'), interval;
                new AjaxUpload('#upload_button', {
                action: 'upload_images_ajax.php',
                    onSubmit: function(file, ext) {
                        if (!(ext && /^(jpg|png|jpeg|gif|)$/.test(ext))) {
                            // extensiones permitidas
                            alert('Error: Solo se permiten imagenes. Extenciones permitidas: jpg , png, jpeg'
                               );
                            // cancela upload
                            return false;
                        } else {
                            button.text('Subiendo la imagen...');
                            this.disable();
                        }
                    },
                    onComplete: function(file, response) {
                        button.text('Archivo cargado');
                        // enable upload button
                        this.enable();
                        // Agrega archivo a la lista
                        $('#lista').appendTo('.files').text(file);
                    }
                });
            });
        </script>
        <link href="lib/imagen_uploader/style.css" rel="stylesheet" type="text/css" />
        <!-- FIN IMAGEN AJAX -->
    </head>
    <body>
        <div id="upload_button" >Subir archivo</div>
    </body>
</html>

