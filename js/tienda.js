$(document).ready(inicio)
function inicio() {
    $(".botoncompra").click(anade);
    $("#carrito").load("carrito.php");
}
function anade() {
    if ($('#cantidad_' + $(this).val()).val() == "" || $('#cantidad_' + $(this).val()).val() <= 0) {
        alert('Debe ingresar la cantidad, o una valor valido.');
        $('#cantidad_' + $(this).val()).val('');
        return false;
    } else {
        $("#carrito").load("carrito.php?p=" + $(this).val());
        $("#carrito").load("carrito.php?c=" + $('#cantidad_' + $(this).val()).val());
        $('#cantidad_' + $(this).val()).val('');
    }
}

