<?php include("cabecera.php") ?>
<?php include("conexion.php") ?>
<?php
    if ($_POST) {
        $nombre=$_POST['nombre'];
        $descripcion=$_POST['descripcion'];
        $fecha=new DateTime();
        $imagen=$fecha->getTimestamp()."_".$_FILES['archivo']['name'];
        $imagenTemporal=$_FILES['archivo']['tmp_name'];
        move_uploaded_file($imagenTemporal,"images/".$imagen);
        $con1=new Conexion();
        $sql="INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
        $con1->ejecutar($sql);   
    }
    if ($_GET) {
        $id=$_GET['borrar'];
        $con3=new Conexion();
        $imagenABuscar="SELECT `imagen` FROM `proyectos` WHERE `proyectos`.`id` = $id";
        $imagenABorrar=$con3->consultar($imagenABuscar);
        unlink("images/".$imagenABorrar[0]['imagen']);
        
        $sql="DELETE FROM proyectos WHERE `proyectos`.`id` = $id";
        $con3->ejecutar($sql);
    }
    $con2=new Conexion();
    $portafolios= $con2->consultar("SELECT * FROM `proyectos`");
    // print_r($portafolios);
?>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Datos del proyecto
                    </div>
                    <div class="card-body">
                        <form action="portafolio.php" method="post" enctype="multipart/form-data">
                            <label for="nombre">Nombre del proyecto: </label>
                            <input require class="form-control" type="text" name="nombre" id="nombre">
                            <br>
                            <label for="archivo">Imagen del proyecto: </label>
                            <input require class="form-control" type="file" name="archivo" id="archivo">
                            <br>
                            <label for="descripcion">Descripcion</label>
                            <textarea require class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                            <br>
                            <input class="btn btn-success" type="submit" value="Enviar datos">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($portafolios as $portafolio){ ?>
                        <tr>
                            <td> <?php echo $portafolio['id'];?> </td>
                            <td> <?php echo $portafolio['nombre'];?></td>
                            <td> <img width="100px" src="<?php echo 'images/'.$portafolio['imagen'];?>" alt=""> </td>
                            <td> <?php echo $portafolio['descripcion'];?></td>
                            <td> <a name="" id="" class="btn btn-danger" href="?borrar=<?php echo $portafolio['id']; ?>" >Eliminar</a> </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
<?php include("pie.php") ?>