<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Accept, Content-Type, Access-Control-Allow-Headers');
header('Access-Control-Max-Age: 3600');
header('Content-Type: application/json');
require_once 'inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    return 0;
}

$input = json_decode(file_get_contents('php://input'));
$id = filter_var($input->id,FILTER_SANITIZE_SPECIAL_CHARS);

try {
    $db = openDB();
    
    $query = $db->prepare('delete from shoppinglist where id=(:id)');
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $id);
    print json_encode($data);
} catch (PDOException $pdoex) {
   returnError($pdoex);
}