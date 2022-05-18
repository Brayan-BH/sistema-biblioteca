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
    <title>Reporte de Prestamos</title>
</head>
<body>

<?php

include('../config/bd.php');

$sentenciaSQL = $conexion->prepare("SELECT * FROM prestamos");
$sentenciaSQL->execute();
$listaPrestamos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<h1 class="text-center">Repporte de Prestamos</h1>
<table class="table table-bordered table-striped" id="table-pres"  border="1">
        <thead>
            <tr>
                <th>N°</th>
                <th>Libro</th>
                <th>Estudiante</th>
                <th>Fecha Prestamo</th>
                <th>Fecha Devolución</th>
                <th>Descripcion</th>
                <th>Condicion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaPrestamos as $prestamos){ ?>
            <tr>
                <td><?php echo $prestamos['id']?>
                <td><?php echo $prestamos['Libros']?></td>
                <td><?php echo $prestamos['Estudiantes']?></td>
                <td><?php echo $prestamos['FechaPrestamo']?></td>
                <td><?php echo $prestamos['FechaDevolucion']?></td>
                <td><?php echo $prestamos['Descripcion']?></td>
                <td><?php echo $prestamos['Condicion']?></td>
            </tr>
            <?php } ?> 
        </tbody>
    </table>
</body>
</html>
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
$dompdf->setPaper('ladscape');
// $dompdf->setpaper(array(0,0,720.00, 1224.00), 'landscape');

$dompdf->render();

$dompdf->stream("archivo_.pdf",array("Attachment"=>false));

?>