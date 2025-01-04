<?php
require_once("conf.php");
session_start();
if (isset($_SESSION["uid"])) {

    $uid = $_SESSION["uid"];
;
    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila["id_rol"] == 1) {

        $conn = connect();

        $id = $_GET["id"];

            $query = "DELETE FROM tareas WHERE id_tarea = ?";
            $st = $conn->prepare($query);
            $st->bind_param("i", $id);
            $st->execute();

            header("location:muro.php");

    }
    else{
        header("location:index");
    }
}
else{
    header("location:index");
}
?>