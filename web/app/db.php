<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('error_reporting', 1);

$db = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'), getenv('DB_PORT'));