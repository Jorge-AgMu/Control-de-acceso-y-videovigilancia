<?php
include ("conf_arduino.php");

if (isset($_POST)){
    $id = $_POST['id'];

    $myObj = (object)array();

    $conn = DB::connect();
    $sql = 'SELECT * FROM sensores WHERE id="' .$id. '"';

    foreach ($conn->query($sql) as $row) {

        $date = date_create($row['date']);
        $dateFormat = date_format($date,"d-m-Y");

        $myObj->id = $row['id'];
        $myObj->Sensor1 = $row['PIR_01'];
        $myObj->Sensor2 = $row['PIR_02'];
        $myObj->Sensor3 = $row['PIR_03'];
        $myObj->Sensor4 = $row['PIR_04'];
        $myObj->Hora = $row['time'];
        $myObj->Fecha = $dateFormat;

        $myJSON = json_encode($myObj);

        echo $myJSON;
    }
    DB::disconnect();
}
?>
