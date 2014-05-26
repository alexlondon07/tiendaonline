<?php

//Funcion para eliminar item del carrito de compras
function deleteFromArray($idProducto) {
    $arrProduct = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
    if (is_array($arrProduct) && count($arrProduct) > 0) {
        foreach ($arrProduct as $key => $value) {
            if ($value['producto'] == $idProducto) {
                unset($arrProduct[$key]);
                break;
            }
        }
    }
    $_SESSION['carrito'] = array_values($arrProduct);
    ;
    echo "<script type='text/javascript'>window.location = 'index.php';</script>";
}

//Añade al carrito con carrito ya ingresado anteriormente, crea un nuevo areglo para llevar los carrito ala varaible de session   $_SESSION ['carrito']
function addCart() {
    $array = array();
    if (isset($_GET ['p'])) {
        $_SESSION['id_producto'] = $_GET['p'];
    }
    if (isset($_GET['c'])) {
        $array['cantidad'] = $_GET['c'];
        $array['producto'] = $_SESSION['id_producto'];
        $_SESSION ['carrito'] [] = $array; //Gurado el array en la varible de session
        $_SESSION ['contador']++;
    }
}

//Verifica  los Item del carrito con carrito ya ingresado anteriormente, si esta ingresado uno que sea ingresado de nuevo actulzia su cantidad
function validateCart() {
    if (isset($_SESSION ['carrito']) && count($_SESSION ['carrito']) > 0) {
        if (isset($_GET ['p'])) {
            $_SESSION ['id_produc'] = $_GET['p'];
        }
        for ($i = 0; $i < count($_SESSION ['carrito']); $i++) {
            if ($_SESSION ['carrito'][$i] != null && array_search($_SESSION ['id_produc'], $_SESSION ['carrito'][$i]) != false) {
                $sw = 0;
                updateItem($i); //Si lo encuentra llama la funcion para actulziar los registros
                break;
            } else {
                $sw = 1; //Sino lo encuentra cambia el sw para la validacion
            }
        }
        if ($sw == 1) {
            addCart();
        }
    } else {
        addCart();
    }
}

//Funcion para actulizar las cantidades de un producto ingresados anteriormente al carrito de compras
function updateItem($i) {
    if (isset($_GET ['p'])) {
        $_SESSION ['carrito'] [$i] ['producto'] = $_GET['p']; //id producto
    }
    if (isset($_GET ['c'])) {
        $_SESSION ['carrito'] [$i] ['cantidad'] = $_GET['c'] + $_SESSION ['carrito'] [$i] ['cantidad']; //Se le suma la cantidad nueva + la cantida que ya tenia anteriormente
    }
}

?>