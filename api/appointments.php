<?php
header("Content-Type: application/json");
require_once('db_connect.php');

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

switch($method){
    case 'GET':
        if($id){
            $res = mysqli_query($conn,"SELECT * FROM appointments WHERE id=$id");
            echo json_encode(mysqli_fetch_assoc($res));
        } else {
            $res = mysqli_query($conn,"SELECT * FROM appointments");
            echo json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $client_id = intval($data['client_id']);
        $date = mysqli_real_escape_string($conn, $data['date']);
        $time = mysqli_real_escape_string($conn, $data['time']);
        $location = mysqli_real_escape_string($conn, $data['location']);
        mysqli_query($conn,"INSERT INTO appointments(client_id,date,time,location) VALUES($client_id,'$date','$time','$location')");
        echo json_encode(['message'=>'Appointment added']);
        break;

    case 'PUT':
        if(!$id){ http_response_code(400); exit; }
        $data = json_decode(file_get_contents("php://input"), true);
        $client_id = intval($data['client_id']);
        $date = mysqli_real_escape_string($conn, $data['date']);
        $time = mysqli_real_escape_string($conn, $data['time']);
        $location = mysqli_real_escape_string($conn, $data['location']);
        mysqli_query($conn,"UPDATE appointments SET client_id=$client_id, date='$date', time='$time', location='$location' WHERE id=$id");
        echo json_encode(['message'=>'Appointment updated']);
        break;

    case 'DELETE':
        if(!$id){ http_response_code(400); exit; }
        mysqli_query($conn,"DELETE FROM appointments WHERE id=$id");
        echo json_encode(['message'=>'Appointment deleted']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['message'=>'Method Not Allowed']);
}
?>
