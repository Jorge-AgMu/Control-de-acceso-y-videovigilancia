<?php
session_start();
if (isset($_SESSION["uid"])){
    header("location:validar.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
    <form action="validar.php" method="post">
        <h1>Iniciar sesión</h1>
        <input type="text" placeholder="Nombre de usuario" required name="user" id="user" pattern="[a-zA-Z0-9]+" title='Solo caracteres alfanumericos'>
        <input type="password" placeholder="Contraseña" required name="pass" id="pass">
        <?php
        if (isset($_COOKIE["error"])){
            $error = $_COOKIE["error"];
            if ($error == 1){
                echo "<p class='error'><strong>Usuario o contraseña incorrectos</strong></p>";
            }
            elseif ($error == 2){
                echo "<p class='error'><strong>¿Intentando cosas raras Alberto?</strong></p>";
            }
        }
        ?>
        <button type="submit">Iniciar sesión</button>
    </form>
</div>
</body>
</html>