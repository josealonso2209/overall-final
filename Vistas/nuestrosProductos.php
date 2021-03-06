<?php
	include '../Utils/conexion.php';
	include '../Vistas/carrito.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/estilos.css"> -->
	<link rel="stylesheet" href="../css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Nuestros Productos</title>

    <script src="../js/jquery-3.2.1.js"></script>
	<script src="../js/script.js"></script>
</head>
<body style="background: url(../img/decarga2.png) no-repeat center center fixed;">
    <div class="container-fluid">

   		<?php include '../Vistas/encabezado.php';?>

		<?php if($mensaje != "") { ?>
			<div class="alert alert-success">
				<?php echo $mensaje;//print_r($_POST);?>
				<a href="mostrarCarrito.php" class="badge badge-success">Ver Carrito</a>
			</div>
		<?php } ?>

		<div class="row">
			<?php
				$cnx = new ConexionDB();
				$cn=$cnx->getConexion();

				$res=$cn->prepare("select * from products");
				$res->execute();
				$listarProductos=$res->fetchAll(PDO::FETCH_ASSOC);
			?>
			<div class="container">
				<div class="row">
					<?php  foreach($listarProductos as $producto){  ?>
						<div class="col-md-4">
							<div class="card mb-4">
								<div style="width: 100%;">
									<img class="img-fluid" style="width: 180px; height: 200px; padding-top: 20px;" title="<?php echo $producto['nombre'];?>" alt="<?php echo $producto['nombre'];?>" data-toggle="popover" data-content="<?php echo $producto['descripcion'];?>" data-trigger="hover" src="data:image/png;base64,<?php echo base64_encode( $producto['imagen']);?>">
								</div>
								<div class="card-body">
									<span><?php echo $producto['nombre'];?></span>
									<h5 class="card-title">$<?php echo $producto['precio'];?></h5>
									<p class="card-text">Cantidad</p>
									<form class="form-group" action="" method="post">
										<!-- hidden para que se oculten los elementos -->
										<input type="hidden" name="id" id="id" value="<?php echo $producto['id'];?>">
										<input type="hidden" name="nombre" id="nombre" value="<?php echo $producto['nombre'];?>">
										<input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio'];?>">
										<input type="number" name="cantidad" id="cantidad" value="<?php echo 1;?>"><br><br>
									<button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
									</form>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

	</div> 

	<?php include '../Vistas/footer.php';?>

    <script>
		$(function () {
           $('[data-toggle="popover"]').popover()
        })
	</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>