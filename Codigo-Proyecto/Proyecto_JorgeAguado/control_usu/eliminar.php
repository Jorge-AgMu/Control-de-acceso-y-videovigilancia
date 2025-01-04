<?php
require_once("../conf.php");
session_start();
if (isset($_SESSION["uid"])) {

        $uid = $_SESSION["uid"];
    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila["id_rol"]==1){


            $id = $_GET["val"];

            $conn = connect();

            $query = "SELECT nombre FROM empleados WHERE uid = '$id'";
            $resultado = mysqli_query($conn, $query);
            $fila = mysqli_fetch_assoc($resultado);

            ?> <!DOCTYPE html>
<html>
<head>
    <title>Muro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body style="height: 98.25vh;">
<header>
    <a href="mod_usu.php">Atras</a>
</header>
<div class="container">
    <div class="content-largo">

        <div class="content-titulo">
            <h2 class="titulo">¿Quieres borrar el usuario <?=$fila["nombre"] ?>?</h2>
        </div>
        <div class="content-largo">
            <div class="container">
                <div class="content-corto-2">
                    <a href='del.php?va=<?=$id?>'>
                    <div class="content-titulo">
                       <h2 class="titulo">SI</h2>
                    </div>
                </div>
                </a>
                <div class="content-corto-2">
                    <a href='mod_usu.php'>
                    <div class="content-titulo">
                        <h2 class="titulo">NO</h2>
                    </div>
                    </a>
            </div>
            </div>
        </div>
    </div>
</div>
<footer> </footer>
</body>
</html>
<?php
            disconnect($conn);
    }else{
        header("location:index");
    }
}
?>