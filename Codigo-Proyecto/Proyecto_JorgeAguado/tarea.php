<?php
require_once ("conf.php");
require_once ("conf_arduino.php");
session_start();
if (isset($_SESSION["uid"])){

    $uid = $_SESSION["uid"];

    $idtarea = $_GET["idt"];



        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Iniciar sesión</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <link rel="stylesheet" href="css/muroV1.css">
            <link rel="stylesheet" href="css/box.css">
        </head>
        <body>
        <header class="header">
            <a href="muro.php"><div class="box-header">INICIO</div></a>
            <a href="datos.php"><div class="box-header">DATOS</div></a>
            <a href="tareas.php"><div class="box-header">TAREAS</div></a>
            <a href="control_usu/mod_usu.php"><div class="box-header">USUARIOS</div></a>
            <div class="sep1"></div>
            <a href="cerrar_sess.php"><div class="box-header-sb"><img src="icono/10.png" alt="" height="50px" width="50px"></div></a>
            <!-- <a href=""><div class="box-header-sb"><img src="icono/6.png" alt="" height="50px" width="50px"></div></a> -->
        </header>
        <div class="container">
            <div class="box-g">
                <h2 class="h2">TAREAS</h2>
                <h4><a href="del_tarea.php?id=<?=$idtarea?>">Borrar tarea</a></h4>
                <div>
                    <?php

                    $conn = connect();

                    $query = "SELECT t.nombre, ta.descripcion, ta.fecha_fin, e.id_rol FROM tareas ta JOIN tipos_tareas t USING (id_tipo) JOIN empleados e USING (uid) WHERE e.uid = ? AND ta.id_tarea = ?";
                    $st = $conn->prepare($query);
                    $st->bind_param("ii", $uid, $idtarea);
                    $st->execute();
                    $st->bind_result($nombre,$descripcion ,$fecha ,$id_rol);

                    echo "<table>";

                    if ($st->fetch()==null){
                        echo "No hay tareas para este usuarios";
                    }
                    else{
                        $i=0;
                            echo            "
                                            <h3>$nombre</h3>
                                            <p>$descripcion</p>
                                            <p>$fecha</p>
                                            ";
                        echo "</form></table>";
                    }
                    ?>
            </div>
                </div>
            </div>
        </div>
        </body>
        </html>
<?php
    }
    else{
        header("location:index");
    }
?>