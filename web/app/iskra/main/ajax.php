<?php
/**
 * @var $db mysqli
 */
require_once $_SERVER['DOCUMENT_ROOT']. '/db.php';

$tables = ['test_iscra__cur1', 'test_iscra__pusk1', 'test_iscra__pusk2', 'test_iscra__pusk3'];

foreach ($tables as $table) {
    $res = $db->query("SELECT * FROM $table ORDER BY ID DESC LIMIT 1");
    $data = $res->fetch_assoc();
    $name = str_replace('test_iscra__', '', $table);
    $result[$name]['val'] = $data['MESSAGE'];
    $result[$name]['date'] = $data['DATE_INSERT'];
}

die(json_encode($result, JSON_UNESCAPED_UNICODE));