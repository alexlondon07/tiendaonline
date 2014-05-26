<?php

//include 'ConectionDb.php';
//include 'Util.php';

/**
 * Clase que contiene todas las operaciones utilizadas sobre la base de datos
 * @author Alexander Londoño
 */
class ControllerProducto {

    private $conexion, $CDB, $op, $id, $euid, $sdid;
    private $UTILITY;
    private $response;

    function __construct() {
        $this->CDB = new ConectionDb();
        $this->UTILITY = new Util();
        $this->conexion = $this->CDB->openConect();
        $rqst = $_REQUEST;
        $this->op = isset($rqst['op']) ? $rqst['op'] : '';
        $this->id = isset($rqst['id']) ? intval($rqst['id']) : 0;
        $this->ke = isset($rqst['ke']) ? $rqst['ke'] : '';
        $this->lu = isset($rqst['lu']) ? $rqst['lu'] : '';
        $this->ti = isset($rqst['ti']) ? $rqst['ti'] : '';
        if ($this->op == 'productosave') {
            $this->nombre = isset($rqst['nombre']) ? $rqst['nombre'] : '';
            $this->precio = isset($rqst['precio']) ? $rqst['precio'] : '';
            $this->cantidad = isset($rqst['cantidad']) ? $rqst['cantidad'] : '';
            $this->idcategoria = isset($rqst['idcategoria']) ? $rqst['idcategoria'] : '';
            $this->estado_carrito = isset($rqst['estado_carrito']) ? $rqst['estado_carrito'] : '';
            $this->habilitado = isset($rqst['habilitado']) ? $rqst['habilitado'] : '';
            $this->descrip = isset($rqst['descrip']) ? $rqst['descrip'] : '';
            $this->productosave();
        } else if ($this->op == 'productoget') {
            $this->productoget();
        } else if ($this->op == 'productodelete') {
            $this->productodelete();
        }
    }

    /**
     * Metodo para guardar y actualizar
     */
    private function productosave() {
        $id = 0;
        if ($this->id > 0) {
            //se actualzia la información
            $q = "SELECT product_id FROM tiendaonline_producto WHERE product_id = " . $this->id;
            $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
            while ($obj = mysql_fetch_object($con)) {
                $id = $obj->product_id;
                $table = "tiendaonline_producto";
                $arrfieldscomma = array(
                    'product_nombre' => $this->nombre,
                    'product_precio' => $this->precio,
                    'product_cant' => $this->cantidad,
                    'product_carrito_compra' => $this->estado_carrito,
                    'product_estado' => $this->habilitado,
                    'product_descripcion' => $this->descrip);
                $arrfieldsnocomma = array('product_categoria_id' => $this->idcategoria, 'product_dtcreate' => $this->UTILITY->date_now_server());
                $q = $this->UTILITY->make_query_update($table, "product_id = '$id'", $arrfieldscomma, $arrfieldsnocomma);
                mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
                $arrjson = array('output' => array('valid' => true, 'id' => $id));
            }
        } else {
            $q = "INSERT INTO tiendaonline_producto (product_dtcreate, product_nombre,product_categoria_id,product_carrito_compra,product_estado,product_descripcion,product_precio,product_cant)VALUES (" . $this->UTILITY->date_now_server() . ", '$this->nombre',$this->idcategoria,'$this->estado_carrito','$this->habilitado','$this->descrip', '$this->precio','$this->cantidad')";
            mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
            $id = mysql_insert_id();
            $arrjson = array('output' => array('valid' => true, 'id' => $id));
            $this->op = '';
        }
        $this->response = ($arrjson);
    }

    public function productoget() {
        $this->conexion = is_resource($this->conexion) ? $this->conexion : $this->CDB->openConect();
        $q = "SELECT * FROM tiendaonline_producto ORDER BY product_id DESC";
        if ($this->id > 0) {
            $q = "SELECT * FROM tiendaonline_producto WHERE product_id = " . $this->id;
        }
        $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
        $resultado = mysql_num_rows($con);
        $arr = array();
        while ($obj = mysql_fetch_object($con)) {
            $arr[] = array(
                'id' => $obj->product_id,
                'nombre' => ($obj->product_nombre),
                'precio' => ($obj->product_precio),
                'cantidad' => ($obj->product_cant),
                'idcategoria' => ($obj->product_categoria_id),
                'estado_carrito' => ($obj->product_carrito_compra),
                'habilitado' => ($obj->product_estado),
                'descrip' => ($obj->product_descripcion),
                'dtcreate' => ($obj->product_dtcreate));
        }
        if ($resultado) {
            $arrjson = array('output' => array('valid' => true, 'response' => $arr));
        } else {
            $arrjson = $this->UTILITY->error_no_result();
        }
        $this->response = ($arrjson);
    }
    public function productotiendaget() {
        $this->conexion = is_resource($this->conexion) ? $this->conexion : $this->CDB->openConect();
        $q = "SELECT * FROM tiendaonline_producto where product_estado='activo' ORDER BY product_id DESC";
        if ($this->id > 0) {
            $q = "SELECT * FROM tiendaonline_producto WHERE product_estado='activo' and product_id = " . $this->id;
        }
        $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
        $resultado = mysql_num_rows($con);
        $arr = array();
        while ($obj = mysql_fetch_object($con)) {
            $arr[] = array(
                'id' => $obj->product_id,
                'nombre' => ($obj->product_nombre),
                'precio' => ($obj->product_precio),
                'cantidad' => ($obj->product_cant),
                'idcategoria' => ($obj->product_categoria_id),
                'estado_carrito' => ($obj->product_carrito_compra),
                'habilitado' => ($obj->product_estado),
                'descrip' => ($obj->product_descripcion),
                'dtcreate' => ($obj->product_dtcreate));
        }
        if ($resultado) {
            $arrjson = array('output' => array('valid' => true, 'response' => $arr));
        } else {
            $arrjson = $this->UTILITY->error_no_result();
        }
        $this->response = ($arrjson);
    }

    private function productodelete() {
        if ($this->id > 0) {
            //Elimina la informacion
            $q = "DELETE FROM tiendaonline_producto WHERE product_id = " . $this->id;
            mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
            $arrjson = array('output' => array('valid' => true, 'id' => $this->id));
        } else {
            $arrjson = $this->UTILITY->error_missing_data();
        }
        $this->response = ($arrjson);
    }

    public function getResponse() {
        $this->CDB->closeConect();
        return $this->response;
    }

    public function getResponseJSON() {
        $this->CDB->closeConect();
        return json_encode($this->response);
    }

    public function setId($_id) {
        $this->id = $_id;
    }

}

?>