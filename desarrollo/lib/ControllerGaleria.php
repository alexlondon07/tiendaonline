<?php

//include 'ConectionDb.php';
//include 'Util.php';

/**
 * Clase que contiene todas las operaciones utilizadas sobre la base de datos
 * @author Alexander Londoño
 */
class ControllerGaleria {

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
        if ($this->op == 'galeriasave') {
            $this->idcategoria = isset($rqst['idcategoria']) ? $rqst['idcategoria'] : '';
            $this->idproducto = isset($rqst['idproducto']) ? $rqst['idproducto'] : '';
            $this->descrip = isset($rqst['descrip']) ? $rqst['descrip'] : '';
            $this->archivo = isset($_FILES['archivo']) ? $_FILES['archivo'] : '';
            $this->habilitado = isset($rqst['habilitado']) ? $rqst['habilitado'] : '';
            $this->nom_cat = isset($rqst['nom_cat']) ? $rqst['nom_cat'] : '';
            $this->nom_prod = isset($rqst['nom_prod']) ? $rqst['nom_prod'] : '';
            $this->galeriasave();
        } else if ($this->op == 'galeriaget') {
            $this->galeriaget();
        } else if ($this->op == 'galeriadelete') {
            $this->galeriadelete();
        } else if ($this->op == 'prod_catget') {
            $this->prod_catget();
        }
    }

    /**
     * Metodo para guardar y actualizar
     */
    private function galeriasave() {
        $keyid = isset($_REQUEST['keyid']) ? $_REQUEST['keyid'] : ''; //ID QUE ME TRAIGO DEL FORMULARIO
        $id = 0;
        $file = isset($_FILES['archivo']) ? $_FILES['archivo'] : ''; //ARCHIVO
        $idfile = 0;
        if ($keyid > 0) {
            //se actualzia la información
            $q = "SELECT arc_id FROM tiendaonline_archivos WHERE arc_id = " . $keyid;
            $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
            while ($obj = mysql_fetch_object($con)) {
                $id = $obj->arc_id;
                $table = "tiendaonline_archivos";
                $arrfieldscomma = array(
                    'arc_descrip' => $this->descrip,
                    'arc_estado' => $this->habilitado);
                $arrfieldsnocomma = array('categoria_id' => $this->idcategoria, 'product_id' => $this->idproducto, 'arc_dtcreate' => $this->UTILITY->date_now_server());
                $q = $this->UTILITY->make_query_update($table, "arc_id = '$id'", $arrfieldscomma, $arrfieldsnocomma);
                mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
                // $arrjson = array('output' => array('valid' => true, 'id' => $id));
                header('Location: galerias.php');
            }
            //ACTULIZAR REGITSRO DE ARCHIVOS
            if ($file > 0) {
                $file_name = utf8_decode($file['name']);
                $file_type = $file['type'];
                $file_tmp_name = $file['tmp_name'];
                $file_error = $file['error'];
                $file_size = $file['size'];
                $contenido = '';
                //ACTULIZA EL RESGIRO SI LA VARIABLE $file_name NO ESTA NULA 
                if ($file_name != '') {
                    $fp = fopen($file_tmp_name, "rb");
                    $contenido = fread($fp, $file_size);
                    $contenido = addslashes($contenido);
                    fclose($fp);
                    if ($file_error == 0 && $file_size > 0 && $file_size < 14716800) {
                        $q = "UPDATE tiendaonline_archivos SET arc_nombre='" . $file_name . "' ,arc_tipo='" . $file_type . "',arc_contenido='" . $contenido . "',arc_tamanio='" . $file_size . "' WHERE arc_id=" . $keyid;
                        mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
                        $idfile = mysql_insert_id();
                        if ($idfile <= 0) {
                            header('Location: galerias.php');
                            //$this->response = $this->UTILITY->error_missing_data_file();
                        }
                        header('Location: galerias.php');
                    }
                    header('Location: galerias.php');
                }
                header('Location: galerias.php');
            }
            header('Location: galerias.php');
        } else {
            /* AQUI ES DONDE SE INGRESAN LAS FOTOS */
            //GUARADAR LA IMAGEN
            if ($file > 0) {
                $file_name = utf8_decode($file['name']);
                $file_type = $file['type'];
                $file_tmp_name = $file['tmp_name'];
                $file_error = $file['error'];
                $file_size = $file['size'];
                $contenido = '';
                if ($file_name != '') {
                    $fp = fopen($file_tmp_name, "rb");
                    $contenido = fread($fp, $file_size);
                    $contenido = addslashes($contenido);
                    fclose($fp);
                    if ($file_error == 0 && $file_size > 0 && $file_size < 14716800) {
                        $q = "INSERT INTO tiendaonline_archivos (arc_dtcreate, categoria_id,product_id,arc_descrip,arc_estado,arc_nombre,arc_tipo,arc_contenido,arc_tamanio) VALUES (" . $this->UTILITY->date_now_server() . ", $this->idcategoria, $this->idproducto, '$this->descrip','$this->habilitado','" . $file_name . "','" . $file_type . "','" . $contenido . "','" . $file_size . "')";
                        mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
                        $idfile = mysql_insert_id();
                        if ($idfile <= 0) {
                            //No ingreso el registro
                            header('Location: galerias.php');
                        }
                        header('Location: galerias.php');
                    }
                    header('Location: galerias.php');
                } else {
                    //Si no manda images
                    $q = "INSERT INTO tiendaonline_archivos (arc_dtcreate,categoria_id, product_id,arc_descrip,arc_estado) VALUES (" . $this->UTILITY->date_now_server() . ", $this->idproducto, '$this->descrip','$this->habilitado',$this->idcategoria)";
                    mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
                    header('Location: galerias.php');
                }
                header('Location: galerias.php');
            }
            header('Location: galerias.php');
            //$arrjson = array('output' => array('valid' => true, 'id' => $id));
        }
        header('Location: galerias.php');
        //$this->response = ($arrjson);
    }

    public function galeriaget() {
        $this->conexion = is_resource($this->conexion) ? $this->conexion : $this->CDB->openConect();
        $q = "SELECT * FROM tiendaonline_producto, tiendaonline_archivos,tiendaonline_categoria WHERE tiendaonline_producto.product_id=tiendaonline_archivos .product_id and tiendaonline_archivos.categoria_id=tiendaonline_categoria.categoria_id";
        if ($this->id > 0) {
            //Pedir la informacion en el modulo de galeria administrdaor
            $q = "SELECT * FROM tiendaonline_producto, tiendaonline_archivos,tiendaonline_categoria WHERE tiendaonline_producto.product_id=tiendaonline_archivos .product_id and tiendaonline_archivos.categoria_id=tiendaonline_categoria.categoria_id and arc_id = " . $this->id;
        }
        $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
        $resultado = mysql_num_rows($con);
        $arr = array();
        while ($obj = mysql_fetch_object($con)) {
            $arr[] = array(
                'id' => $obj->arc_id,
                'idcategoria' => $obj->categoria_id,
                'nom_cat' => ($obj->categoria_nombre),
                'idproducto' => $obj->product_id,
                'nom_prod' => ($obj->product_nombre),
                'habilitado' => ($obj->arc_estado),
                'descrip' => ($obj->arc_descrip),
                'dtcreate' => ($obj->arc_dtcreate));
        }

        if ($resultado > 0) {
            $arrjson = array('output' => array('valid' => true, 'response' => $arr));
        } else {
            $arrjson = $this->UTILITY->error_no_result();
        }
        $this->response = ($arrjson);
    }

    public function galeria_detalleget() {
        $this->conexion = is_resource($this->conexion) ? $this->conexion : $this->CDB->openConect();
        //Pedir las fotos asociadas Ver detakkes galeria
        $q = "SELECT * FROM tiendaonline_producto, tiendaonline_archivos,tiendaonline_categoria WHERE tiendaonline_producto.product_id=tiendaonline_archivos .product_id and tiendaonline_archivos.categoria_id=tiendaonline_categoria.categoria_id and tiendaonline_archivos.arc_estado='activo' and tiendaonline_archivos.product_id = " . $this->id;
        $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
        $resultado = mysql_num_rows($con);
        $arr = array();
        while ($obj = mysql_fetch_object($con)) {
            $arr[] = array(
                'id' => $obj->arc_id,
                'idcategoria' => $obj->categoria_id,
                'nom_cat' => ($obj->categoria_nombre),
                'idproducto' => $obj->product_id,
                'nom_prod' => ($obj->product_nombre),
                'habilitado' => ($obj->arc_estado),
                'descrip' => ($obj->arc_descrip),
                'dtcreate' => ($obj->arc_dtcreate));
        }

        if ($resultado > 0) {
            $arrjson = array('output' => array('valid' => true, 'response' => $arr));
        } else {
            $arrjson = $this->UTILITY->error_no_result();
        }
        $this->response = ($arrjson);
    }

    //Lista  los productos segun su categoria
    public function prod_catget() {
        $this->conexion = is_resource($this->conexion) ? $this->conexion : $this->CDB->openConect();
        if ($this->id > 0) {
            //Pedir productos asocidos a cada categoria , para mostra en el modulo de galeria
            $q = "SELECT product_id,product_nombre FROM  tiendaonline_producto WHERE product_categoria_id= " . $this->id;
        }
        $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
        $resultado = mysql_num_rows($con);
        $arr = array();
        while ($obj = mysql_fetch_object($con)) {
            $arr[] = array(
                'id' => $obj->product_id,
                'nombre' => ($obj->product_nombre));
        }
        if ($resultado > 0) {
            $arrjson = array('output' => array('valid' => true, 'response' => $arr));
        } else {
            $arrjson = $this->UTILITY->error_no_result();
        }
        $this->response = ($arrjson);
    }

    private function galeriadelete() {
        if ($this->id > 0) {
            //Elimina la informacion
            $q = "DELETE FROM tiendaonline_archivos WHERE arc_id = " . $this->id;
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