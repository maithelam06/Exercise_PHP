<?php
session_start();
require __DIR__ . '/../app/config/config.php';
require __DIR__ . '/../app/core/Database.php';
require __DIR__ . '/../app/core/Controller.php';
require __DIR__ . '/../app/models/GiangVien.php';
require __DIR__ . '/../app/controllers/GiangVienController.php';

// Router siêu gọn: ?controller=giangvien&action=index
$controller = strtolower($_GET['controller'] ?? 'giangvien');
$action     = strtolower($_GET['action'] ?? 'index');

switch ($controller) {
    case 'giangvien':
        $c = new GiangVienController();
        break;
    default:
        http_response_code(404); exit('Controller không tồn tại');
}

if (!method_exists($c, $action)) {
    http_response_code(404); exit('Action không tồn tại');
}
$c->$action();
