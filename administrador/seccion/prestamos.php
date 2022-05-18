<?php include('../template/cabecera.php');?>

<?php
//Condicion Ternario
$txtIdPrestamo=(isset($_POST['txtIdPrestamo']))?$_POST['txtIdPrestamo']:"";
$txtLibros=(isset($_POST['txtLibros']))?$_POST['txtLibros']:"";
$txtEstudiantes=(isset($_POST['txtEstudiantes']))?$_POST['txtEstudiantes']:"";
$txtFechaPrestamo=(isset($_POST['txtFechaPrestamo']))?$_POST['txtFechaPrestamo']:"";
$txtFechaDevolucion=(isset($_POST['txtFechaDevolucion']))?$_POST['txtFechaDevolucion']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$condicion=(isset($_POST['condicion']))?$_POST['condicion']:"";
$envios=(isset($_POST['envios']))?$_POST['envios']:"";

include('../config/bd.php');

switch ($envios){

    case 'Prestar':
        $condicion = 'Prestado';

        $sentenciaSQL = $conexion->prepare("INSERT INTO `prestamos` (`Libros`, `Estudiantes`, `FechaPrestamo`, `FechaDevolucion`, `Descripcion`, `Condicion`) VALUES (:Libros, :Estudiantes, :FechaPrestamo, :FechaDevolucion, :Descripcion, :Condicion);");

        $sentenciaSQL->bindParam(':Libros',$txtLibros);
        $sentenciaSQL->bindParam(':Estudiantes',$txtEstudiantes);
        $sentenciaSQL->bindParam(':FechaPrestamo',$txtFechaPrestamo);
        $sentenciaSQL->bindParam(':FechaDevolucion',$txtFechaDevolucion);
        $sentenciaSQL->bindParam(':Descripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':Condicion',$condicion);

        $sentenciaSQL->execute();

        header("Location:prestamos.php");

        // echo "Boton registrar presionado";

        break;

    // case 'Modify':
    //     $sentenciaSQL = $conexion->prepare("UPDATE `prestamos` SET Libros = :Libros, Estudiantes = :Estudiantes , FechaPrestamo = :FechaPrestamo , FechaDevolucion = :FechaDevolucion, Descripcion = :Descripcion ,Condicion = :Condicion WHERE id = :id");
        
    //     $sentenciaSQL->bindParam(':Libros',$txtLibros);
    //     $sentenciaSQL->bindParam(':Estudiantes',$txtEstudiantes);
    //     $sentenciaSQL->bindParam(':FechaPrestamo',$txtFechaPrestamo);
    //     $sentenciaSQL->bindParam(':FechaDevolucion',$txtFechaDevolucion);
    //     $sentenciaSQL->bindParam(':Descripcion',$txtDescripcion);
    //     $sentenciaSQL->bindParam(':Condicion',$condicion);
    //     $sentenciaSQL->bindParam(':id',$txtIdPrestamo);

    //     $sentenciaSQL->execute();

    //     header("Location:prestamos.php");

    //     echo "Boton Modify presionado";

    //     break;

    case 'Cancel':

        header("Location:prestamos.php");

        echo "Boton Cancelar presionado";

        break;

    case 'devolver':

        $condicion = "Devuelto";

        $sentenciaSQL = $conexion->prepare("UPDATE `prestamos` SET Condicion = :Condicion WHERE id = :id");
        
        $sentenciaSQL->bindParam(':Condicion',$condicion);
        $sentenciaSQL->bindParam(':id',$txtIdPrestamo);

        $sentenciaSQL->execute();

        header("Location:prestamos.php");


        // echo "Boton seleccionar presionado";

        break;

    case 'erase':

        $sentenciaSQL = $conexion->prepare("DELETE FROM `prestamos` WHERE id = :id");
        $sentenciaSQL->bindParam(':id',$txtIdPrestamo);
        $sentenciaSQL->execute();

        header("Location:prestamos.php");

        // echo "Boton erase presionado";

        break;
}




$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM estudiantes");
$sentenciaSQL->execute();
$listaEstudiantes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM prestamos");
$sentenciaSQL->execute();
$listaPrestamos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

// print_r($listaPrestamo);

?>
<div class="col-md-4">
    <div class="card">
        <div class="card-header">Prestamos</div>
        <div class="card-body">

            <form class="form-group" action="prestamos.php" Method="POST">
            <div class="container">
                        
                        <label for="txtIdPrestamo">Idprestamo:</label>
                        <input type="text" class="form-control" required readonly  value="<?php echo $txtIdPrestamo;?>" name="txtIdPrestamo" id="txtIdPrestamo" placeholder="IdPrestamo">

                        <label for="txtLibros">Libros:</label>
                        <select type="text" class="form-select" class="form-control"  value="<?php echo $txtLibros;?>" name="txtLibros" id="txtLibros" >

                            <option value="0" selected></option>
                            <?php foreach($listaProductos as $libros){?>
                            
                            <option ><?php echo $libros['Titulo'];?></option>

                            <?php } ?>
                        </select>

                        <label for="txtEstudiantes">Estudiantes:</label>
                        <select type="text" class="form-select" class="form-control"  value="<?php echo $txtEstudiantes;?>" name="txtEstudiantes" id="txtEstudiantes" >

                            <option selected></option>
                            <?php foreach($listaEstudiantes as $estudiantes){?>
                            
                            <option ><?php echo $estudiantes['Nombres']." ".$estudiantes['Apellidopat']." ".$estudiantes['Apellidomat'];?></option>

                            <?php } ?>
                        </select>

                        <label for="txtFechaPrestamo">Fecha Prestamo:</label>
                        <input type="date" class="form-control"  value="<?php echo $txtFechaPrestamo;?>" name="txtFechaPrestamo" id="txtFechaPrestamo">

                        <label for="txtFechaDevolucion">Fecha Devolucion:</label>
                        <input type="date" class="form-control"  value="<?php echo $txtFechaDevolucion;?>" name="txtFechaDevolucion" id="txtFechaDevolucion">

                        <label for="txtDescripcion">Descripcion:</label>
                        <input type="text" class="form-control"  value="<?php echo $txtDescripcion;?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripcion">
                        
                        <!-- <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="condicion" id="condicion" value="Prestado">
                            <label class="form-check-label">Prestado</label>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="condicion" id="condicion" value="Devuelto">
                            <label class="form-check-label">Devuelto</label>
                        </div> -->

                        <div class="col my-4" >
                            <button name="envios" value="Prestar" <?php echo ($envios=="seleccionar")?"disabled":""?>   class="btn btn-success " type="submit">Prestar</button>
                            <!-- <button name="envios" value="Modify"    <?php echo ($envios!="seleccionar")?"disabled":""?>   class="btn btn-warning " type="submit">Editar</button> -->
                            <button name="envios" value="Cancel"    <?php echo ($envios=="seleccionar")?"disabled":""?>   class="btn btn-info"     type="submit">Cancelar</button>
                            <a href="../reportes/prestamo.php" target="_blank"><i class="fa fa-file-pdf fa-lg"> PDF</i></a>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-8">
    <table class="table table-hover table-responsive w-auto" id="table-pres">
        <thead>
            <tr>
                <th>Acciones</th>
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
                <td>
                    <form method="POST">  
                    <input type="hidden" name="txtIdPrestamo" id="txtIdPrestamo" value="<?php echo $prestamos['id'];?>"/>
                    <button type="submit" name="envios" value="devolver" class="btn btn-warning mb-1"><i class="fa fa-x"></i></button>
                    <button type="submit" name="envios" value="erase" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </form>
                </td>
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
</div>

<script>

    var tabla = document.querySelector("#table-pres");

    var dataTable = new DataTable(tabla,{
	perPage : 4,
	perPageSelect : [4,8,12,16]
	
});

</script>


<?php include('../template/pie.php');?>
