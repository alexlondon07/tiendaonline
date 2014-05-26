<?php

include "conectar.php";

$nombre=$_POST['nombre'];
$fecha=$_POST['fecha'];
$resumen=$_POST['resumen'];
$editor1=$_POST['editor1'];
$nombrebarra=$_POST['nombrebarra'];
$codigobarra=$_POST['codigobarra'];
$nombrebarra2=$_POST['nombrebarra2'];
$codigobarra2=$_POST['codigobarra2'];
$nombrebarra3=$_POST['nombrebarra3'];
$editor2=$_POST['editor2'];
$dia=$_POST['dia'];
$mes=$_POST['mes'];
$ano=$_POST['ano'];


if (isset ($_FILES["archivos"])) { 
//de se asi, para procesar los archivos subidos al servidor solo debemos recorrerlo    
//obtenemos la cantidad de elementos que tiene el arreglo archivos    
$tot = count($_FILES["archivos"]["name"]);  
//este for recorre el arreglo     
for ($i = 0; $i < $tot; $i++)	{     
//con el indice $i, poemos obtener la propiedad que desemos de cada archivo 
//para trabajar con este         
$tmp_name = $_FILES["archivos"]["tmp_name"][$i];   
$name = $_FILES["archivos"]["name"][$i]; 
$newfile = "imagenes/".$name;   
if (is_uploaded_file($tmp_name)) {      
if (!copy($tmp_name,"$newfile")) {   
print "Error en transferencia de archivo."; 
exit();          
} // if copy   
} // if is_up...
//echo("<b>Archivo </b> $key ");     
//echo("<br />");      
//echo("<b>el nombre original:</b> ");     
//echo($name);        
//echo("<br />");      
//echo("<b>el nombre temporal:</b> \n");       
//echo($tmp_name);           
//echo("<br />");      
}     
}  


if (isset ($_FILES["archivos2"])) { 
//de se asi, para procesar los archivos subidos al servidor solo debemos recorrerlo    
//obtenemos la cantidad de elementos que tiene el arreglo archivos    
$tot2 = count($_FILES["archivos2"]["name"]);  
//este for recorre el arreglo     
for ($i2 = 0; $i2 < $tot2; $i2++){     
//con el indice $i, poemos obtener la propiedad que desemos de cada archivo 
//para trabajar con este         
$tmp_name2 = $_FILES["archivos2"]["tmp_name"][$i2];   
$name = $_FILES["archivos2"]["name"][$i2]; 
$newfile2 = "imagenes/".$name;   
if (is_uploaded_file($tmp_name2)) {      
if (!copy($tmp_name2,"$newfile2")) {   
print "Error en transferencia de archivo."; 
exit();          
} // if copy   
} // if is_up...
//echo("<b>Archivo </b> $key ");     
//echo("<br />");      
//echo("<b>el nombre original:</b> ");     
//echo($name);        
//echo("<br />");      
//echo("<b>el nombre temporal:</b> \n");       
//echo($tmp_name);           
//echo("<br />");      
}     
}  





 

		$conexion=conectarBD();

mysql_select_db("bd_contreebute");
$cadena="SELECT * FROM tblprueba";
			
				$registros1=mysql_query($cadena) or
  						die("Problemas en el select:".mysql_error());
						
						
						
						
						$impresos=0;
						while($row1 = mysql_fetch_array($registros1))
							{
								$impresos2++;
						
						
		
		$id2= $row1['id2'];
	
		}
		
		$id2=$id2+1;



/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
?>


<?php
$campo=array();
$codigo=array();
$i=0;
$j=0;
if ( isset( $_POST ) )
	$postArray = &$_POST ; // 4.1.0 or later, use $_POST
	
else
	$postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS

