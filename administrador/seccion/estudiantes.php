<?php include('../template/cabecera.php');?>

<?php 

//Condicion ternario

$txtIDEstudiante=(isset($_POST['txtIDEstudiante']))?$_POST['txtIDEstudiante']:"";
$txtNombres=(isset($_POST['txtNombres']))?$_POST['txtNombres']:"";
$txtApellidoPat=(isset($_POST['txtApellidoPat']))?$_POST['txtApellidoPat']:"";
$txtApellidoMat=(isset($_POST['txtApellidoMat']))?$_POST['txtApellidoMat']:"";
$txtGrado=(isset($_POST['txtGrado']))?$_POST['txtGrado']:"";
$action=(isset($_POST['action']))?$_POST['action']:"";

include('../config/bd.php');

switch ($action) {
    case "Add":
        
        $sentenciaSQL = $conexion->prepare("INSERT INTO `estudiantes` ( `Nombres`, `Apellidopat`, `Apellidomat`, `GradoSeccion`) VALUES (:Nombres, :Apellidopat, :Apellidomat, :GradoSeccion);");

        $sentenciaSQL->bindParam(':Nombres',$txtNombres);
        $sentenciaSQL->bindParam(':Apellidopat',$txtApellidoPat);
        $sentenciaSQL->bindParam(':Apellidomat',$txtApellidoMat);
        $sentenciaSQL->bindParam(':GradoSeccion',$txtGrado);

        $sentenciaSQL->execute();

        header("Location:estudiantes.php");


        // echo "Presionado botón agregar";

        break;

    case "Modify":

        $sentenciaSQL = $conexion->prepare("UPDATE estudiantes SET Nombres = :Nombres, Apellidopat = :Apellidopat, Apellidomat = :Apellidomat, GradoSeccion = :GradoSeccion WHERE IDEstudiante = :IDEstudiante");
        
        $sentenciaSQL->bindParam(':Nombres',$txtNombres);
        $sentenciaSQL->bindParam(':Apellidopat',$txtApellidoPat);
        $sentenciaSQL->bindParam(':Apellidomat',$txtApellidoMat);
        $sentenciaSQL->bindParam(':GradoSeccion',$txtGrado);
        $sentenciaSQL->bindParam(':IDEstudiante',$txtIDEstudiante);

        $sentenciaSQL->execute();
        
        header("Location:estudiantes.php");

        // echo "Presionado botón Modificar";
        
    case "Cancel":

        header("Location:estudiantes.php");

        // echo "Presionado botón Cancelar";
        break;

    case "Select":

        $sentenciaSQL = $conexion->prepare("SELECT * FROM estudiantes WHERE IDEstudiante = :IDEstudiante");
        $sentenciaSQL->bindParam(':IDEstudiante',$txtIDEstudiante);
        $sentenciaSQL->execute();
        $estudiantes = $sentenciaSQL->fetch(PDO::FETCH_LAZY);//Rellenarlos uno a uno

        $txtNombres = $estudiantes['Nombres'];
        $txtApellidoPat = $estudiantes['Apellidopat'];
        $txtApellidoMat = $estudiantes['Apellidomat'];
        $txtGrado = $estudiantes['GradoSeccion'];

        // echo "Presionado botón Seleccionar";
        break;
        
    case "Delete":

        $sentenciaSQL = $conexion->prepare("DELETE FROM estudiantes WHERE IDEstudiante = :IDEstudiante");
        $sentenciaSQL->bindParam(':IDEstudiante',$txtIDEstudiante);
        $sentenciaSQL->execute();

        header("Location:estudiantes.php");

        // echo "Presionado botón Delete";

        break;
}

    $sentenciaSQL = $conexion->prepare("SELECT * FROM estudiantes");
    $sentenciaSQL->execute();
    $listaEstudiantes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//recuperar todos los registros para mostrarlo

    // print_r($listaEstudiantes);

?>

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
        Datos Del Estudiante
        </div>
            <div class="card-body">
            <form action="estudiantes.php" method="POST">
                <div class="container">
                        
                        <label for="txtIDEstudiante">IDEstudiante</label>
                        <input type="text" class="form-control" required readonly  value="<?php echo$txtIDEstudiante;?>" name="txtIDEstudiante" id="txtIDEstudiante" placeholder="IDEstudiante">

                        <label for="txtNombres">Nombres:</label>
                        <input type="text" class="form-control"  value="<?php echo $txtNombres;?>" name="txtNombres" id="txtNombres" placeholder="Nombres">

                        <label for="txtApellidoPat">Apellido Paterno:</label>
                        <input type="text" class="form-control"  value="<?php echo $txtApellidoPat;?>" name="txtApellidoPat" id="txtApellidoPat" placeholder="Apellido Paterno">

                        <label for="txtApellidoMat">Apellido Materno:</label>
                        <input type="text" class="form-control"  value="<?php echo $txtApellidoMat;?>" name="txtApellidoMat" id="txtApellidoMat" placeholder="Apellido Materno">

                        <label for="txtGrado">Grado y Seccion:</label>
                        <input type="text" class="form-control"  value="<?php echo $txtGrado;?>" name="txtGrado" id="tetGrado" placeholder="Grado y Seccion">
                </div>
                <div class="col my-4" >
                    <button name="action" value="Add"   <?php echo ($action=="Select")?"disabled":""?> class="btn btn-success " type="submit">Agregar</button>
                    <button name="action" value="Modify" <?php echo ($action!="Select")?"disabled":""?> class="btn btn-warning " type="submit">Modificar</button>
                    <button name="action" value="Cancel"  <?php echo ($action!="Select")?"disabled":""?> class="btn btn-info" type="submit">Cancelar</button>
                    <a href="../reportes/students.php" target="_blank"><i class="fa fa-file-pdf fa-lg"> PDF</i></a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-8" id="table">
<table class="table table-hover table-responsive w-auto" id="table-estu">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombres</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Grado y Seccion</th>
            <th>Accion</th>
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
            <td>
                <form method="POST">  
                    <input type="hidden" name="txtIDEstudiante" id="txtIDEstudiante" value="<?php echo $estudiantes['IDEstudiante'];?>"/>
                    <button type="submit" name="action" value="Select" class="btn btn-success"><i class="fa fa-pen"></i></button>
                    <button type="submit" name="action" value="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>

<script>

    var tabla = document.querySelector("#table-estu");

    var dataTable = new DataTable(tabla,{
	perPage : 7,
	perPageSelect : [7,14,21,28]
	
});

</script>


<?php include('../template/pie.php');?>

