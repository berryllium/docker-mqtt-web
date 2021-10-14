<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('error_reporting', 1);

$db = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'), getenv('DB_PORT'));

$res = $db->query('SELECT * FROM test');

$data = [];
$tables = [];
$result = $db->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME LIKE 'test_%';");
if($result) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row['TABLE_NAME'];
    }
}

$order = $order ?? 'DESC';

if($current_topic = $_GET['topic']) {
    $from = gmdate('Y-m-d H:i:s', strtotime($_GET['from']));
    $to = gmdate('Y-m-d H:i:s', strtotime($_GET['to']));
    if(!$from) $from = gmdate('Y-m-d H:i:s', time());
    if(!$from) $from = gmdate('Y-m-d H:i:s', time() - 600);
    $query = "SELECT ID, MESSAGE, DATE_ADD(DATE_INSERT, INTERVAL 3 HOUR) AS DATE_INSERT
    FROM $current_topic
    WHERE DATE_INSERT >= '$from'
    AND DATE_INSERT <= '$to'
    ORDER BY ID $order";
    $result = $db->query($query);
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
