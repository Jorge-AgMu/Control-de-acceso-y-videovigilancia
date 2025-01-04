<?php
require_once("../conf.php");
session_start();
if (isset($_SESSION["uid"])) {

    $id = $_SESSION["uid"];
    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$id'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    disconnect($conn);

    if ($fila["id_rol"] == 1) {

        $uid = $_POST["uid"];
        $nom = htmlspecialchars($_POST["nom"]);
        $ap1 = htmlspecialchars($_POST["ap1"]);
        $ap2 = htmlspecialchars($_POST["ap2"]);
        $user = htmlspecialchars($_POST["user"]);
        $pass = htmlspecialchars($_POST["pass"]);
        $rol = htmlspecialchars($_POST["rol"]);


        $conn = connect();

        $query = "UPDATE empleados SET uid = ?, nombre = ?, usuario = ?, password = ?, apellido1 = ?, apellido2 = ?, id_rol = ? WHERE uid = ?";
        $st = $conn->prepare($query);
        $st->bind_param("isssssii", $uid, $nom, $user, $pass, $ap1, $ap2, $rol, $uid );
        $st->execute();
        $st->close();
        disconnect($conn);
        unset($_SESSION["us"]);
        header("location:mod_usu.php");

    } else {
        header("location:sensores.php");
    }
}
else {
        header("location:sensores.php");
    }
?>