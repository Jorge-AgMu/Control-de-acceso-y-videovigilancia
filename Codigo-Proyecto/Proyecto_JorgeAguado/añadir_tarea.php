<?php
require_once("conf.php");
session_start();
if (isset($_SESSION["uid"])){

    $uid = $_SESSION["uid"];
    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila["id_rol"]==1){
        disconnect($conn);
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Inicio</title>
            <link rel="stylesheet" href="control_usu/logi.css">
        </head>
        <body>
        <header>
            <a href="muro.php">Atras</a>
        </header>
        <div class="container">
            <div class="content">
                <h2>AGREGAR TAREA</h2>
                <form action="add_tarea.php" method="POST">
                    <div class="form-group">
                        <label for="tipo">Personal asignado:</label>
                        <select name="tipo">
                            <?php
                            $conn = connect();

                            $query = "SELECT nombre, id_tipo FROM tipos_tareas";
                            $st = $conn->prepare($query);
                            $st->execute();
                            $st->bind_result($nombre, $tipo);

                            echo "<table>";

                            if ($st->fetch()==null){
                                echo "No hay tareas para este usuarios";
                            }
                            else{
                                $i=1;
                                do{
                                    echo "
                                        <option value='$tipo'>$nombre</option>
                                        ";
                                    $i++;
                                }while($st->fetch());
                                echo "</form></table>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="personal">Personal asignado:</label>
                        <select name="personal">
                            <?php
                            $conn = connect();

                            $query = "SELECT nombre, uid FROM empleados";
                            $st = $conn->prepare($query);
                            $st->execute();
                            $st->bind_result($nombre,$uid);

                            echo "<table>";

                            if ($st->fetch()==null){
                                echo "No hay tareas para este usuarios";
                            }
                            else{
                                $i=1;
                                do{
                                    echo "
                                        <option value='$uid'>$nombre</option>
                                        ";
                                    $i++;
                                }while($st->fetch());
                                echo "</form></table>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ap2">Descripción</label>
                        <input type="text" id="desc" name="desc" required>
                    </div>
                    <div class="form-group">
                        <label for="user">Fecha inicio:</label>
                        <input type="datetime-local" id="fi" name="fi" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Fecha fin:</label>
                        <input type="datetime-local" id="ff" name="ff" required>
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