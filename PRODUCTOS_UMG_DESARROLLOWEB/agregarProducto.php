<?php
	include("conexionBD.php");
	$db_conexionPInsert = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	
	$txt_producto = utf8_decode($_POST["txt_producto"]);
	$drop_marca = utf8_decode($_POST["drop_marca"]);
	$txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
	$txt_preciocosto = utf8_decode($_POST["txt_preciocosto"]);
	$txt_precioventa = utf8_decode($_POST["txt_precioventa"]);
	$txt_existencia = utf8_decode($_POST["txt_existencia"]);

	$sqlInsert =  "INSERT INTO productos(producto,id_marca,descripcion,precio_costo,precio_venta,existencia) 
					VALUES ('".$txt_producto."',".$drop_marca.",'".$txt_descripcion."',".$txt_preciocosto.",".$txt_precioventa.",".$txt_existencia.")";

	if($db_conexionPInsert->query($sqlInsert)==true){
		$db_conexionPInsert -> close();
		
		header("Location: index.php");
		ob_end_flush();
	}
	else{
		echo"ERROR EN EL REGISTRO: ". $sqlInsert ."<br>". $db_conexionPInsert -> close();
	}
?>