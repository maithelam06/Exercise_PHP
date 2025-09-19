<?php
require_once 'data.php';

$id = $_GET['id'];
$conn->query("DELETE FROM categories WHERE id=$id");

header("Location: list.php");
exit;
?>
