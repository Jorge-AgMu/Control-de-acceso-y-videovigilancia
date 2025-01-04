<?php
require_once ("conf.php");
session_start();
unset($_SESSION["us"]);
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
            <link rel="stylesheet" href="control_usu/estilos.css">
        </head>
        <body>
        <header>
            <a href="muro.php">Atras</a>
        </header>
        <div class="container">
            <div class="content-largo">
                <h3>REGISTRO</h3>
                    <div class="container">

                        <table id= "table_id">
                            <thead>
                            <tr>
                                <th>Nº</th>
                                <th>ID</th>
                                <th>PIR_01</th>
                                <th>PIR_02</th>
                                <th>PIR_03</th>
                                <th>PIR_04</th>
                                <th>Hora</th>
                                <th>Fecha (dd-mm-yyyy)</th>
                            </tr>
                            </thead>
                            <tbody id="tbody_table_record">
                            <?php
                            include 'conf_arduino.php';
                            $num = 0;
                            $pdo = DB::connect();
                            $sql = 'SELECT * FROM registro ORDER BY date, time';
                            foreach ($pdo->query($sql) as $row) {
                                $date = date_create($row['date']);
                                $dateFormat = date_format($date,"d-m-Y");
                                $num++;
                                echo '<tr>';
                                echo '<td>'. $num . '</td>';
                                echo '<td class="bdr">'. $row['id'] . '</td>';
                                echo '<td class="bdr">'. $row['PIR_01'] . '</td>';
                                echo '<td class="bdr">'. $row['PIR_02'] . '</td>';
                                echo '<td class="bdr">'. $row['PIR_03'] . '</td>';
                                echo '<td class="bdr">'. $row['PIR_04'] . '</td>';
                                echo '<td class="bdr">'. $row['time'] . '</td>';
                                echo '<td>'. $dateFormat . '</td>';
                                echo '</tr>';
                            }
                            DB::disconnect();
                            //------------------------------------------------------------
                            ?>
                            </tbody>
                        </table>

                        <br>

                        <br>
                </div>
                <div class="btn-group">
                    <button class="button" id="btn_prev" onclick="prevPage()">Anterior</button>
                    <button class="button" id="btn_next" onclick="nextPage()">Siguiente</button>
                    <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; float: center; margin-left: 2px;;">
                        <p style="position:relative; font-size: 14px;"> Numero de tabla : <span id="page"></span></p>
                    </div>
                    <select name="number_of_rows" id="number_of_rows">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <button class="button" id="btn_apply" onclick="apply_Number_of_Rows()">Apply</button>
                </div>
            </div>
        </div>
        </div>
        <script>

            var current_page = 1;
            var records_per_page = 10;
            var l = document.getElementById("table_id").rows.length

            function apply_Number_of_Rows() {
                var x = document.getElementById("number_of_rows").value;
                records_per_page = x;
                changePage(current_page);
            }

            function prevPage() {
                if (current_page > 1) {
                    current_page--;
                    changePage(current_page);
                }
            }

            function nextPage() {
                if (current_page < numPages()) {
                    current_page++;
                    changePage(current_page);
                }
            }

            function changePage(page) {
                var btn_next = document.getElementById("btn_next");
                var btn_prev = document.getElementById("btn_prev");
                var listing_table = document.getElementById("table_id");
                var page_span = document.getElementById("page");

                if (page < 1) page = 1;
                if (page > numPages()) page = numPages();

                [...listing_table.getElementsByTagName('tr')].forEach((tr)=>{
                    tr.style.display='none'; // reset all to not display
                });
                listing_table.rows[0].style.display = ""; // display the title row

                for (var i = (page-1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
                    if (listing_table.rows[i]) {
                        listing_table.rows[i].style.display = ""
                    } else {
                        continue;
                    }
                }

                page_span.innerHTML = page + "/" + numPages() + " (Total de filas = " + (l-1) + ") | Numero de filas : ";

                if (page == 0 && numPages() == 0) {
                    btn_prev.disabled = true;
                    btn_next.disabled = true;
                    return;
                }

                if (page == 1) {
                    btn_prev.disabled = true;
                } else {
                    btn_prev.disabled = false;
                }

                if (page == numPages()) {
                    btn_next.disabled = true;
                } else {
                    btn_next.disabled = false;
                }
            }

            function numPages() {
                return Math.ceil((l - 1) / records_per_page);
            }

            window.onload = function() {
                var x = document.getElementById("number_of_rows").value;
                records_per_page = x;
                changePage(current_page);
            };

        </script>
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