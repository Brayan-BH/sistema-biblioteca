<?php include('../template/cabecera.php');?>
<?php 
    //Condicion ternario
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtTitulo=(isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
    $txtAutor=(isset($_POST['txtAutor']))?$_POST['txtAutor']:"";
    $txtAutores=(isset($_POST['txtAutores']))?$_POST['txtAutores']:"";
    $txtMateria=(isset($_POST['txtMateria']))?$_POST['txtMateria']:"";
    $txtEditorial=(isset($_POST['txtEditorial']))?$_POST['txtEditorial']:"";
    $txtLugarEdicion=(isset($_POST['txtLugarEdicion']))?$_POST['txtLugarEdicion']:"";
    $txtFechaEdicion=(isset($_POST['txtFechaEdicion']))?$_POST['txtFechaEdicion']:"";
    $txtPaginas=(isset($_POST['txtPaginas']))?$_POST['txtPaginas']:"";
    $txtContenido=(isset($_POST['txtContenido']))?$_POST['txtContenido']:"";
    $txtDewey=(isset($_POST['txtDewey']))?$_POST['txtDewey']:"";
    $txtTomo=(isset($_POST['txtTomo']))?$_POST['txtTomo']:"";
    $txtNumEjemplares=(isset($_POST['txtNumEjemplares']))?$_POST['txtNumEjemplares']:"";
    $txtEnlace=(isset($_POST['txtEnlace']))?$_POST['txtEnlace']:"";
    $txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    // echo $txtID."<br/>";
    // echo $txtDescripcion."<br/>";
    // echo $txtImagen."<br/>";
    // echo $accion."<br/>";

    //Conexcion a la base de datos
    include('../config/bd.php');

    
    switch($accion){

        case "Insertar":

            $sentenciaSQL = $conexion->prepare("INSERT INTO `libros` (`IDLibro`, `Titulo`, `Autor`, `Autores`, `Materia`, `Editorial`, `LugarEdicion`, `FechaEdicion`, `Paginas`, `Contenido`, `CodigoDewey`, `Tomo`, `NumEjemplares`, `Enlace`, `Imagen`) 
            VALUES (NULL, :Titulo, :Autor, :Autores, :Materia, :Editorial, :LugarEdicion, :FechaEdicion, :Paginas, :Contenido, :CodigoDewey, :Tomo, :NumEjemplares, :Enlace, :Imagen);");
            $sentenciaSQL->bindParam(':Titulo',$txtTitulo);
            $sentenciaSQL->bindParam(':Autor',$txtAutor);
            $sentenciaSQL->bindParam(':Autores',$txtAutores);
            $sentenciaSQL->bindParam(':Materia',$txtMateria);
            $sentenciaSQL->bindParam(':Editorial',$txtEditorial);
            $sentenciaSQL->bindParam(':LugarEdicion',$txtLugarEdicion);
            $sentenciaSQL->bindParam(':FechaEdicion',$txtFechaEdicion);
            $sentenciaSQL->bindParam(':Paginas',$txtPaginas);
            $sentenciaSQL->bindParam(':Contenido',$txtContenido);
            $sentenciaSQL->bindParam(':CodigoDewey',$txtDewey);
            $sentenciaSQL->bindParam(':Tomo',$txtTomo);
            $sentenciaSQL->bindParam(':NumEjemplares',$txtNumEjemplares);
            $sentenciaSQL->bindParam(':Enlace',$txtEnlace);

            $fecha = new DateTime();
            $nombreArchivo =($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            if ($tmpImagen!="") {

                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
            }

            $sentenciaSQL->bindParam(':Imagen',$nombreArchivo);
            
            $sentenciaSQL->execute();

            header("Location:productos.php");


            break;

        case "Modificar":
            $sentenciaSQL = $conexion->prepare("UPDATE libros SET Titulo = :Titulo, Autor = :Autor, Autores = :Autores, Materia = :Materia, Editorial = :Editorial, LugarEdicion = :LugarEdicion, FechaEdicion = :FechaEdicion, Paginas = :Paginas, Contenido = :Contenido, CodigoDewey = :CodigoDewey, Tomo = :Tomo, NumEjemplares = :NumEjemplares, Enlace = :Enlace WHERE IDLibro=:IDLibro");

            $sentenciaSQL->bindParam(':Titulo',$txtTitulo);
            $sentenciaSQL->bindParam(':Autor',$txtAutor);
            $sentenciaSQL->bindParam(':Autores',$txtAutores);
            $sentenciaSQL->bindParam(':Materia',$txtMateria);
            $sentenciaSQL->bindParam(':Editorial',$txtEditorial);
            $sentenciaSQL->bindParam(':LugarEdicion',$txtLugarEdicion);
            $sentenciaSQL->bindParam(':FechaEdicion',$txtFechaEdicion);
            $sentenciaSQL->bindParam(':Paginas',$txtPaginas);
            $sentenciaSQL->bindParam(':Contenido',$txtContenido);
            $sentenciaSQL->bindParam(':CodigoDewey',$txtDewey);
            $sentenciaSQL->bindParam(':Tomo',$txtTomo);
            $sentenciaSQL->bindParam(':NumEjemplares',$txtNumEjemplares);
            $sentenciaSQL->bindParam(':Enlace',$txtEnlace);
            $sentenciaSQL->bindParam(':IDLibro',$txtID);
            $sentenciaSQL->execute();

            if ($txtImagen!="") {
                
                $fecha = new DateTime();
                $nombreArchivo =($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
                $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
                //copiado de la imagen al directorio
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

                $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM libros WHERE IDLibro=:IDLibro");
                $sentenciaSQL->bindParam(':IDLibro',$txtID);
                $sentenciaSQL->execute();
                $productos = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if (isset($productos["Imagen"]) &&($productos["Imagen"]!="Imagen.jpg")){

                    if(file_exists("../../img/".$productos["Imagen"])){

                    unlink("../../img/".$productos["Imagen"]);
                    }

                }


                $sentenciaSQL = $conexion->prepare("UPDATE libros SET Imagen = :Imagen WHERE IDLibro=:IDLibro");
                $sentenciaSQL->bindParam(':Imagen',$nombreArchivo);
                $sentenciaSQL->bindParam(':IDLibro',$txtID);
                $sentenciaSQL->execute();
            }
            header("Location:productos.php");

            // echo "Presionado botón Modificar";
            break;

        case "Cancelar":
            header("Location:productos.php");
            // echo "Presionado botón Cancelar";
            break;

        case "Seleccionar":
            $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE IDLibro = :IDLibro");
            $sentenciaSQL->bindParam(':IDLibro',$txtID);
            $sentenciaSQL->execute();
            $productos = $sentenciaSQL->fetch(PDO::FETCH_LAZY);//cargar los datos uno a uno 
            
            $txtTitulo = $productos['Titulo'];
            $txtAutor = $productos['Autor'];
            $txtAutores = $productos['Autores'];
            $txtMateria = $productos['Materia'];
            $txtEditorial = $productos['Editorial'];
            $txtLugarEdicion = $productos['LugarEdicion'];
            $txtFechaEdicion = $productos['FechaEdicion'];
            $txtPaginas = $productos['Paginas'];
            $txtContenido = $productos['Contenido'];
            $txtDewey = $productos['CodigoDewey'];
            $txtTomo = $productos['Tomo'];
            $txtNumEjemplares = $productos['NumEjemplares'];
            $txtEnlace = $productos['Enlace'];
            $txtImagen=$productos['Imagen'];


            // echo "sionado botón Seleccionar";
            break;

        case "Borrar":
            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM libros WHERE IDLibro=:IDLibro");
            $sentenciaSQL->bindParam(':IDLibro',$txtID);
            $sentenciaSQL->execute();
            $productos = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($productos["Imagen"]) &&($productos["Imagen"]!="Imagen.jpg")){

                if(file_exists("../../img/".$productos["Imagen"])){

                    unlink("../../img/".$productos["Imagen"]);
                }

            }

            $sentenciaSQL = $conexion->prepare("DELETE FROM libros WHERE IDLibro=:IDLibro");
            $sentenciaSQL->bindParam(':IDLibro',$txtID);
            $sentenciaSQL->execute();

            header("Location:productos.php");

            break;


    }
    $sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//recuperar todos los registros para mostrarlo
?>

<div class="">

    <div class="card">
        <div class="card-header">
            Datos del Producto
        </div>
        <div class="card-body">
        
            <form class="form-row" method="POST" action="productos.php" enctype="multipart/form-data">

                <div class = "form-group col-md-3">
                    <label for="txtID">ID:</label>
                    <input type="text" class="form-control" required readonly value="<?php echo$txtID;?>" name="txtID" id="txtID" placeholder="ID">
                </div>

                <div class = "form-group col-md-3">
                    <label for="txtTitulo">Titulo:</label>
                    <input type="text" class="form-control"  value="<?php echo$txtTitulo;?>" name="txtTitulo" id="txtTitulo" placeholder="Titulo">
                </div>

                <div class = "form-group col-md-3">
                    <label for="txtAutor">Autor:</label>
                    <input type="text" class="form-control"  value="<?php echo$txtAutor; ?>" name="txtAutor" id="txtAutor" placeholder="Autor">
                </div>

                <div class = "form-group col-md-3">
                    <label for="txtAutores">Autores:</label>
                    <input type="text" class="form-control"  value="<?php echo$txtAutores;?>" name="txtAutores" id="txtAutores" placeholder="Autores">
                </div>
                
                <div class = "form-group col-md-3">
                    <label for="txtMateria">Materia:</label>
                    <input type="text" class="form-control" value="<?php echo$txtMateria;?>" name="txtMateria" id="txtMateria" placeholder="Materia">
                </div>

                <div class = "form-group col-md-3">
                    <label for="txtEditorial">Editorial:</label>
                    <input type="text" class="form-control" value="<?php echo$txtEditorial;?>" name="txtEditorial" id="txtEditorial" placeholder="Editorial">
                </div>
                <div class = "form-group col-md-3">
                    <label for="txtLugarEdicion">Lugar de Edicion:</label>
                    <input type="text" class="form-control" value="<?php echo$txtLugarEdicion;?>" name="txtLugarEdicion" id="txtLugarEdicion" placeholder="Lugar de Edicion">
                </div>
                <div class = "form-group col-md-3">
                    <label for="txtFechaEdicion">Fecha de Edicion:</label>
                    <input type="date" class="form-control" value="<?php echo$txtFechaEdicion;?>" name="txtFechaEdicion" id="txtFechaEdicion" placeholder="Fecha de Edicion">
                </div>
                <div class = "form-group col-md-3">
                    <label for="txtPaginas">Paginas:</label>
                    <input type="text" class="form-control" value="<?php echo$txtPaginas;?>" name="txtPaginas" id="txtPaginas" placeholder="Paginas">
                </div>
                <div class = "form-group col-md-3">
                    <label for="txtContenido">Contenido:</label>
                    <input type="text" class="form-control" value="<?php echo$txtContenido;?>" name="txtContenido" id="txtContenido" placeholder="Contenido">
                </div>
                <div class = "form-group col-md-3">
                    <label for="txtDewey">Codigo Dewey:</label>
                    <input type="text" class="form-control" value="<?php echo$txtDewey;?>" name="txtDewey" id="txtDewey" placeholder="Codigo Dewey">
                </div>
                <div class = "form-group col-md-3">
                    <label for="txtTomo">Tomo:</label>
                    <input type="text" class="form-control" value="<?php echo$txtTomo;?>" name="txtTomo" id="txtTomo" placeholder="Ejemplar/Tomo">
                </div>
                <div class = "form-group col-md-3">
                    <label for="txtNumEjemplares">N° de Ejemplares:</label>
                    <input type="text" class="form-control" value="<?php echo$txtNumEjemplares;?>" name="txtNumEjemplares" id="txtNumEjemplares" placeholder="N° ejemplares">
                </div>
                <div class = "form-group col-md-3">
                    <label for="txtEnlace">Enlace Libro Digital:</label>
                    <input type="text" class="form-control" value="<?php echo$txtEnlace;?>" name="txtEnlace" id="txtEnlace" placeholder="Enlace Libro digital">
                </div>

                <div class = "form-group col-md-3">
                    <label for="txtImagen">Imagen:</label>
                    <br>
                    <?php if($txtImagen!=""){?>

                        <img class="img-thumbnail rounded mb-3" src="../../img/<?php echo $txtImagen;?>" width="100" alt="">

                    <?php } ?>

                    <input type="file"  class="form-control" name="txtImagen" id="txtID" placeholder="Imagen">
                </div>
                <div class="col-md-5 my-4" >
                    <button name="accion" value="Insertar"   <?php echo ($accion=="Seleccionar")?"disabled":""?> class="btn btn-success " type="submit">Agregar</button>
                    <button name="accion" value="Modificar" <?php echo ($accion!="Seleccionar")?"disabled":""?> class="btn btn-warning " type="submit">Modificar</button>
                    <button name="accion" value="Cancelar"  <?php echo ($accion!="Seleccionar")?"disabled":""?> class="btn btn-info" type="submit">Cancelar</button>
                    <a href="../reportes/reportes.php" target="_blank"><i class="fa fa-file-pdf fa-lg"> PDF</i></a>
                </div>
                
            </form>

        </div>
    </div>

</div>

<!-- Estilo tabla -->
<style>
.contenido {
    width: 200px;
    white-space: nowrap;
    overflow: hidden;
    
    text-overflow: ellipsis;
}

td.contenido{
    max-width: 200px;
}
</style>

<div class="table-responsive col-md-12">
    
    <table class="table table-hover table-responsive w-auto" id="tabla">
        <thead class="thead-light">
            <tr>
                <th>Acccion</th>
                <th>ID</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Autores</th>
                <th>Materia</th>
                <th>Editorial</th>
                <th>Lugar Edicion</th>
                <th>Fecha Edicon</th>
                <th>Paginas</th>
                <th>Contenido</th>
                <th>Codigo Dewey</th>
                <th>Tomo</th>
                <th>N° Ejemplares</th>
                <th>Enlace</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaProductos as $libros){?>
            <tr>
            <td>                    
                    <form method="post"> 
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $libros['IDLibro'];?>"/>
                        <button type="submit" name="accion" value="Seleccionar" class="btn btn-success"><i class="fa fa-pen"></i></button>
                        <button type="submit" name="accion" value="Borrar" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
            </td>
                <td><?php echo $libros['IDLibro'];?></td>
                <td><?php echo $libros['Titulo'];?></td>
                <td><?php echo $libros['Autor'];?></td>
                <td><?php echo $libros['Autores'];?></td>
                <td><?php echo $libros['Materia'];?></td>
                <td><?php echo $libros['Editorial'];?></td>
                <td><?php echo $libros['LugarEdicion'];?></td>
                <td><?php echo $libros['FechaEdicion'];?></td>
                <td><?php echo $libros['Paginas'];?></td>
                <td><div class="contenido"><?php echo $libros['Contenido'];?></div></td>
                <td><?php echo $libros['CodigoDewey'];?></td>
                <td><?php echo $libros['Tomo'];?></td>
                <td><?php echo $libros['NumEjemplares'];?></td>
                <td><div class="contenido"><?php echo $libros['Enlace'];?></div></td>
                <td>
                    
                <img class="img-thumbnail rounded" src="../../img/<?php echo $libros['Imagen'];?>" width="60" alt="">
                    
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>

    var tabla = document.querySelector("#tabla");

    var dataTable = new DataTable(tabla,{
	perPage : 5,
	perPageSelect : [5,10,15,20]
	
});

</script>

<?php include('../template/pie.php');?>
