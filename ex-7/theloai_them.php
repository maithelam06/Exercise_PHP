<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thêm thể loại</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="tentheloai">Tên thể loại</label>
        <input type="text" name="tentheloai" id="tentheloai"><br>
        <label for="thutu">Thứ tự</label>
        <input id="thutu" type="text" name="thutu"><br>
        <label for="anhien">Ẩn Hiện</label>
        <select name="anhien" id="anhien">
            <option value="hien" selected>Hiện</option>
            <option value="an">Ẩn</option>
        </select><br>
        <label for="">icon</label>
        <input type="file" name="icon"><br>
        <input type="submit" value="Thêm">
        <input type="reset" value="Hũy">
    </form>
</body>
</html>

<!-- xử lí cùng 1 trang -->

<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tentheloai = $_POST['tentheloai'];
    $thutu = $_POST['thutu'];
    $anhien = $_POST['anhien'];

    if (isset($_FILES['icon']) && $_FILES['icon']['error'] == 0) {
        $iconName = $_FILES['icon']['name'];            
        $tmpName = $_FILES['icon']['tmp_name'];       
        $uploadDir = "uploads/";                       
        $targetFile = $uploadDir . basename($iconName);


        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Di chuyển file vào thư mục uploads
        if (move_uploaded_file($tmpName, $targetFile)) {
            echo "Upload thành công!<br>";
        } else {
            echo "Upload thất bại!<br>";
        }
    } else {
        $iconName = ""; // nếu không chọn file
    }

    // Ví dụ lưu vào DB
    $sql = "INSERT INTO theloai (TenTL, ThuTu, AnHien, icon) 
            VALUES ('$tentheloai', '$thutu', '$anhien', '$iconName')";
    if (mysqli_query($conn, $sql)) {
        echo "Thêm thể loại thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>
