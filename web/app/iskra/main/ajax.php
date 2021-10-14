<?php
/**
 * @var $db mysqli
 */
require_once $_SERVER['DOCUMENT_ROOT']. '/db.php';

$action = $_POST['action'] ?? false;

if($action == 'getData') {
    $tables = ['test_iskra__cur1', 'test_iskra__pusk1', 'test_iskra__pusk2', 'test_iskra__pusk3'];

    foreach ($tables as $table) {
        $res = $db->query("SELECT * FROM $table ORDER BY ID DESC LIMIT 1");
        if($res) {
            $data = $res->fetch_assoc();
            $name = str_replace('test_iskra__', '', $table);
            $result[$name]['val'] = $data['MESSAGE'];
            $result[$name]['date'] = $data['DATE_INSERT'];
        }
    }
} elseif($action == 'setOption') {
    $code = $_POST['code'];
    $val = $_POST['val'];
    if($code && $val) {
        $query = "CREATE TABLE IF NOT EXISTS `test_settings` (`CODE` VARCHAR(255) NOT NULL , `NAME` VARCHAR(255), `VALUE` VARCHAR(255))";
        $db->query($query);
        $res = $db->query("SELECT * FROM test_settings WHERE CODE = '$code'");
        if($res && $res->fetch_assoc()) {
            $query = "UPDATE test_settings SET VALUE = '".$val."' WHERE CODE = '".$code."'";
            $res = $db->query($query);
            if($res) die(json_encode('success update'));
        } else {
            $query = "INSERT INTO test_settings VALUES ('".$code."', NULL, '".$val."')";
            $res = $db->query($query);
            if($res) die(json_encode('success insert'));
        }
    }
    die(json_encode('error'));
} elseif ($action == 'getOption') {
    $code = $_POST['code'];
    $res = $db->query("SELECT * FROM test_settings WHERE CODE = '".$code."'");
    if($res) die(json_encode($res->fetch_assoc()['VALUE']));
    else die(json_encode('error'));
}


die(json_encode($result, JSON_UNESCAPED_UNICODE));