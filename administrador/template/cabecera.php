<?php
    //Bloquear la informacion
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location:../index.php');
    }else {
        if ($_SESSION['usuario']=="ok") {
            $nombreUsuario = $_SESSION["nombreUsuario"];
        }
    }

?>

<!doctype html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Administrador</title>

<!-- Bootstrap CSS -->
<link rel="icon" href="/imagenes/santi.PNG">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" 
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="../../css/estiloAdmin/bootstrap.min.1.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
<link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
</head>
<body>

    <?php  $url = "http://".$_SERVER['HTTP_HOST']?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active navbar-brand" href="">Administrador del sitio Web</a>
                <a class="nav-item nav-link" href="<?php echo $url?>/administrador/inicio.php"><i class="fas fa-home"></i> Inicio</a>
    
                <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/productos.php"><i class="fas fa-book"></i> Libros</a>
                <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/estudiantes.php"><i class="fas fa-users"></i> Estudiantes</a>
                <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/prestamos.php"><i class="fas fa-hand"></i> Prestamos</a>
                <a class="nav-item nav-link" href="<?php echo $url;?>"><i class="fas fa-eye"></i> Ver sitio Web</a>
                <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/cerrar.php"><i class="fas fa-door-open"></i> Salir</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <br>

        <div class="row">

        