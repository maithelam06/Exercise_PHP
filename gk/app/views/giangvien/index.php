<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h3 class="m-0 fw-bold">Danh sách Giảng viên</h3>
    <p class="text-muted mb-0 mt-1">Quản lý thông tin giảng viên</p>
  </div>
  <a class="btn btn-primary btn-add" href="index.php?controller=giangvien&action=create">
    <i class="fas fa-plus-circle me-2"></i>Thêm mới
  </a>
</div>

<div class="table-container">
  <div class="table-responsive">
    <table class="table table-custom align-middle">
      <thead>
        <tr>
          <th>Mã GV</th>
          <th>Họ Tên</th>
          <th>Hình Ảnh</th>
          <th>Tổng Số Lớp</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($list)): foreach ($list as $r): ?>
          <tr>
            <td>
              <span class="badge-code"><?= htmlspecialchars($r['MaGV']) ?></span>
            </td>
            <td>
              <div class="teacher-name">
                <i class="fas fa-user-tie me-2"></i>
                <?= htmlspecialchars($r['HoTen']) ?>
              </div>
            </td>
            <td>
              <?php if($r['HinhAnh']): ?>
                <div class="teacher-avatar">
                  <img src="<?= htmlspecialchars($r['HinhAnh']) ?>" alt="Avatar">
                </div>
              <?php else: ?>
                <div class="teacher-avatar-placeholder">
                  <i class="fas fa-user"></i>
                </div>
              <?php endif; ?>
            </td>
            <td>
              <span class="badge-count">
                <i class="fas fa-chalkboard-teacher me-1"></i>
                <?= (int)$r['TongSoLop'] ?> lớp
              </span>
            </td>
            <td>
              <div class="action-buttons">
                <a class="btn-action btn-edit" href="index.php?controller=giangvien&action=edit&id=<?= urlencode($r['MaGV']) ?>" title="Chỉnh sửa">
                  <i class="fas fa-edit"></i>
                </a>
                <a class="btn-action btn-delete" onclick="return confirm('Bạn có chắc muốn xóa giảng viên này?')" href="index.php?controller=giangvien&action=destroy&id=<?= urlencode($r['MaGV']) ?>" title="Xóa">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr>
            <td colspan="5" class="empty-state">
              <div class="empty-icon">
                <i class="fas fa-inbox"></i>
              </div>
              <p class="mb-0">Chưa có dữ liệu giảng viên</p>
              <a href="index.php?controller=giangvien&action=create" class="btn btn-sm btn-primary mt-2">
                <i class="fas fa-plus me-1"></i>Thêm giảng viên đầu tiên
              </a>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- ✅ Footer nhà phát triển -->
<footer class="developer-footer mt-4">
  <div class="container-fluid text-center">
    <p class="footer-title mb-1">
      <i class="fas fa-chalkboard-teacher me-2 text-light"></i>
      Hệ thống Quản lý Giảng viên
    </p>
    <p class="mb-0 text-muted small">
      <i class="fas fa-code me-1"></i>
      Phát triển bởi <span class="developer-name">Mai Thế Lâm</span> © <?= date('Y') ?>
    </p>
  </div>
</footer>

