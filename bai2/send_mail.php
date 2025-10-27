<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Nạp các file của PHPMailer
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $to = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $file = $_FILES['attachment'];

    // Cấu hình thông tin người gửi
    $mail = new PHPMailer(true);

    try {
        // Cấu hình server SMTP
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = 'smtp.gmail.com'; // SMTP Server của Gmail
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl'; // hoặc 'tls'
        $mail->Port = 465; // Nếu dùng TLS thì là 587

        // Thông tin tài khoản Gmail của bạn
        $mail->Username = 'lammt.24ite@vku.udn.vn'; 
        $mail->Password = 'hsdv wntw mseg hlij'; // Mật khẩu ứng dụng (App password Gmail)

        // Người gửi
        $mail->setFrom('lammt.24ite@vku.udn.vn', 'Mai The Lam');

        // Người nhận
        $mail->addAddress($to);

        // Nếu có file đính kèm
        if (!empty($file['name'])) {
            $mail->addAttachment($file['tmp_name'], $file['name']);
        }

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Bỏ qua xác thực SSL (nếu chạy localhost)
        $mail->smtpConnect([
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            ]
        ]);

        // Gửi mail
        $mail->send();
        echo "<script>alert('✅ Gửi mail thành công!'); window.location='index.php';</script>";
    } 
    catch (Exception $e) {
        echo "<script>alert('❌ Lỗi khi gửi mail: {$mail->ErrorInfo}'); window.location='index.php';</script>";
    }
}
?>
