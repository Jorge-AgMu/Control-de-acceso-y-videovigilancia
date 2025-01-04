<?php
require_once ("conf.php");
require_once ("conf_arduino.php");
session_start();
if (isset($_SESSION["uid"])){

    $uid = $_SESSION["uid"];

    $conn = connect();

    $query = "SELECT id_rol FROM empleados WHERE uid = '$uid'";
    $resultado = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($resultado);

if ($fila["id_rol"] == 1){
    disconnect($conn);
    DB::connect();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>MURO</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="css/muroV1.css">
    </head>
    <body>
    <header class="header">
        <a href="muro.php"><div class="box-header">INICIO</div></a>
        <a href="datos.php"><div class="box-header">DATOS</div></a>
        <a href="tareas.php"><div class="box-header">TAREAS</div></a>
        <a href="registro.php"><div class="box-header">REGISTRO</div></a>
        <a href="control_usu/mod_usu.php"><div class="box-header">USUARIOS</div></a>
        <div class="sep1"></div>
        <a href="cerrar_sess.php"><div class="box-header-sb"><img src="icono/10.png" alt="" height="50px" width="50px"></div></a>
        <!-- <a href=""><div class="box-header-sb"><img src="icono/6.png" alt="" height="50px" width="50px"></div></a> -->
    </header>
    <div class="container">
        <div class="box">
            <h2 class="h2">CONTROL DEL SISTEMA</h2>
            <div class="tareas">
                <div class="tarea">
                    <h4>SENSOR 01:</h4>

                    <div class="sensor">
                        <span><span id="pir01">
                            </span></span>
                    </div>
                </div>

                <div class="tarea">
                    <h4>SENSOR 02:</h4>

                    <div class="sensor">
                        <span ><span id="pir02">
                            </span></span>
                    </div>
                </div>

                <div class="tarea">
                    <h4>SENSOR 03:</h4>

                    <div class="sensor">
                        <span><span id="pir03">
                            </span></span>
                    </div>
                </div>

                <div class="tarea">
                    <h4>SENSOR 04:</h4>

                    <div class="sensor">
                        <span><span id="pir04">
                            </span></span>
                    </div>
                </div>

                <h3 style="font-size: 0.7rem;">ULTIMA CONEXION CON LA ESP32 [ <span id="FH"></span> ]</h3>
            </div>
            <script>

                document.getElementById("pir01").innerHTML = "NN";
                document.getElementById("pir02").innerHTML = "NN";
                document.getElementById("pir03").innerHTML = "NN";
                document.getElementById("pir04").innerHTML = "NN";
                document.getElementById("FH").innerHTML = "NN";

                Get_Data("esp32_01");

                setInterval(myTimer, 5000);

                function myTimer() {
                    Get_Data("esp32_01");
                }

                function Get_Data(id) {
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            const myObj = JSON.parse(this.responseText);
                            if (myObj.id == "esp32_01") {
                                document.getElementById("pir01").innerHTML = myObj.Sensor1
                                document.getElementById("pir02").innerHTML = myObj.Sensor2
                                document.getElementById("pir03").innerHTML = myObj.Sensor3
                                document.getElementById("pir04").innerHTML = myObj.Sensor4
                                document.getElementById("FH").innerHTML = "Hora : " + myObj.Hora + " | Fecha : " + myObj.Fecha;

                            }
                        }
                    }
                    xmlhttp.open("POST","sensores.php",true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id="+id);

                }

            </script>
            <?php
                DB::disconnect();
            ?>
        </div>

        <div class="box">

                <h2 class="h2">TAREAS</h2>

            <div class="tareas">

                <?php
                $uid = $_SESSION["uid"];

                $conn = connect();

                $query = "SELECT t.nombre, ta.descripcion, ta.fecha_fin, ta.id_tarea FROM tareas ta JOIN tipos_tareas t USING (id_tipo) JOIN empleados e USING (uid) WHERE uid = ?";
                $st = $conn->prepare($query);
                $st->bind_param("i", $uid);
                $st->execute();
                $st->bind_result($nombre,$descripcion ,$fecha, $idtarea);

                echo "<table>";

                if ($st->fetch()==null){
                    echo "No hay usuarios";
                }
                else{
                    $i=0;
                    do{
                        echo "
                                        <div class='tarea'>
                                            <h3>$nombre</h3>
                                            <p>$descripcion</p>
                                            <p>$fecha</p>
                                            <a href='tarea.php?idt=$idtarea'>Ver tarea</a>
                                        </div>
                                        ";
                    }while($st->fetch());
                    echo "</form></table>";
                }
                ?>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
}
elseif($fila["id_rol"] == 2){
    disconnect($conn);
   ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>MURO</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="css/muroV1.css">
    </head>
    <body>
    <header class="header">
        <a href="muro.php"><div class="box-header">INICIO</div></a>
        <a href="datos.php"><div class="box-header">DATOS</div></a>
        <a href="tareas.php"><div class="box-header">TAREAS</div></a>
        <div class="sep2"></div>
        <a href="cerrar_sess.php"><div class="box-header-sb"><img src="icono/10.png" alt="" height="50px" width="50px"></div></a>
        <!-- <a href=""><div class="box-header-sb"><img src="icono/6.png" alt="" height="50px" width="50px"></div></a> -->
    </header>
    <div class="container">
        <div class="box">
            <h2 class="h2">CONTROL DEL SISTEMA</h2>
            <div class="tareas">
                <div class="tarea">
                    <h4>SENSOR 01:</h4>

                    <div class="sensor">
                        <span><span id="pir01">
                            </span></span>
                    </div>
                </div>

                <div class="tarea">
                    <h4>SENSOR 02:</h4>

                    <div class="sensor">
                        <span ><span id="pir02">
                            </span></span>
                    </div>
                </div>

                <div class="tarea">
                    <h4>SENSOR 03:</h4>

                    <div class="sensor">
                        <span><span id="pir03">
                            </span></span>
                    </div>
                </div>

                <div class="tarea">
                    <h4>SENSOR 04:</h4>

                    <div class="sensor">
                        <span><span id="pir04">
                            </span></span>
                    </div>
                </div>

                <h3 style="font-size: 0.7rem;">ULTIMA CONEXION CON LA ESP32 [ <span id="FH"></span> ]</h3>
            </div>
            <script>

                document.getElementById("pir01").innerHTML = "NN";
                document.getElementById("pir02").innerHTML = "NN";
                document.getElementById("pir03").innerHTML = "NN";
                document.getElementById("pir04").innerHTML = "NN";
                document.getElementById("FH").innerHTML = "NN";

                Get_Data("esp32_01");

                setInterval(myTimer, 5000);

                function myTimer() {
                    Get_Data("esp32_01");
                }

                function Get_Data(id) {
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            const myObj = JSON.parse(this.responseText);
                            if (myObj.id == "esp32_01") {
                                document.getElementById("pir01").innerHTML = myObj.Sensor1
                                document.getElementById("pir02").innerHTML = myObj.Sensor2
                                document.getElementById("pir03").innerHTML = myObj.Sensor3
                                document.getElementById("pir04").innerHTML = myObj.Sensor4
                                document.getElementById("FH").innerHTML = "Hora : " + myObj.Hora + " | Fecha : " + myObj.Fecha;

                            }
                        }
                    }
                    xmlhttp.open("POST","sensores.php",true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id="+id);

                }

            </script>
            <?php
            DB::disconnect();
            ?>
        </div>

        <div class="box">

            <h2 class="h2">TAREAS</h2>

            <div class="tareas">

                <?php
                $uid = $_SESSION["uid"];

                $conn = connect();

                $query = "SELECT t.nombre, ta.descripcion, ta.fecha_fin, ta.id_tarea FROM tareas ta JOIN tipos_tareas t USING (id_tipo) JOIN empleados e USING (uid) WHERE uid = ?";
                $st = $conn->prepare($query);
                $st->bind_param("i", $uid);
                $st->execute();
                $st->bind_result($nombre,$descripcion ,$fecha, $idtarea);

                echo "<table>";

                if ($st->fetch()==null){
                    echo "No hay tareas para este usuarios";
                }
                else{
                    $i=0;
                    do{
                        echo "
                                        <div class='tarea'>
                                            <h3>$nombre</h3>
                                            <p>$descripcion</p>
                                            <p>$fecha</p>
                                            <a href='tarea.php?idt=$idtarea'>Ver tarea</a>
                                        </div>
                                        ";
                    }while($st->fetch());
                    echo "</form></table>";
                }
                ?>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
}
elseif ($fila["id_rol"] == 3){
    disconnect($conn);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>MURO</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="css/muroV1.css">
    </head>
    <body>
    <header class="header">
        <a href="muro.php"><div class="box-header">INICIO</div></a>
        <a href="datos.php"><div class="box-header">DATOS</div></a>
        <a href="tareas.php"><div class="box-header">TAREAS</div></a>
        <div class="sep3"></div>
        <a href="cerrar_sess.php"><div class="box-header-sb"><img src="icono/10.png" alt="" height="50px" width="50px"></div></a>
        <!-- <a href=""><div class="box-header-sb"><img src="icono/6.png" alt="" height="50px" width="50px"></div></a> -->
    </header>
    <div class="container">
        <div class="box">
            <h2 class="h2">DATOS</h2>
            <?php
            $uid = $_SESSION["uid"];

            $conn = connect();

            $query = "SELECT nombre, apellido1, apellido2, usuario, uid, password FROM empleados WHERE uid = '$uid'";
            $resultado = mysqli_query($conn, $query);
            $fila = mysqli_fetch_assoc($resultado);

            echo "
            <br>
            <h3>Nombre: ".$fila["nombre"]."</h3>"."<br>
            <h3>Primer apellido: ".$fila["apellido1"]."</h3>"."<br>
            <h3>Segundo apellido: ".$fila["apellido2"]."</h3>
             "

            ?>
        </div>

        <div class="box">
            <h2 class="h2">TAREAS</h2>
            <?php
            $uid = $_SESSION["uid"];

            $conn = connect();

            $query = "SELECT t.nombre, ta.descripcion, ta.fecha_fin, ta.id_tarea FROM tareas ta JOIN tipos_tareas t USING (id_tipo) JOIN empleados e USING (uid) WHERE uid = ?";
            $st = $conn->prepare($query);
            $st->bind_param("i", $uid);
            $st->execute();
            $st->bind_result($nombre,$descripcion ,$fecha, $idtarea);

            echo "<table>";

            if ($st->fetch()==null){
                echo "No hay tareas para este usuarios";
            }
            else{
                $i=0;
                do{
                    echo "
                                        <div class='tarea'>
                                            <h3>$nombre</h3>
                                            <p>$descripcion</p>
                                            <p>$fecha</p>
                                            <a href='tarea.php?idt=$idtarea'>Ver tarea</a>
                                        </div>
                                        ";
                }while($st->fetch());
                echo "</form></table>";
            }
            ?>
        </div>
    </div>
    </body>
    </html>
<?php
}
}
else{
    header("location:index.php");
}
?>