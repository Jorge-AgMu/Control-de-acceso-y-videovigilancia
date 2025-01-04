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
            <title>DATOS</title>
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

                <h2 class="h2">DATOS</h2>

                <div class="">
                    <?php
                    $uid = $_SESSION["uid"];

                    $conn = connect();

                    $query = "SELECT nombre, apellido1, apellido2, usuario, uid, password FROM empleados WHERE uid = '$uid'";
                    $resultado = mysqli_query($conn, $query);
                    $fila = mysqli_fetch_assoc($resultado);

                    echo "
                    <br>
                    <h3>Nombre: ".$fila["nombre"]."</h3>"."<br>
                    <h3>Primer apellido: ".$fila["apellido1"]."</h3>"."<br>
                    <h3>Segundo apellido: ".$fila["apellido2"]."</h3>
                    "

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
            <title>DATOS</title>
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

                <h2 class="h2">DATOS</h2>

                <div class="">
                    <?php
                    $uid = $_SESSION["uid"];

                    $conn = connect();

                    $query = "SELECT nombre, apellido1, apellido2, usuario, uid, password FROM empleados WHERE uid = '$uid'";
                    $resultado = mysqli_query($conn, $query);
                    $fila = mysqli_fetch_assoc($resultado);

                    echo "
            <br>
            <h3>Nombre: ".$fila["nombre"]."</h3>"."<br>
            <h3>Primer apellido: ".$fila["apellido1"]."</h3>"."<br>
            <h3>Segundo apellido: ".$fila["apellido2"]."</h3>
             "

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
            <title>DATOS</title>
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

                <h2 class="h2">DATOS</h2>

                <div class="">
                    <?php
                    $uid = $_SESSION["uid"];

                    $conn = connect();

                    $query = "SELECT nombre, apellido1, apellido2, usuario, uid, password FROM empleados WHERE uid = '$uid'";
                    $resultado = mysqli_query($conn, $query);
                    $fila = mysqli_fetch_assoc($resultado);

                    echo "
            <br>
            <h3>Nombre: ".$fila["nombre"]."</h3>"."<br>
            <h3>Primer apellido: ".$fila["apellido1"]."</h3>"."<br>
            <h3>Segundo apellido: ".$fila["apellido2"]."</h3>
             "

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