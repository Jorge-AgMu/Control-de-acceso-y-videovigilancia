<?php
require ("conf_arduino.php");

if (isset($_POST)) {
    //........................................ keep track POST values
    $id = $_POST['id'];
    $pir_01 = $_POST['pir_01'];
    $pir_02 = $_POST['pir_02'];
    $pir_03 = $_POST['pir_03'];
    $pir_04 = $_POST['pir_04'];

    //........................................

    //........................................ Get the time and date.
    date_default_timezone_set("Europe/Copenhagen"); // Look here for your timezone : https://www.php.net/manual/en/timezones.php
    $tm = date("H:i:s");
    $dt = date("Y-m-d");
    //........................................

    //........................................ Updating the data in the table.
    $pdo = DB::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE sensores SET id = ?,PIR_01 = ?, PIR_02 = ?, PIR_03 = ?, PIR_04 = ? ,time = ?, date = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id, $pir_01, $pir_02, $pir_03, $pir_04, $tm, $dt, $id));
    DB::disconnect();
    //........................................

    if ($_POST["pir_01"]  == "Movimiento detectado" or $_POST["pir_0"]  == "Movimiento detectado" or $_POST["pir_03"]  == "Movimiento detectado" or $_POST["pir_04"]  == "Movimiento detectado"){
        $pdo = DB::connect();

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO registro (PIR_01,PIR_02,PIR_03,PIR_04,time,date) values(?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($pir_01,$pir_02,$pir_03,$pir_04,$tm,$dt));

        Database::disconnect();
    }

}


?>