foreach ( $postArray as $sForm => $value )
{


	if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars( stripslashes( $value ) ) ;
		
		
	else
	
		$postedValue = ( $value ) ;
		$codigo[$i]= ( $value ) ;
		$campo[$j] = $sForm ;
		$ingresar= "INSERT INTO tblprueba (campo,codigo,id2) VALUES ('$campo[$j]', '$codigo[$i]', $id2)" ;
        
	
	
	$i=$i+1;
$j=$j+1;
	
	
	



		
		
//$ingresar= "INSERT INTO tblusuarios VALUES ('','$nombre2', '$apellido2', '$mail2', '$contrasena2', '$genero', '$fecha', '$pais', '$ciudad', , '', '', '', '', '', '', '', '$newfile', '' )" ;
			
			
			
			
			
			
$insertar= mysql_query($ingresar,$conexion) or
  									die("Problemas en en la insercion, el codigo ya existe o los campos no pueden estar en blanco:".mysql_error() );
	
	
	
	
	
	
?>




	<?php
	
			
}
?>
	
    	
   
    
    
    <?php 
    
    $cadena2= "SELECT * FROM tblprueba WHERE id2= '".$id2."'";



	$registros2=mysql_query($cadena2,$conexion) or
  						die("Problemas en el select:".mysql_error());
						
						
				while($row2 = mysql_fetch_array($registros2))
							{			
						$campo2=$row1['campo'];
							
	                    $codigo2=$row1['codigo'];
	
							
	
	if($campo2 == "nombre")
	
	{
	
	$nombre=$codigo2;
	
	}
	if($campo2 == "dia" )
	
	{
	
	$dia=$codigo2;
	
	}				
		
	if($campo2 == "mes")
	
	{
	
	$mes=$codigo2;
	
	}
		if($campo2 == "ano")
	
	{
	
	$ano=$codigo2;
	
	}
		
		
	if($campo2 == "resumen")
	
	{
	
	$resumen=$codigo2;
	
	}
		
		if($campo2 == "archivos")
	
	{
	
	$imagen=$codigo2;
	
	}
	
    if($campo2 == "editor1")
	
	{
	
	$editor=$codigo2;
	
	}
															
	
		  if($campo2 == "nombrebarra")
	
	{
	
	$nombrebarra=$codigo2;
	
	}
		
		  if($campo2 == "codigobarra")
	
	{
	
	$codigobarra=$codigo;
	
	}
		
		  if($campo =="nombrebarra2")
	
	{
	
	$nombrebarra2=$codigo;
	
	}
		  if($campo =="codigobarra2")
	
	{
	
	$codigobarra2=$codigo;
	
	}
	
	if($campo =="nombrebarra3")
	
	{
	
	$nombrebarra3=$codigo;
	
	}
		  if($campo =="codigobarra3")
	
	{
	
	$codigobarra3=$codigo;
	
	}
			
	if($campo =="editor2")
	
	{
	
	$editor2=$codigo;
	
	}	
			
			}
			
 $fecha.=$dia;
 $fecha.="/";
 $fecha.=$mes;
 $fecha.="/";
 $fecha.=$ano;
			
if($newfile=="imagenes/")
{


$newfile="images/blanco.gif";

			
}
		
			
			$ingresar2= "INSERT INTO tblprueba2 (id,nombre,fecha,resumen,imagen,editor1,nombrebarra,codigobarra,nombrebarra2,codigobarra2,nombrebarra3,codigobarra3,editor2) VALUES ($id2,'$nombre', '$fecha','$resumen', '$newfile','$editor1', '$nombrebarra','$codigobarra', '$nombrebarra2','$codigobarra2', '$nombrebarra3','$codigobarra3', '$editor2' )" ;
			
			
			$insertar2= mysql_query($ingresar2,$conexion) or
  									die("Problemas en en la insercion, el codigo ya existe o los campos no pueden estar en blanco:".mysql_error() );
			
			

	echo '<center>LOS DATOS SE INSERTARON CORRECTAMENTE</center>';
        echo '<center><a href="../administrador.php?id='.$usuario.'&strcontrasenia='.$contrasena.'"><p>VOLVER</a></center>';
						

						
						?>
    
