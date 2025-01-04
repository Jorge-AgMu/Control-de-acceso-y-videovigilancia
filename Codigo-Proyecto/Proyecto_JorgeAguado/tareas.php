<?php
require_once ("conf.php");
require_once ("conf_arduino.php");
session_start();
if (isset($_SESSION["uid"])){

    $uid = $_SESSION["uid"];

    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

if ($fila["id_rol"] == 1){
    disconnect($conn);
    DB::connect();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Iniciar sesión</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="css/box.css">
        <link rel="stylesheet" href="css/muroV1.css">
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
            <h4><a href="añadir_tarea.php">Añadir tarea</a></h4>
            <div class="tareas">
                <?php
                $uid = $_SESSION["uid"];

                $conn = connect();

                $query = "SELECT t.nombre, ta.descripcion, ta.fecha_fin, ta.id_tarea FROM tareas ta JOIN tipos_tareas t USING (id_tipo) JOIN empleados e USING (uid) WHERE uid = ?";
                $st = $conn->prepare($query);
                $st->bind_param("i", $uid);
                $st->execute();
                $st->bind_result($nombre,$descripcion ,$fecha, $idtarea);

                echo "<table>";

                if ($st->fetch()==null){
                    echo "No hay usuarios";
                }
                else{
                    $i=0;
                    do{
                        echo "
                                        <div class='tarea-g'>
                                            <h3>$nombre</h3>
                                            <p>$descripcion</p>
                                            <p>$fecha</p>
                                            <a href='tarea.php?idt=$idtarea'>Ver tarea</a>
                                        </div>
                                        ";
                    }while($st->fetch());
                    echo "</form></table>";
                }
                ?>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
}
elseif($fila["id_rol"] == 2){
    disconnect($conn);
   ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Iniciar sesión</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="css/box.css">
        <link rel="stylesheet" href="css/muroV1.css">
    </head>
    <body>
    <header class="header">
        <a href="muro.php"><div class="box-header">INICIO</div></a>
        <a href="datos.php"><div class="box-header">DATOS</div></a>
        <a href="tareas.php"><div class="box-header">TAREAS</div></a>
        <div class="sep2"></div>
        <a href="cerrar_sess.php"><div class="box-header-sb"><img src="icono/10.png" alt="" height="50px" width="50px"></div></a>
    </header>
    <div class="container">
        <div class="box-g">

            <h2 class="h2">TAREAS</h2>

            <div class="tareas">
                <?php
                $uid = $_SESSION["uid"];

                $conn = connect();

                $query = "SELECT t.nombre, ta.descripcion, ta.fecha_inicio, ta.id_tarea FROM tareas ta JOIN tipos_tareas t USING (id_tipo) JOIN empleados e USING (uid) WHERE uid = ?";
                $st = $conn->prepare($query);
                $st->bind_param("i", $uid);
                $st->execute();
                $st->bind_result($nombre,$descripcion ,$fecha, $idtarea);

                echo "<table>";

                if ($st->fetch()==null){
                    echo "No hay usuarios";
                }
                else{
                    $i=0;
                    do{
                        echo "
                                        <div class='tarea-g'>
                                            <h3>$nombre</h3>
                                            <p>$descripcion</p>
                                            <p>$fecha</p>
                                            <a href='tarea.php?idt=$idtarea'>Ver tarea</a>
                                        </div>
                                        ";
                    }while($st->fetch());
                    echo "</form></table>";
                }
                ?>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
}
elseif ($fila["id_rol"] == 3){
    disconnect($conn);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Iniciar sesión</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="css/box.css">
        <link rel="stylesheet" href="css/muroV1.css">
    </head>
    <body>
    <header class="header">
        <a href="muro.php"><div class="box-header">INICIO</div></a>
        <a href="datos.php"><div class="box-header">DATOS</div></a>
        <a href="tarea.php"><div class="box-header">TAREAS</div></a>
        <div class="sep3"></div>
        <a href="cerrar_sess.php"><div class="box-header-sb"><img src="icono/10.png" alt="" height="50px" width="50px"></div></a>
        <!-- <a href=""><div class="box-header-sb"><img src="icono/6.png" alt="" height="50px" width="50px"></div></a> -->
    </header>
    <div class="container">
        <div class="box-g">

            <h2 class="h2">TAREAS</h2>

            <div class="tareas">
                <?php
                $uid = $_SESSION["uid"];

                $conn = connect();

                $query = "SELECT t.nombre, ta.descripcion, ta.fecha_inicio, ta.id_tarea FROM tareas ta JOIN tipos_tareas t USING (id_tipo) JOIN empleados e USING (uid) WHERE uid = ?";
                $st = $conn->prepare($query);
                $st->bind_param("i", $uid);
                $st->execute();
                $st->bind_result($nombre,$descripcion ,$fecha, $idtarea);

                echo "<table>";

                if ($st->fetch()==null){
                    echo "No hay usuarios";
                }
                else{
                    $i=0;
                    do{
                        echo "
                                        <div class='tarea-g'>
                                            <h3>$nombre</h3>
                                            <p>$descripcion</p>
                                            <p>$fecha</p>
                                            <a href='tarea.php?idt=$idtarea'>Ver tarea</a>
                                        </div>
                                        ";
                    }while($st->fetch());
                    echo "</form></table>";
                }
                ?>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
}
}
else{
    header("location:index.php");
}
?>