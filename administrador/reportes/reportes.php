<?php

ob_start();
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- boostrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" 
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"><link rel="stylesheet" href="../../css/estiloAdmin/bootstrap.min.css"> 
    <title>Reporte de Libros</title>
</head>
<body>

<?php 

include('../config/bd.php');

    $sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//recuperar todos los registros para mostrarlo


?>
<h1 class="text-center">Reporte de Libros</h1>
    <table class="table table-bordered table-striped vh-auto" id="tabla" border="1">
        <thead class="thead-light">
            <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Autores</th>
                <th>Materia</th>
                <th>Editorial</th>
                <th>Lugar Edicion</th>
                <th>Fecha Edicon</th>
                <th>Paginas</th>
                <!-- <th>Contenido</th> -->
                <th>Codigo Dewey</th>
                <th>Ejemplar/Tomo</th>
                <th>Ejemplares</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaProductos as $libros){?>
            <tr>
                <td><?php echo $libros['Titulo'];?></td>
                <td><?php echo $libros['Autor'];?></td>
                <td><?php echo $libros['Autores'];?></td>
                <td><?php echo $libros['Materia'];?></td>
                <td><?php echo $libros['Editorial'];?></td>
                <td><?php echo $libros['LugarEdicion'];?></td>
                <td><?php echo $libros['FechaEdicion'];?></td>
                <td><?php echo $libros['Paginas'];?></td>
                <!-- <td><?php echo $libros['Contenido'];?></td> -->
                <td><?php echo $libros['CodigoDewey'];?></td>
                <td><?php echo $libros['Tomo'];?></td>
                <td><?php echo $libros['NumEjemplares'];?></td>
                    <img class="" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/img/<?php echo $libros['Imagen'];?>" width="120" alt="">                 
                </td>

            </tr>
            <?php } ?>
        </tbody>
    </table> 
    
</body>
</html>
<!-- libreria DomPDF -->
<?php
//variable a almacenar el documento HTML
$html = ob_get_clean();
// echo $html;


//incluir el archivo DOMPDF
require_once '../libreria/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

//activar opcion para mostrar imagenes en la lista
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

//formato carta
// $dompdf->setPaper('landscape');
// $dompdf->setPaper('ladscape');Horizontal
$dompdf->setpaper(array(0,0,720.00, 1224.00), 'landscape');

$dompdf->render();

$dompdf->stream("archivo_.pdf",array("Attachment"=>false));

?>