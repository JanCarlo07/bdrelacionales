<?php

$host = 'localhost';
$user = 'root';
$pass ='';
$dbname = 'deportes';

//Crear conexón
$conn = new mysqli($host, $user, $pass, $dbname);

//verificar conexión
if($conn->connect_error){
    http_response_code(500);
    echo json_encode(['error'=> 'Error de conexion:', $conn->connect_error]);
    exit;
} 


    //consulta mysql
    $sql ="SELECT * FROM deportes";
    $result = $conn->query($sql);

    $Deportes=[];

    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $Deportes[] = $row;
        }
    }

    $conn->close();

    header("Content-Type: application/json");
    echo json_encode($deportes);
?>