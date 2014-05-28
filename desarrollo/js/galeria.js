$(document).on('ready', initgaleria);
var q, descrip, allFields, tips;
var producto = new Array();
var categoria = new Array();
/**
 * se activa para inicializar el documento
 */
function initgaleria() {
    q = {};
    q.ke = _ucode;
    q.lu = _ulcod;
    q.ti = _utval;
    descrip = $("#descrip");
    $("#ke").val(_ucode);
    $("#lu").val(_ulcod);
    $("#ti").val(_utval);
    allFields = $([]).add(descrip);
    tips = $(".validateTips");

    $('#dynamictable').dataTable({
        "sPaginationType": "full_numbers"
    });

    $("#creargaleria").button().click(function() {
        q.id = 0;
        $("#dialog-form").dialog("open");
    });

    $("#dialog-form").dialog({
        autoOpen: false,
        height: 600,
        width: 600,
        modal: true,
        buttons: {
            "Guardar": function() {
                var bValid = true;
                allFields.removeClass("ui-state-error");
                if ($('#descrip').val() == "") {
                    bValid = false;
                    updateTips('Debe ingresar una descripción.');
                }
                if ($('#idproducto').val() == "seleccione") {
                    bValid = false;
                    updateTips('Debe seleccionar un producto.');
                }
                if (bValid) {
                    $('#formcreate1').submit();
                   // GALERIA.savedata();
                }
            },
            "Cancelar": function() {
                $(this).dialog("close");
            }
        },
        close: function() {
            UTIL.clearForm('formcreate1');
            updateTips('');
        }
    });
    GALERIA.getcategoria();
    GALERIA.getproducto();
}

var GALERIA = {
    //Dependiendo la categoria que seleccione se habiliatan los productos asociados al mismo
    getproductosdisponibles: function() {
        q.id = $('#idcategoria').val();
        q.op = 'prod_catget';
        if ($('#idcategoria').val() == "seleccione") {
            $('#idproducto').attr('disabled', true);
            return false;
        }
        UTIL.callAjaxRqst(q, this.getproductosdisponiblesHandler);
    },
    getproductosdisponiblesHandler: function(data) {
        UTIL.cursorNormal();
        var option = '';
        if (data.output.valid) {
            var res = data.output.response;
            $('#idproducto').attr('disabled', false);
            option = '<option value="seleccione">Seleccione...</option>';
            for (var i in res) {
                option += '<option value="' + res[i].id + '">' + res[i].nombre + '</option>';
            }
            $("#idproducto").empty();
            $("#idproducto").append(option);
        } else {
            alert('No hay productos asociados a la categoría seleccionada');
            $("#idproducto").append(option);
            $('#idproducto').attr('disabled', true);
        }
    },
    savedata: function() {
        q.op = 'galeriasave';
        q.idcategoria = $('#idcategoria').val();
        q.idproducto = $('#idproducto').val();
        q.descrip = $('#descrip').val();
        q.habilitado = $('#habilitado').val();
        q.keyid = $('#keyid').val();
        UTIL.callAjaxRqst(q, this.savedatahandler);
    },
    savedatahandler: function(data) {
        UTIL.cursorNormal();
        if (data.output.valid) {
            updateTips('Información guardada correctamente');
            window.location = 'galerias_new.php';
        } else {
            updateTips('Error: ' + data.output.response.content);
        }
    },
    deletedata: function(id) {
        var continuar = confirm('Va a eliminar información de forma irreversible.\n¿Desea continuar?');
        if (continuar) {
            q.op = 'galeriadelete';
            q.id = id;
            UTIL.callAjaxRqst(q, this.deletedatahandler);
        }
    },
    deletedatahandler: function(data) {
        UTIL.cursorNormal();
        if (data.output.valid) {
            window.location = 'galerias.php';
        } else {
            alert('Error: ' + data.output.response.content);
        }
    },
    editdata: function(id) {
        q.op = 'galeriaget';
        q.id = id;
        UTIL.callAjaxRqst(q, this.editdatahandler);
    },
    editdatahandler: function(data) {
        UTIL.cursorNormal();
        if (data.output.valid) {
            var res = data.output.response[0];
            $('#idcategoria').val(res.idcategoria);
            $('#idproducto').val(res.idproducto);
            $('#descrip').val(res.descrip);
            $('#habilitado').val(res.habilitado);
            $('#keyid').val(res.id);
            $("#dialog-form").dialog("open");
        } else {
            alert('Error: ' + data.output.response.content);
        }
    },
    getproducto: function() {
        q.op = 'productoget';
        UTIL.callAjaxRqst(q, this.getproductoHandler);
    },
    getproductoHandler: function(data) {
        UTIL.cursorNormal();
        if (data.output.valid) {
            var res = data.output.response;
            var option = '<option value="seleccione">Seleccione Producto</option>';
            for (var i in res) {
                option += '<option value="' + res[i].id + '">' + res[i].nombre + '</option>';
            }
            $("#idproducto").empty();
            $("#idproducto").append(option);
        } else {
            alert('Error: ' + data.output.response.content);
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
            GALERIA.getproductosdisponibles();
        } else {
            alert('Error: ' + data.output.response.content);
        }
    }
}
