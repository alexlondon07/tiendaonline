$(document).on('ready', initproducto);
var q, nombre, allFields, tips;
var categoria = new Array();

/**
 * se activa para inicializar el documento
 */
function initproducto() {
    q = {};
    q.ke = _ucode;
    q.lu = _ulcod;
    q.ti = _utval;
    nombre = $("#nombre");
    allFields = $([]).add(nombre);
    tips = $(".validateTips");
    $('#dynamictable').dataTable({
        "sPaginationType": "full_numbers"
    });
    $("#crearproducto").button().click(function() {
        q.id = 0;
        $("#dialog-form").dialog("open");
    });

    $("#dialog-form").dialog({
        autoOpen: false,
        height: 670,
        width: 560,
        modal: true,
        buttons: {
            "Guardar": function() {
                var bValid = true;
                allFields.removeClass("ui-state-error");
                if ($('#cantidad').val() == "") {
                    bValid = false;
                    updateTips('Debe ingresar el cantidad de unidades.');
                }
                if ($('#precio').val() == "") {
                    bValid = false;
                    updateTips('Debe ingresar el precio.');
                }
                if ($('#idcategoria').val() == "seleccione") {
                    bValid = false;
                    updateTips('Debe seleccionar una categoría.');
                }
                if ($('#nombre').val() == "") {
                    bValid = false;
                    updateTips('Debe ingresar el nombre.');
                }
                if (bValid) {
                    PRODUCTO.savedata();
                }
            },
            "Cancelar": function() {
                UTIL.clearForm('formcreate1');
                $(this).dialog("close");
            }
        },
        close: function() {
            UTIL.clearForm('formcreate1');
            updateTips('');
        }
    });
    PRODUCTO.getcategoria();
}



var PRODUCTO = {
    deletedata: function(id) {
        var continuar = confirm('Va a eliminar información de forma irreversible.\n¿Desea continuar?');
        if (continuar) {
            q.op = 'productodelete';
            q.id = id;
            UTIL.callAjaxRqst(q, this.deletedatahandler);
        }
    },
    deletedatahandler: function(data) {
        UTIL.cursorNormal();
        if (data.output.valid) {
            window.location = 'producto.php';
        } else {
            alert('Error: ' + data.output.response.content);
        }
    },
    editdata: function(id) {
        q.op = 'productoget';
        q.id = id;
        UTIL.callAjaxRqst(q, this.editdatahandler);
    },
    editdatahandler: function(data) {
        UTIL.cursorNormal();
        if (data.output.valid) {
            var res = data.output.response[0];
            $('#nombre').val(res.nombre);
            $('#precio').val(res.precio);
            $('#cantidad').val(res.cantidad);
            $('#idcategoria').val(res.idcategoria);
            $('#estado_carrito').val(res.estado_carrito);
            $('#habilitado').val(res.habilitado);
            $('#descrip').val(res.descrip);
            $("#dialog-form").dialog("open");
        } else {
            alert('Error: ' + data.output.response.content);
        }
    },
    savedata: function() {
        q.op = 'productosave';
        q.nombre = $('#nombre').val();
        q.precio = $('#precio').val();
        q.cantidad = $('#cantidad').val();
        q.idcategoria = $('#idcategoria').val();
        q.estado_carrito = $('#estado_carrito').val();
        q.habilitado = $('#habilitado').val();
        q.descrip = $('#descrip').val();
        UTIL.callAjaxRqst(q, this.savedatahandler);
    },
    savedatahandler: function(data) {
        UTIL.cursorNormal();
        if (data.output.valid) {
            updateTips('Información guardada correctamente');
            window.location = 'producto.php';
        } else {
            updateTips('Error: ' + data.output.response.content);
        }
    },
    getcategoria: function() {
        q.op = 'categoriaget';
        UTIL.callAjaxRqst(q, this.getcategoriaHandler);
    },
    getcategoriaHandler: function(data) {
        UTIL.cursorNormal();
        if (data.output.valid) {
            var res = data.output.response;
            var option = '<option value="seleccione">Seleccione...</option>';
            for (var i in res) {
                option += '<option value="' + res[i].id + '">' + res[i].nombre + '</option>';
                categoria[res[i].id] = res[i].nombre;
            }
            $("#idcategoria").empty();
            $("#idcategoria").append(option);
        } else {
            alert('Error: ' + data.output.response.content);
        }
    }
}
