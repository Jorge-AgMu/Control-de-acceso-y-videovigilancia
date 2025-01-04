<?php
require_once("../conf.php");
session_start();
unset($_SESSION["us"]);
if (isset($_SESSION["uid"])){

    $uid = $_SESSION["uid"];
    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila["id_rol"]==1){
        disconnect($conn);
?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Inicio</title>
            <link rel="stylesheet" href="estilos.css">
        </head>
        <body>
        <header>
            <a href="../muro.php">Atras</a><a href="../cerrar_sess.php">Cerrar sesión</a>
        </header>
        <div class="container">
            <div class="content-largo">

                    <div class="content-titulo">
                        <h2 class="titulo">Modificar usuarios</h2>
                    </div>
                    <div class="content-largo">
                        <a href="add_usu.php" class="button_add">Crear usuario</a>

                        <div class="container">
                            <?php

                            $conn = connect();

                            $query = "SELECT uid, nombre, apellido1, apellido2, usuario, id_rol FROM empleados";
                            $st = $conn->prepare($query);
                            $st->execute();
                            $st->bind_result($id,$nom, $ap1, $ap2, $usu, $id_rol);

                                echo "<table>";

                                if ($st->fetch()==null){
                                    echo "No hay usuarios";
                                }
                                else{
                                    echo "<thead><tr><th>Eliminar</th><th>Modificar</th><th>UID</th><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Usuario</th><th>Permiso</th></tr></thead>";
                                    do{
                                        if ($id_rol == 1){
                                            $id_rol = "Administrador";
                                        }
                                        elseif ($id_rol == 2){
                                            $id_rol = "Vigilante";
                                        }
                                        elseif ($id_rol == 3){
                                            $id_rol = "Usuario";
                                        }
                                        echo "<tbody><tr class='linea'><td><a href='eliminar.php?val=$id'><img src='../icono/7.png' alt='' width='25px' height='25px'></a></td><td><a href='edit_usu.php?val=$id'><img src='../icono/8.png' alt='' width='25px' height='25px'></a></td><td><h3>" .$id."</h3></td><td class='datos'><h3>".$nom."</h3></td><td class='datos'><h3>".$ap1."</h3></td><td class='datos'><h3>".$ap2."</h3></td><td class='datos'><h3>".$usu."</h3></td><td class='datos'><h3>".$id_rol."</h3></td></tr></tbody>";
                                    }while($st->fetch());
                                    echo "</form></table>";
                                }
                            ?>
                        </div>
                        <?php
                        if (isset($_COOKIE["error"])){
                            $error = $_COOKIE["error"];
                            if ($error == 2){
                                echo "<p class='error'>No se puede eliminar este usuario</p>";
                            }
                            elseif ($error == 3){
                                echo "<p class='error'>El usuario ya existe</p>";
                            }
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
       header("location:validar.php");
    }
}
else{
    header("location:validar.php");
}
?>