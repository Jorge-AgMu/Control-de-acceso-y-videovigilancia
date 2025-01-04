<?php
require_once("conf.php");
session_start();
if (isset($_SESSION["uid"])) {

    $uid = $_SESSION["uid"];
    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila["id_rol"] == 1) {
        disconnect($conn);

        $conn = connect();
        $tipo = $_POST["tipo"];
        $personal = $_POST["personal"];
        $desc = $_POST["desc"];
        $fi = ($_POST["fi"]);
        $ff = ($_POST["ff"]);

        $conn = connect();

        $query = "INSERT INTO tareas VALUES (null,?,?,?,?,?)";
        $st = $conn->prepare($query);
        $st->bind_param("sssss"  ,$tipo, $personal, $desc, $fi, $ff);
        $st->execute();
        $st->close();
        disconnect($conn);

        header("location:muro.php");

    } else {
        header("location:index");
    }
}
?>
