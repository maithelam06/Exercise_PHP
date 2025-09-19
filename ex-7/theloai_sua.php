<?php
require_once 'connect.php';

if(!isset($_GET['id'])){
    die("Không có ID để sửa!");
}

$id = intval($_GET['id']);


$sql = "SELECT * FROM theloai WHERE idTL = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if(!$row){
    die("Thể loại không tồn tại!");
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tentheloai = $_POST['tentheloai'];
    $thutu = $_POST['thutu'];
    $anhien = $_POST['anhien'];

    $iconName = $row['icon']; 
    if(isset($_FILES['icon']) && $_FILES['icon']['error'] == 0){
        $uploadDir = "uploads/";
        if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $tmpName = $_FILES['icon']['tmp_name'];
        $newIcon = $_FILES['icon']['name'];
        $targetFile = $uploadDir . basename($newIcon);

        if(move_uploaded_file($tmpName, $targetFile)){
            if(!empty($row['icon']) && file_exists($uploadDir.$row['icon'])){
                unlink($uploadDir.$row['icon']);
            }
            $iconName = $newIcon;
        }
    }

    $sql_update = "UPDATE theloai 
                   SET TenTL='$tentheloai', ThuTu='$thutu', AnHien='$anhien', icon='$iconName'
                   WHERE idTL=$id";
    if(mysqli_query($conn, $sql_update)){
        header("Location: hienthi.php");
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sửa thể loại</title>
</head>
<body>
    <h2>Sửa thể loại</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="tentheloai">Tên thể loại</label>
        <input type="text" name="tentheloai" id="tentheloai" value="<?php echo $row['TenTL']; ?>"><br>

        <label for="thutu">Thứ tự</label>
        <input type="text" name="thutu" id="thutu" value="<?php echo $row['ThuTu']; ?>"><br>

        <label for="anhien">Ẩn Hiện</label>
        <select name="anhien" id="anhien">
            <option value="hien" <?php if($row['AnHien']=='hien') echo 'selected'; ?>>Hiện</option>
            <option value="an" <?php if($row['AnHien']=='an') echo 'selected'; ?>>Ẩn</option>
        </select><br>

        <label for="icon">Icon</label>
        <input type="file" name="icon"><br>
        <?php if(!empty($row['icon'])): ?>
            <img src="uploads/<?php echo $row['icon']; ?>" width="50"><br>
        <?php endif; ?>

        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>
