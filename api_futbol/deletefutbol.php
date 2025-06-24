<?php
    header("Content-Type:  application/json");

    if($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
        http_response_code(405);
        echo json_encode(['error' =>'Solo metodo DELETE es permitido']);
    }

    //conectar a la BD sakila
    require 'conexionfutbol.php';

    $input = json_decode(file_get_contents('php://input'), true);
    $deportes = intval($input["deportes"]);

    $query = "DELETE FROM deportes WHERE deportes = ?";

    $st = $conn->prepare($query);
    if(!$st){
        http_response_code(500);
        echo json_encode(["error" => "Ocurrio un error en la consulta" , $conn->error()]);
        exit();
    }
    $st->bind_param("i", $deportes);
    $st->execute();

    if($st->affected_rows > 0){
        echo json_encode(["mensaje" => "deportes eliminado con exito"]);
    }else {
        http_response_code(500);
         echo json_encode(["error" => "No se encontro el deporte con ID $deportes"]);
    }
    $st->close();
    $conn->close();
    ?>