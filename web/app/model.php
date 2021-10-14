<?php
require_once 'db.php';
/**
 * @var $db mysqli
 */

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
    WHERE DATE_INSERT >= DATE_ADD('$from', INTERVAL -3 HOUR)
    AND DATE_INSERT <= DATE_ADD('$to', INTERVAL -3 HOUR)
    ORDER BY ID $order";
    $result = $db->query($query);
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