<style>
.table-container {
  background: #fff;
  border-radius: 6px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

/* Header */
.table-custom thead {
  background: #111;
}

.table-custom thead th {
  color: #fff;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 0.85rem;
  letter-spacing: 0.5px;
  padding: 1rem 0.8rem;
  border: none;
  text-align: center;
}

/* Body */
.table-custom tbody td {
  padding: 1rem;
  vertical-align: middle;
  border-bottom: 1px solid #e6e6e6;
  text-align: center;
}

.table-custom tbody tr {
  transition: all 0.2s ease;
}

.table-custom tbody tr:hover {
  background: #f9f9f9;
  transform: scale(1.002);
}

/* Mã GV */
.badge-code {
  display: inline-block;
  padding: 0.4rem 0.8rem;
  background: #f5f5f5;
  border: 1px solid #ccc;
  border-radius: 2px;
  font-weight: 600;
  font-size: 0.9rem;
  color: #222;
  font-family: "Courier New", monospace;
}

/* Tên giảng viên */
.teacher-name {
  font-weight: 600;
  color: #1a1a1a;
  font-size: 1rem;
}

/* Ảnh giảng viên – hình vuông */
.teacher-avatar {
  width: 70px;
  height: 70px;
  margin: 0 auto;
  border-radius: 4px;
  overflow: hidden;
  border: 1px solid #ccc;
  box-shadow: none;
  transition: all 0.3s ease;
}

.teacher-avatar:hover {
  transform: scale(1.05);
  border-color: #000;
}

.teacher-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Placeholder */
.teacher-avatar-placeholder {
  width: 70px;
  height: 70px;
  margin: 0 auto;
  border: 1px solid #ccc;
  border-radius: 4px;
  background: #f0f0f0;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #777;
  font-size: 1.3rem;
}

/* Tổng số lớp */
.badge-count {
  display: inline-block;
  padding: 0.4rem 0.8rem;
  background: #222;
  color: white;
  border-radius: 2px;
  font-weight: 600;
  font-size: 0.9rem;
}

/* Các nút hành động */
.action-buttons {
  display: flex;
  gap: 0.4rem;
  justify-content: center;
}

.btn-action {
  width: 38px;
  height: 38px;
  border-radius: 2px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1.5px solid;
  transition: all 0.25s ease;
  cursor: pointer;
  text-decoration: none;
  font-size: 0.95rem;
}

/* Nút sửa */
.btn-edit {
  background: #fff;
  border-color: #000;
  color: #000;
}

.btn-edit:hover {
  background: #000;
  color: #fff;
  transform: translateY(-2px);
}

/* Nút xóa */
.btn-delete {
  background: #fff;
  border-color: #dc3545;
  color: #dc3545;
}

.btn-delete:hover {
  background: #dc3545;
  color: #fff;
  transform: translateY(-2px);
}

/* Nút thêm mới */
.btn-add {
  background: #000;
  color: #fff;
  padding: 0.6rem 1.3rem;
  font-weight: 600;
  border-radius: 4px;
  border: 2px solid #000;
  transition: all 0.3s ease;
}

.btn-add:hover {
  background: #222;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Empty state */
.empty-state {
  padding: 3rem 1rem !important;
  text-align: center;
  color: #777;
}

.empty-icon {
  font-size: 3.5rem;
  color: #ccc;
  margin-bottom: 1rem;
}

.empty-state .btn {
  background: #000;
  border: none;
  color: #fff;
  border-radius: 4px;
  padding: 0.5rem 1rem;
}

.empty-state .btn:hover {
  background: #333;
}

/* Footer nhà phát triển */
.developer-footer {
  background: #0d0d0d;
  color: #eaeaea;
  padding: 1.4rem 0;
  border-top: 2px solid #000;
  margin-top: 2rem;
  text-align: center;
  font-size: 0.95rem;
  letter-spacing: 0.3px;
}

.developer-footer .footer-title {
  font-weight: 600;
  font-size: 1rem;
  color: #fff;
}

.developer-footer .developer-name {
  color: #fff;
  font-weight: 600;
}

.developer-footer i {
  color: #aaa;
}

.developer-footer .text-muted {
  color: #aaa !important;
}

.developer-footer .dev-link {
  color: #999;
  text-decoration: none;
  transition: color 0.3s ease;
}

.developer-footer .dev-link:hover {
  color: #fff;
  text-decoration: underline;
}

@media (max-width: 768px) {
  .teacher-avatar,
  .teacher-avatar-placeholder {
    width: 55px;
    height: 55px;
  }

  .btn-action {
    width: 34px;
    height: 34px;
    font-size: 0.85rem;
  }

  .badge-code {
    font-size: 0.8rem;
    padding: 0.3rem 0.6rem;
  }

  .badge-count {
    font-size: 0.8rem;
    padding: 0.3rem 0.7rem;
  }

  .developer-footer {
    font-size: 0.85rem;
    padding: 1rem 0.5rem;
  }
}
</style>
