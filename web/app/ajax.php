<?php
$order = 'ASC';
require_once('model.php');
$json = [];
foreach($data as $item) {
    $time = strtotime($item['DATE_INSERT'] . ' UTC +3') * 1000;
    $json[] = [
        $time,
        $item['MESSAGE'],
    ];
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);