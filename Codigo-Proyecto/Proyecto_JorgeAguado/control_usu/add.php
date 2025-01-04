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
        $nom = htmlspecialchars($_POST["nom"]);
        $ap1 = htmlspecialchars($_POST["ap1"]);
        $ap2 = htmlspecialchars($_POST["ap2"]);
        $user = htmlspecialchars($_POST["user"]);
        $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
        $rol = htmlspecialchars($_POST["rol"]);

        $conn = connect();

        $query = "INSERT INTO empleados VALUES (null,?,?,?,?,?,?)";
        $st = $conn->prepare($query);
        $st->bind_param("sssssi",  $nom, $user, $pass, $ap1, $ap2,  $rol);
        $st->execute();
        $st->close();
        disconnect($conn);


        header("location:mod_usu.php");

    } else {
        header("location:index");
    }
}
?>
