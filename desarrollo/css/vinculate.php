<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!-- Optimized mobile viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--Fin Optimized mobile viewport -->
<META NAME="Author" CONTENT="www.secuencia24.com"/>
<META NAME="Description" CONTENT="Fundacion ADA"/>
<META NAME="Keywords" CONTENT="Fundacion ADA"/>
<META NAME="Robots" CONTENT="All"/>
<title>Fundacion ADA</title>

<link type="image/x-icon" href="images/logoUltraFitnessIco.ico" rel="icon" />
<link href="css/style_prin.css" rel="stylesheet" type="text/css" />
<link href="css/respond.css" rel="stylesheet" type="text/css" />
<link href="css/grid.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />

<link href="css/menu.css" rel="stylesheet" type="text/css" />

<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' />
<!--botones sobre-->
<script  type='text/javascript' src="js/btnscripts.js"></script>
<!--fin botones sobre-->
<!--menu e6-->
<script  type='text/javascript' src="js/menu_ie6.js"></script>
<!--menu e6-->
<!--movil -->
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script  type='text/javascript' src="js/moviles.js"></script>
<!--movil-->
<!--google-->

<!--google fin-->


</head>

<body onLoad="cambio('link4');">

<div class="spanMovil"></div>
<!--header sitio----------------------------------------------------------------------------------------------->
<?php
 include 'includes/header-prin.php';
?>
<!--section sitio----------------------------------------------------------------------------------------------->
<section class="sect_Cot">
 <section class="col-g-r">
  <div class="col-u-1-2">
    <h2>Vincúlate</h2>
  <div class="infoCont">

    <div>
Hacer parte de la Fundación ADA es muy sencillo. Existen diversas formas de apoyar y participar de nuestra labor. Puedes ingresar tus DATOS y recibirás periódicamente noticias de la Fundación.
 </div>
    </div>
  </div>


   <div class="col-u-1-2">
   <div class="formVincu">
<form  name="form" id="form">
 <label>Nombre</label>
    <input type="text" placeholder="nombre" name="txt_name">
    <input type="text" placeholder="correo" name="txt_correo">
    <input type="text" placeholder="profesion/ocupación" name="txt_prof">
    <input type="text" placeholder="organizacion" name="txt_org">
    <select name="pais">
        <option> colombia</option>
    </select>
    <select name="ciudad">
    <option> medellin</option>
    </select>
    
    
    <input type="text" placeholder="Fecha nacimietno" name="txt_fecha">
    
    <textarea name="txt_comentario" placeholder="dejanos tu comentario">
    </textarea>
    
    <input type="submit" value="Enviar">
</form>
</div>
</div>

 </section>
</section>
<!--footer sitio---------------------------------------------------------------------------------------------------->
<?php
include 'includes/footer-prin.php';
?>
</body>
</html>
