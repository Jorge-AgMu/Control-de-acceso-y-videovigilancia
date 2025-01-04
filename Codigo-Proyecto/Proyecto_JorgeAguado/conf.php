<?php
error_reporting(E_ALL);
function connect(){

    $host = 'localhost';
    $db = 'proyecto';
    $user = 'root';
    $password = '';
    $conn = mysqli_connect($host, $user, $password, $db);

    if (!$conn){
        echo "<br>"."Error, no se pudo establecer conexion con la base de datos, intentelo más tarde";
    }

    return $conn;
}

function disconnect($conn){
    if ($conn){
        $close = mysqli_close($conn);
        if ($close){

        }
        else{
            echo"<br>"."Error al cerrar la base de datos";
        }
    }
    else{
        echo"<br>"."Sin base de datos abierta";
    }
}
?>