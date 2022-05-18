<?php include('template/cabecera.php');?>

<link rel="stylesheet" href="../css/estiloAdmin/bootstrap.min.css">

<div class="card">
    <div class="card-body">
    <div class="col-md-12">
                <div class="">
                <h1 class="display-1 text-success text-dark">Bienvenido <?php echo $nombreUsuario;?> 
                    <br>
                    <img class="img-thumbnail " width="100" src="../imagenes/istockphoto-1327656409-170667a.jpg" alt="">
                </h1>
                <p class="lead">Vamos a administrar nuestros productos en el sitio web</p>
                <hr class="my-3">
                <p>Más Informacion</p>
                <p class="lead">
                    <a class="btn btn-outline-info btn-lg " role="button" href="seccion/productos.php">Administrar</a>
                </p>
                
            </div>
        </div>
    </div>
</div>
        
<?php include('template/pie.php');?>