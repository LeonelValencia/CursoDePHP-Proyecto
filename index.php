<?php include("cabecera.php") ?>
<?php include("conexion.php") ?>
<?php
    $con2=new Conexion();
    $portafolios= $con2->consultar("SELECT * FROM `proyectos`");
?>
    <div class="p-5 bg-light">
        <div class="container">
            <h1 class="display-3">Bienvenid@s</h1>
            <p class="lead">Este es mi portafolio privado</p>
            <hr class="my-2">
            <p>Mas informacion</p>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($portafolios as $portafolio){ ?>
        <div class="col">
            <div class="card">
                <img src="<?php echo 'images/'.$portafolio['imagen'];?>" class="card-img-top" alt="imagen del portafolio">
                <div class="card-body">
                    <h5 class="card-title"> <?php echo $portafolio['nombre'];?> </h5>
                    <p class="card-text"> <?php echo $portafolio['descripcion'];?> </p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php include("pie.php") ?>