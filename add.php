<?php
require_once 'inc/headers.php';
require_once 'inc/functions.php';

$input = json_decode(file_get_contents('php://input'));
$description = filter_var($input->description,FILTER_SANITIZE_SPECIAL_CHARS);

try {
    $db = openDB();
    
    $query = $db->prepare('insert into shoppinglist(description) values (:description)');
    $query = $db->prepare('insert into shoppinglist(amout) values (:amount)');
    $query->bindValue(':description',$description, PDO::PARAM_STR);
    $query->bindValue(':amount',$amount, PDO::PARAM_STR);
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $db->lastInsertId(),'description' => $description, 'amount' => $amount);
    print json_encode($data);
} catch (PDOException $pdoex) {
   returnError($pdoex);
}