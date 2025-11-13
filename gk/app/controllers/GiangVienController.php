<?php
class GiangVienController extends Controller {
    private GiangVien $model;

    public function __construct() {
        $this->model = new GiangVien();
    }

    public function index() {
        $list = $this->model->all();
        $this->view('giangvien/index', ['title' => 'Danh sách Giảng viên', 'list' => $list]);
    }

    public function create() {
        $this->view('giangvien/create', ['title' => 'Thêm Giảng viên']);
    }

    public function store() {
    // Lấy dữ liệu từ form
    $MaGV = trim($_POST['MaGV'] ?? '');
    $HoTen = trim($_POST['HoTen'] ?? '');
    $TongSoLop = (int)($_POST['TongSoLop'] ?? 0);

    // Kiểm tra dữ liệu rỗng hoặc không hợp lệ
    if ($MaGV === '' || $HoTen === '' || $TongSoLop < 0) {
        $_SESSION['error'] = 'Vui lòng nhập đầy đủ và hợp lệ các trường.';
        return $this->redirect('controller=giangvien&action=create');
    }

    // Kiểm tra mã giảng viên đã tồn tại chưa
    $existing = $this->model->find($MaGV);
    if ($existing) {
        $_SESSION['error'] = "Mã giảng viên <b>$MaGV</b> đã tồn tại. Vui lòng nhập mã khác!";
        return $this->redirect('controller=giangvien&action=create');
    }

    // Upload ảnh (nếu có)
    $filePath = null;
    if (!empty($_FILES['HinhAnh']['name'])) {
        if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0775, true);
        $ext = pathinfo($_FILES['HinhAnh']['name'], PATHINFO_EXTENSION);
        $safe = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($MaGV));
        $filePath = UPLOAD_DIR . $safe . '_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $filePath);
    }

    // Thêm vào DB
    $ok = $this->model->create([
        'MaGV' => $MaGV,
        'HoTen' => $HoTen,
        'HinhAnh' => $filePath ? (UPLOAD_URL . basename($filePath)) : null,
        'TongSoLop' => $TongSoLop
    ]);

    $_SESSION['msg'] = $ok ? ' Thêm giảng viên thành công.' : ' Thêm thất bại.';
    $this->redirect('controller=giangvien&action=index');
}


    public function edit() {
        $MaGV = $_GET['id'] ?? '';
        $gv = $this->model->find($MaGV);
        if (!$gv) {
            $_SESSION['error'] = 'Không tìm thấy giảng viên.';
            return $this->redirect('controller=giangvien&action=index');
        }
        $this->view('giangvien/edit', ['title' => 'Sửa Giảng viên', 'gv' => $gv]);
    }

    public function update() {
        $MaGV = $_POST['MaGV'] ?? '';
        $gv = $this->model->find($MaGV);
        if (!$gv) {
            $_SESSION['error'] = 'Không tồn tại giảng viên.';
            return $this->redirect('controller=giangvien&action=index');
        }

        $HoTen = trim($_POST['HoTen'] ?? '');
        $TongSoLop = (int)($_POST['TongSoLop'] ?? 0);
        $img = $gv['HinhAnh'];

        if (!empty($_FILES['HinhAnh']['name'])) {
            if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0775, true);
            $ext = pathinfo($_FILES['HinhAnh']['name'], PATHINFO_EXTENSION);
            $safe = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($MaGV));
            $filePath = UPLOAD_DIR . $safe . '_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $filePath);
            $img = UPLOAD_URL . basename($filePath);
        }

        $ok = $this->model->update($MaGV, [
            'HoTen' => $HoTen,
            'HinhAnh' => $img,
            'TongSoLop' => $TongSoLop
        ]);

        $_SESSION['msg'] = $ok ? 'Cập nhật thành công.' : 'Cập nhật thất bại.';
        $this->redirect('controller=giangvien&action=index');
    }

    public function destroy() {
        $MaGV = $_GET['id'] ?? '';
        $ok = $this->model->delete($MaGV);
        $_SESSION['msg'] = $ok ? 'Đã xóa.' : 'Xóa thất bại.';
        $this->redirect('controller=giangvien&action=index');
    }
}
