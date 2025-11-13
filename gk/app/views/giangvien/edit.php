<div class="edit-container">
  <h3 class="page-title">
    <i class="fas fa-user-edit me-2"></i>Sửa Giảng viên
  </h3>

  <form method="post" enctype="multipart/form-data" action="index.php?controller=giangvien&action=update" class="edit-form">
    <input type="hidden" name="MaGV" value="<?= htmlspecialchars($gv['MaGV']) ?>">

    <!-- Avatar Section -->
    <div class="avatar-section">
      <div class="avatar-wrapper">
        <img src="<?= $gv['HinhAnh'] ? htmlspecialchars($gv['HinhAnh']) : 'https://via.placeholder.com/150' ?>" alt="Avatar" id="avatarPreview" class="avatar-img">
        <label for="fileInput" class="avatar-upload-btn">
          <i class="fas fa-camera"></i>
        </label>
      </div>
      <input type="file" name="HinhAnh" id="fileInput" accept="image/*" hidden>
      <p class="avatar-hint">Nhấn vào icon camera để đổi ảnh</p>
    </div>

    <!-- Form Fields -->
    <div class="form-fields">
      <div class="form-group">
        <label>
          <i class="fas fa-user me-2"></i>Họ Tên <span class="text-danger">*</span>
        </label>
        <input name="HoTen" class="form-control" value="<?= htmlspecialchars($gv['HoTen']) ?>" required>
      </div>

      <div class="form-group">
        <label>
          <i class="fas fa-chalkboard-teacher me-2"></i>Tổng Số Lớp <span class="text-danger">*</span>
        </label>
        <input type="number" name="TongSoLop" class="form-control" value="<?= (int)$gv['TongSoLop'] ?>" min="0" required>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-save">
        <i class="fas fa-check-circle me-2"></i>Lưu thay đổi
      </button>
      <a class="btn btn-cancel" href="index.php?controller=giangvien&action=index">
        <i class="fas fa-arrow-rotate-left me-2"></i>Quay lại
      </a>
    </div>
  </form>
</div>

<style>
  .edit-container {
    max-width: 600px;
    margin: 2rem auto;
    padding: 0 1rem;
  }

  .page-title {
    text-align: center;
    font-size: 1.75rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 2rem;
  }

  .edit-form {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
  }

  /* Avatar Section */
  .avatar-section {
    text-align: center;
    margin-bottom: 2.5rem;
  }

  .avatar-wrapper {
    position: relative;
    width: 150px;
    height: 150px;
    margin: 0 auto 1rem;
  }

  .avatar-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #f0f0f0;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
  }

  .avatar-wrapper:hover .avatar-img {
    transform: scale(1.05);
    border-color: #000;
  }

  .avatar-upload-btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 42px;
    height: 42px;
    background: #000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    cursor: pointer;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.4);
    transition: all 0.3s ease;
    border: 2px solid white;
  }

  .avatar-upload-btn:hover {
    transform: scale(1.1);
    background: #333;
  }

  .avatar-hint {
    color: #777;
    font-size: 0.9rem;
    margin: 0;
  }

  /* Form Fields */
  .form-fields {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-bottom: 2rem;
  }

  .form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
  }

  .form-group label i {
    color: #000;
  }

  .form-control {
    padding: 0.8rem 1.1rem;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    font-size: 1rem;
    background: #fafafa;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    outline: none;
    border-color: #000;
    background: white;
    box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
  }

  /* Action Buttons */
  .form-actions {
    display: flex;
    gap: 0.8rem;
    margin-top: 1.5rem;
  }

  .btn {
    flex: 1;
    padding: 0.7rem 1.2rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    letter-spacing: 0.3px;
  }

  /* Nút Lưu - Đen trắng hiện đại */
  .btn-save {
    background: #000;
    color: #fff;
    border: 2px solid #000;
  }

  .btn-save:hover {
    background: #222;
    transform: translateY(-2px);
  }

  /* Nút Hủy - Trắng viền đen */
  .btn-cancel {
    background: #fff;
    color: #000;
    border: 2px solid #000;
  }

  .btn-cancel:hover {
    background: #000;
    color: #fff;
    transform: translateY(-2px);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .edit-container {
      margin: 1rem auto;
    }

    .edit-form {
      padding: 2rem 1.5rem;
    }

    .avatar-wrapper {
      width: 120px;
      height: 120px;
    }

    .avatar-upload-btn {
      width: 36px;
      height: 36px;
      font-size: 1rem;
    }

    .btn {
      font-size: 0.9rem;
      padding: 0.65rem 1rem;
    }
  }
</style>

<script>
  const fileInput = document.getElementById('fileInput');
  const avatarPreview = document.getElementById('avatarPreview');

  fileInput.addEventListener('change', function(e) {
    const file = this.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(e) {
        avatarPreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>