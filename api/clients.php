<?php
header("Content-Type: application/json");
require_once('db_connect.php');

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

switch($method){
    case 'GET':
        if($id){
            $res = mysqli_query($conn,"SELECT * FROM clients WHERE id=$id");
            echo json_encode(mysqli_fetch_assoc($res));
        } else {
            $res = mysqli_query($conn,"SELECT * FROM clients");
            echo json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $name = mysqli_real_escape_string($conn, $data['name']);
        $email = mysqli_real_escape_string($conn, $data['email']);
        $phone = mysqli_real_escape_string($conn, $data['phone']);
        mysqli_query($conn,"INSERT INTO clients(name,email,phone) VALUES('$name','$email','$phone')");
        echo json_encode(['message'=>'Client added']);
        break;

    case 'PUT':
        if(!$id){ http_response_code(400); exit; }
        $data = json_decode(file_get_contents("php://input"), true);
        $name = mysqli_real_escape_string($conn, $data['name']);
        $email = mysqli_real_escape_string($conn, $data['email']);
        $phone = mysqli_real_escape_string($conn, $data['phone']);
        mysqli_query($conn,"UPDATE clients SET name='$name', email='$email', phone='$phone' WHERE id=$id");
        echo json_encode(['message'=>'Client updated']);
        break;

    case 'DELETE':
        if(!$id){ http_response_code(400); exit; }
        mysqli_query($conn,"DELETE FROM clients WHERE id=$id");
        echo json_encode(['message'=>'Client deleted']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['message'=>'Method Not Allowed']);
}
?>
