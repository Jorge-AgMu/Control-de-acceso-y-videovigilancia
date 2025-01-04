<?php
require_once("../conf.php");
session_start();
if (isset($_SESSION["uid"])){

    $uid = $_SESSION["uid"];
    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila["id_rol"]==1){
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
            <a href="mod_usu.php">Atras</a>
        </header>
        <div class="container">
            <div class="content">
                <h2>AGREGAR NUEVO USUARIO</h2>
                <form action="add.php" method="POST">
                    <div class="form-group">
                        <label for="nom">Nombre:</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="ap1">Apellido 1:</label>
                        <input type="text" id="ap1" name="ap1" required>
                    </div>
                    <div class="form-group">
                        <label for="ap2">Apellido 2:</label>
                        <input type="text" id="ap2" name="ap2" required>
                    </div>
                    <div class="form-group">
                        <label for="user">Usuario:</label>
                        <input type="text" id="user" name="user" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Contraseña:</label>
                        <input type="password" id="pass" name="pass" required>
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