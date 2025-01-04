<?php
require_once("../conf.php");
session_start();
if (isset($_SESSION["uid"])){

    $uid = $_SESSION["uid"];
    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    disconnect($conn);

    if ($fila["id_rol"]==1){

        $id = $_GET["val"];

        $conn = connect();

        $query = "SELECT uid,nombre, apellido1, apellido2, usuario, password FROM empleados WHERE uid = '$id'";
        $resultado = mysqli_query($conn, $query);
        $fila = mysqli_fetch_assoc($resultado);


        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Inicio</title>
            <link rel="stylesheet" href="logi.css">
        </head>
        <body>
        <header>
            <a href="mod_usu.php">Atras</a><a href="../Prueba_1/cerrar_sess.php">Cerrar sesión</a>
        </header>
        <div class="container">
            <div class="content">
                <h2>MODIFICAR USUARIO</h2>
                <form action="edit.php" method="POST">
                    <div class="form-group">
                        <label for="uid">UID:</label>
                        <input type="text" id="uid" name="uid" required value="<?=$fila['uid']?>">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nombre:</label>
                        <input type="text" id="nom" name="nom" required value="<?=$fila['nombre']?>">
                    </div>
                    <div class="form-group">
                        <label for="ap1">Apellido 1:</label>
                        <input type="text" id="ap1" name="ap1" required value="<?=$fila['apellido1']?>">
                    </div>
                    <div class="form-group">
                        <label for="ap2">Apellido 2:</label>
                        <input type="text" id="ap2" name="ap2" required value="<?=$fila['apellido2']?>">
                    </div>
                    <div class="form-group">
                        <label for="user">Usuario:</label>
                        <input type="text" id="user" name="user" required value="<?=$fila['usuario']?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Contraseña:</label>
                        <input type="password" id="pass" name="pass" required value="<?=$fila['password']?>">
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <select name="rol">
                            <option value="1">Administrador</option>
                            <option value="2">Vigilante</option>
                            <option value="3">Usuario</option>
                        </select>
                    </div>
                    <button>Enviar</button>
                </form>
            </div>
        </div>

        <footer>
            FOOTER
        </footer>
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