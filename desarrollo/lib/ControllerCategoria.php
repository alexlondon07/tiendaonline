<?php

//include 'ConectionDb.php';
//include 'Util.php';

/**
 * Clase que contiene todas las operaciones utilizadas sobre la base de datos
 * @author Alexander Londoño
 */
class ControllerCategoria {

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
        if ($this->op == 'categoriasave') {
            $this->nombre = isset($rqst['nombre']) ? $rqst['nombre'] : '';
            $this->habilitado = isset($rqst['habilitado']) ? $rqst['habilitado'] : '';
            $this->categoriasave();
        } else if ($this->op == 'categoriaget') {
            $this->categoriaget();
        } else if ($this->op == 'categoriadelete') {
            $this->categoriadelete();
        }
    }

    /**
     * Metodo para guardar y actualizar
     */
    private function categoriasave() {
        $id = 0;
        if ($this->id > 0) {
            //se actualzia la información
            $q = "SELECT categoria_id FROM tiendaonline_categoria WHERE categoria_id = " . $this->id;
            $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
            while ($obj = mysql_fetch_object($con)) {
                $id = $obj->categoria_id;
                $table = "tiendaonline_categoria";
                $arrfieldscomma = array(
                    'categoria_nombre' => $this->nombre,
                    'categoria_estado' => $this->habilitado);
                $arrfieldsnocomma = array('categoria_dtcreate' => $this->UTILITY->date_now_server());
                $q = $this->UTILITY->make_query_update($table, "categoria_id = '$id'", $arrfieldscomma, $arrfieldsnocomma);
                mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
                $arrjson = array('output' => array('valid' => true, 'id' => $id));
            }
        } else {
            $q = "INSERT INTO tiendaonline_categoria (categoria_dtcreate, categoria_nombre,categoria_estado) VALUES (" . $this->UTILITY->date_now_server() . ", '$this->nombre','$this->habilitado')";
            mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
            $id = mysql_insert_id();
            $arrjson = array('output' => array('valid' => true, 'id' => $id));
            $this->op = '';
        }
        $this->response = ($arrjson);
    }

    public function categoriaget() {
        $this->conexion = is_resource($this->conexion) ? $this->conexion : $this->CDB->openConect();
        $q = "SELECT * FROM tiendaonline_categoria ORDER BY categoria_nombre ASC";
        if ($this->id > 0) {
            $q = "SELECT * FROM tiendaonline_categoria WHERE categoria_id = " . $this->id;
        }
        $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
        $resultado = mysql_num_rows($con);
        $arr = array();
        while ($obj = mysql_fetch_object($con)) {
            $arr[] = array(
                'id' => $obj->categoria_id,
                'nombre' => ($obj->categoria_nombre),
                'habilitado' => ($obj->categoria_estado),
                'dtcreate' => ($obj->categoria_dtcreate));
        }
        $q1 = "SELECT categoria_nombre FROM tiendaonline_categoria,tiendaonline_producto WHERE categoria_id=product_categoria_id";
        $con1 = mysql_query($q1, $this->conexion) or die(mysql_error() . "***ERROR: " . $q1);
        $resultado1 = mysql_num_rows($con1);
        $arr1 = array();
        while ($obj1 = mysql_fetch_object($con1)) {
            $arr1[] = array(
                'nombre' => ($obj1->categoria_nombre));
        }
        if ($resultado > 0) {
            $arrjson = array('output' => array('valid' => true, 'response' => $arr, 'response1' => $arr1));
        } else {
            $arrjson = $this->UTILITY->error_no_result();
        }
        $this->response = ($arrjson);
    }

    private function categoriadelete() {
        if ($this->id > 0) {
            //Elimina la informacion
            $q = "DELETE FROM tiendaonline_categoria WHERE categoria_id = " . $this->id;
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