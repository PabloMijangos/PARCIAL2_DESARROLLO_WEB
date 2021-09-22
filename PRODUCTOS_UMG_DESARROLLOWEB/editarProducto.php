<!doctype html>
<html lang="en">
  <head>
	<title>Editar Producto</title>
	
	<!-- Required meta tags -->
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">


	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body background="imgs/fondo.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
		  <div class="container" style="padding:10px; background-color: #F0B12B; color:white; margin-top: 2em;">
		  <?php
	include("conexionBD.php");
 
    $db_conexion_editar_producto = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
    $idEdit = utf8_decode($_GET["id"]);
    $db_conexion_editar_producto ->real_query("SELECT p.id_producto AS id, p.producto, m.marca, p.descripcion, p.precio_costo, p.precio_venta, p.existencia FROM productos AS p INNER JOIN marcas AS m ON p.id_marca = m.id_marca WHERE id_producto = $idEdit;");
    $resultadoProducto = $db_conexion_editar_producto->use_result();
    $fila = $resultadoProducto->fetch_assoc();

   
    $db_conexion_marca = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre,$port);
	$db_conexion_marca ->real_query("SELECT id_marca AS id, marca FROM marcas;");
	$resultado_marca = $db_conexion_marca->use_result();
    $id_marca = $resultado_marca->fetch_assoc();
?>
		 
		 
		 
		  <h1 class="text-center"> Editar Producto </h1>
		  </div>

	  <div class="container" style="padding:10px; background-color: white; width: 100%;">
		  <form class="d-flex" action="" method="POST" autocomplete="off">
			  <div class="col">
				
                <input type="hidden" name="id" id="id" value="<?php echo $fila['id']; ?>">
			  	<div class="mb-3">
					<label for="lbl_producto" class="form-label"><b>Producto</b></label>
					<input type="text" name="txt_producto" id="txt_producto" class="form-control" value="<?php echo $fila['producto']; ?>">
				</div>

				<div class="mb-3">
				<label for="lbl_marca" class="form-label"><b>Marca</b></label>
				  <select class="form-select" name="drop_marca" id="drop_marca" required>
					<option value="<?php echo $id_marca['id']; ?>"><?php echo $id_marca['marca']; ?></option>
					
					<?php
						while($fila_id_marca = $resultado_marca->fetch_assoc()){
							echo"<option value=". $fila_id_marca['id'] .">". $fila_id_marca['marca'] ."</option>";
						}
						$db_conexion_marca->close();
					?>

				  </select>
				</div>

				<div class="mb-3">
					<label for="lbl_descripcionProducto" class="form-label"><b>Descripcion</b></label>
					<input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" value="<?php echo $fila['descripcion']; ?>">
				</div>

				<div class="mb-3">
					<label for="lbl_preciocosto" class="form-label"><b>Precio Costo</b></label>
					<input type="text" step="0.01" name="txt_preciocosto" id="txt_preciocosto" class="form-control" value="<?php echo $fila['precio_costo']; ?>">
				</div>

				<div class="mb-3">
					<label for="lbl_precioventa" class="form-label"><b>Precio Venta</b></label>
					<input type="number" step="0.01" name="txt_precioventa" id="txt_precioventa" class="form-control" value="<?php echo $fila['precio_venta']; ?>">
				</div>
                
				<div class="mb-3">
					<label for="lbl_existencia" class="form-label"><b>Existencias</b></label>
					<input type="number" name="txt_existencia" id="txt_existencia" class="form-control" value="<?php echo $fila['existencia']; ?>">
				</div>
				
                <?php $db_conexion_editar_producto->close(); ?>

				<div class="mb-3">
                 
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-warning" value="Editar">
				</div>
			  </div>
		  </form>
          
	  </div>

      <?php
		
		if(isset($_POST["btn_editar"])){	
			include 'refrescarProducto.php';
		}

	?>

	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
