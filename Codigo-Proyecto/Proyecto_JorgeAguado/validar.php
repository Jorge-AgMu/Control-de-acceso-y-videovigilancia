<?php
require_once("conf.php");
session_start();
if (
    isset($_POST["user"]) && isset($_POST["pass"]) &&
    strlen(trim($_POST["user"])>0) &&
    strlen(trim($_POST["pass"])>0)
){
    $user = htmlspecialchars($_POST["user"]);
    $pass = $_POST["pass"];

    $conn = connect();

    $query = "SELECT uid, usuario, password FROM empleados WHERE usuario = '$user'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    $a = password_verify($pass, $fila["password"]);

    if ($user == $fila["usuario"] AND $a == 1){
        $_SESSION["user"] = $fila["usuario"];
        $_SESSION["uid"] = $fila["uid"];
        disconnect($conn);
        header("location:muro.php");
    }
    else{
        $error = 1;
        setcookie("error",$error,time()+1);
        header("location:index.php");
    }

}
elseif (
    isset($_SESSION["uid"])
){
    $conn = connect();

    $uid = $_SESSION["uid"];

    $query = "SELECT count(uid) FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);


    if ($fila["count(uid)"] == 1){
        disconnect($conn);
        header("location:muro.php");
    }
    else{
       header("location:index.php");
    }
}
else{
    $error = 2;
    setcookie("error",$error,time()+1);
    header("location:index.php");
}
?>