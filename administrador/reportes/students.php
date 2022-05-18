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
    <title>Reporte de Estudiantes</title>
</head>
<body>

<?php

include('../config/bd.php');

$sentenciaSQL = $conexion->prepare("SELECT * FROM estudiantes");
$sentenciaSQL->execute();
$listaEstudiantes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<h1 class="text-center">Reporte de estudiantes</h1>
<table class="table table-bordered table-striped" id="table-estu"  border="1">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombres</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Grado y Seccion</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listaEstudiantes as $estudiantes){?>
        <tr>
            <td><?php echo $estudiantes['IDEstudiante']?></td>
            <td><?php echo $estudiantes['Nombres']?></td>
            <td><?php echo $estudiantes['Apellidopat']?></td>
            <td><?php echo $estudiantes['Apellidomat']?></td>
            <td><?php echo $estudiantes['GradoSeccion']?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
<html/>
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