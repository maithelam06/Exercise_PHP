<?php
require_once 'config.php';

$conn = new mysqli(_HOST, _USER, _PASS, _DB);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
