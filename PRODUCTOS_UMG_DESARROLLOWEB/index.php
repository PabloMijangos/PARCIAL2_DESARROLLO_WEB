<!doctype html>
<html lang="en">
  <head>
	<title>Parcial 2 Desarrollo Web</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
  <body background="imgs/fondo_index.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
  	<div class="container" style="padding:20px; background-color: #F0B12B; color:white; margin-top: 2em;">
	  
	  	<h1 class="text-center"> Formulario Productos </h1>
	</div>
	  <div class="container" style="padding:5px; background-color: white; ">
		  <form class="d-flex" action="agregarProducto.php" method="POST">
			<div class="col">
			  <div class="row">  
			  	<div class="col-md-6">
					<label for="lbl_producto" class="form-label"><b>Nombre Producto</b></label>
					<input type="text" name="txt_producto" id="txt_producto" class="form-control" placeholder="------Nombre-----Producto" required>
				</div>
				<?php
			ob_start();
			require_once 'conexionBD.php';
	
			$db_conexionProductos = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre, $port);
			$db_conexionProductos ->real_query("SELECT p.id_producto AS id, p.producto, m.marca, p.descripcion, p.precio_costo, p.precio_venta, p.existencia FROM productos AS p INNER JOIN marcas AS m ON p.id_marca = m.id_marca;");
			$resultadoProducto = $db_conexionProductos->use_result();

		
			$db_conexion_marca = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre, $port);
			$db_conexion_marca ->real_query("SELECT id_marca AS id, marca FROM marcas");
			$resultado_marca = $db_conexion_marca->use_result();
?>
				<div class="col-md-4">
				  <label for="lbl_marca" class="form-label"><b>Marca</b></label>
				  <select class="form-select" name="drop_marca" id="drop_marca" required>
					<option value=0>--- ESCOJA LA MARCA  ---</option>
					
					<?php
						while($filanombre_marca = $resultado_marca->fetch_assoc()){
							echo"<option value=". $filanombre_marca['id'] .">". $filanombre_marca['marca'] ."</option>";
						}
						$db_conexion_marca->close();
					?>

				  </select>
				</div>
			  </div>

				<div class="col-md-6">
				<label for="lbl_preciocosto" class="form-label"><b>Precio Costo</b></label>
					<input type="number"  name="txt_preciocosto" id="txt_preciocosto" class="form-control" placeholder="Escriba el costo " required>
				</div>

				<div class="col-md-6">
					<label for="lbl_precioventa" class="form-label"><b>Precio Venta</b></label>
					<input type="number"  name="txt_precioventa" id="txt_precioventa" class="form-control" placeholder="Escriba de venta" required>
				</div>
			  </div>

			


				<div class="col-md-4">
					<label for="lbl_descripcionProducto" class="form-label"><b>Descripcion</b></label>
					<textarea class="form-control" name="txt_descripcion" id="txt_descripcion" placeholder="Coloque descripcion del producto"></textarea>
				</div>
				<div class="row" style="margin-top: 1em;">


				
				<div class="col-md-4">
					
					<label for="lbl_existencia" class="form-label"><b>Existencias</b></label>
					<input type="number" name="txt_existencia" id="txt_existencia" class="form-control"  required>
				</div>
			  </div>
				
				<div class="" style="margin-top: 4em;">
					<input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-info" value="Agregar">
				</div>

			</div>
		  </form>
	  </div>
	  <div class="container" style="padding:10px; background-color: #F0B12B; color:white; margin-top: 2em;">
	  	<h1 class="text-center"> La Lista de los productos registrados </h1>
	  </div>
	  <div class="container" style="padding:10px; background-color: white;">
		  <br>

		  <table class="table table-striped table-inverse table-responsive">
			  <thead class="thead-inverse">
				  <tr>
					  <th>Producto</th>
					  <th>Marca</th>
					  <th>Descripcion</th>
					  <th>Precio Costo</th>
					  <th>Precio Venta</th>
					  <th>Existencias</th>
					  <th>Acciones</th>
				  </tr>
				  </thead>
				  <tbody>
				    
					<?php
						while($fila_nombre_producto = $resultadoProducto->fetch_assoc()){
							echo "<tr data-id=". $fila_nombre_producto['id'] .">";
								echo"<td>". $fila_nombre_producto['producto'] ."</td>";
								echo"<td>". $fila_nombre_producto['marca'] ."</td>";
								echo"<td>". $fila_nombre_producto['descripcion'] ."</td>";
								echo"<td>". $fila_nombre_producto['precio_costo'] ."</td>";
								echo"<td>". $fila_nombre_producto['precio_venta'] ."</td>";
								echo"<td>". $fila_nombre_producto['existencia'] ."</td>";
								echo"<td><a href='editarProducto.php?id=".$fila_nombre_producto['id']."' class='btn btn-success'>Editar</a></td>";
								echo"<td><a href='eliminarProducto.php?id=".$fila_nombre_producto['id']."' class='btn btn-danger'>Eliminar</a></td>";
								
							echo"</tr>";
						}
						$db_conexionProductos->close();
					?>
				  </tbody>
		  </table>

	  </div>						

	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
  <footer>

</html>
