<?php include('template/cabecera.php');?>

<?php 
    include('administrador/config/bd.php');
    
    $sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//recuperar todos los registros para mostrarlo
    ?>


<?php foreach($listaProductos as $libros){?>
    
    <!-- presentacion de productos -->
    <div class="col-md-3 my-2">
        <div class="card">
            <img 
                class="" 
                title="<?php echo $libros['Contenido'];?>"
                src="./img/<?php echo $libros['Imagen'];?>" 
                alt="<?php echo $libros['Autores'];?>"
                height="300px"
        
        >
            <div class="card-body">
                <h4 class="card-title"><?php echo $libros['Titulo'];?></h4>
                <p class="card-text"><?php echo "Autor: ".$libros['Autor'];?></p>
                <p class="card-subtitle">Materia: <?php echo $libros['Materia'];?></p>
                <a class="btn btn-info" href="<?php echo $libros['Enlace'];?>" target="_blank">Ver Libro</a>
            </div>
            
</div>    
</div>

<script>
    $(function () {

    $('[data-toggle="popover"]').popover()
})
</script>

<?php } ?>

<?php include('template/pie.php')?>


