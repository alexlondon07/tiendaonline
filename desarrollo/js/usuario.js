$(document).on('ready', initusuario);
var q, nombre,  allFields, tips;

/**
 * se activa para inicializar el documento
 */
function initusuario() {
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
	

    $("#crearusuario").button().click(function() {
	q.id = 0;
	$("#dialog-form").dialog("open");
    });

    $("#dialog-form").dialog({
	autoOpen: false, 
	height: 580, 
	width: 900, 
	modal: true,
	buttons: {
	    "Guardar": function() {
		var bValid = true;
		allFields.removeClass("ui-state-error");
		bValid = bValid && checkLength(nombre, "nombre", 3, 16);
		if (bValid) {
		    USUARIO.savedata();
		//$(this).dialog("close");
		}
	    },
	    "Cancelar": function() {
		UTIL.clearForm('formcreate1');
		UTIL.clearForm('formcreate2');
		$(this).dialog("close");
	    }
	},
	close: function() {
	    UTIL.clearForm('formcreate1');
	    UTIL.clearForm('formcreate2');
	    updateTips('');
	}
    });
    USUARIO.getcustomer();
}

    

var USUARIO = {
    deletedata: function(id) {
	var continuar = confirm('Va a eliminar información de forma irreversible.\n¿Desea continuar?');
	if (continuar) {
	    q.op = 'usrdelete';
	    q.id = id;
	    UTIL.callAjaxRqst(q, this.deletedatahandler);
	}
    },
    deletedatahandler: function(data) {
	UTIL.cursorNormal();
	if (data.output.valid) {
	    window.location = 'usuario.php';
	} else {
	    alert('Error: ' + data.output.response.content);
	}
    },
    editdata: function(id) {
	q.op = 'usrget';
	q.id = id;
	UTIL.callAjaxRqst(q, this.editdatahandler);
    },
    editdatahandler: function(data) {
	UTIL.cursorNormal();
	if (data.output.valid) {
	    var res = data.output.response[0];
	    $('#nombre').val(res.nombre);
	    $('#apellido').val(res.apellido);
	    $('#cargo').val(res.cargo);
	    $('#email').val(res.email);
	    $('#pass').val(res.pass);
	    $('#identificacion').val(res.identificacion);
	    $('#celular').val(res.celular);
	    $('#telefono').val(res.telefono);
	    $('#pais').val(res.pais);
	    $('#departamento').val(res.departamento);
	    $('#ciudad').val(res.ciudad);
	    $('#direccion').val(res.direccion);
	    $('#habilitado').val(res.habilitado);
	    $("#dialog-form").dialog("open");
	} else {
	    alert('Error: ' + data.output.response.content);
	}
    },
    savedata: function() {
	q.op = 'usrsave';
	q.nombre = $('#nombre').val();
	q.apellido = $('#apellido').val();
	q.cargo = $('#cargo').val();
	q.email = $('#email').val();
	q.pass = '';
	if ($('#pass').val().length > 1){
	    q.pass = hex_sha1($('#pass').val());
	}
	q.identificacion = $('#identificacion').val();
	q.celular = $('#celular').val();
	q.telefono = $('#telefono').val();
	q.pais = $('#pais').val();
	q.departamento = $('#departamento').val();
	q.ciudad = $('#ciudad').val();
	q.direccion = $('#direccion').val();
	q.habilitado = $('#habilitado').val();
	UTIL.callAjaxRqst(q, this.savedatahandler);
    },
    savedatahandler: function(data) {
	UTIL.cursorNormal();
	if (data.output.valid) {
	    updateTips('Información guardada correctamente');
	    window.location = 'usuario.php';
	} else {
	    updateTips('Error: ' + data.output.response.content);
	}
    }
}
