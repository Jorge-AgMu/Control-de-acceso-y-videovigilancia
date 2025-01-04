<?php
require_once("../conf.php");
session_start();
if (isset($_SESSION["uid"])) {

    $uid = $_SESSION["uid"];
    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila["id_rol"] == 1) {


        $conn = connect();

        $id = $_GET["va"];

        if ($id == 1) {
            $error = 2;
            setcookie("error", $error, time() + 1);
            header("location:mod_usu.php");
        } else {
            $query = "DELETE FROM empleados WHERE uid = ?";
            $st = $conn->prepare($query);
            $st->bind_param("i", $id);
            $st->execute();

            header("location:mod_usu.php");
        }
    }
    else{
    header("location:index");
}
}
?>

