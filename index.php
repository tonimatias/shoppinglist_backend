<?php
require_once 'inc/headers.php';
require_once 'inc/functions.php';

try {
    $db = openDB();
    $sql = "select * from item";
    $query = $db->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    print json_encode($results);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}