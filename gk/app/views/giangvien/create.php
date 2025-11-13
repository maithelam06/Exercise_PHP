<h3 class="mb-3">Thêm Giảng viên</h3>
<form method="post" enctype="multipart/form-data" action="index.php?controller=giangvien&action=store" class="bg-white p-4 rounded shadow-sm">
  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label">Mã Giảng viên</label>
      <input name="MaGV" class="form-control" required>
    </div>
    <div class="col-md-8">
      <label class="form-label">Họ Tên</label>
      <input name="HoTen" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Hình Ảnh</label>
      <div class="custom-file-upload">
        <input type="file" name="HinhAnh" id="fileInput" class="file-input" accept="image/*">
        <label for="fileInput" class="file-label">
          <i class="fas fa-cloud-upload-alt"></i>
          <span class="file-text">Chọn ảnh hoặc kéo thả vào đây</span>
          <span class="file-name"></span>
        </label>
        <div class="image-preview" id="imagePreview">
          <img src="" alt="Preview" id="previewImg">
          <button type="button" class="remove-image" id="removeImage">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <label class="form-label">Tổng Số Lớp</label>
      <input type="number" name="TongSoLop" class="form-control" min="0" required>
    </div>
  </div>
  <div class="mt-4 d-flex justify-content-center gap-3">
    <button class="btn btn-update px-4 py-2">
      <i class="fas fa-save me-2"></i> Lưu thay đổi
    </button>
    <a class="btn btn-back px-4 py-2" href="index.php?controller=giangvien&action=index">
      <i class="fas fa-arrow-left me-2"></i> Quay lại
    </a>
  </div>


</form>

<style>
  .custom-file-upload {
    position: relative;
  }

  .file-input {
    display: none;
  }

  .file-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    border: 2px dashed #d0d0d0;
    border-radius: 12px;
    background: #fafafa;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
  }

  .file-label:hover {
    border-color: #000;
    background: #f5f5f5;
  }

  .file-label i {
    font-size: 2.5rem;
    color: #666;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
  }

  .file-label:hover i {
    color: #000;
    transform: translateY(-5px);
  }

  .file-text {
    color: #666;
    font-size: 0.95rem;
    font-weight: 500;
  }

  .file-name {
    display: none;
    margin-top: 0.5rem;
    color: #000;
    font-weight: 600;
    font-size: 0.9rem;
  }

  .file-label.has-file .file-text {
    display: none;
  }

  .file-label.has-file .file-name {
    display: block;
  }

  .file-label.has-file {
    border-color: #000;
    background: #f0f0f0;
  }

  .image-preview {
    display: none;
    position: relative;
    margin-top: 1rem;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  }

  .image-preview.show {
    display: block;
  }

  .image-preview img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
  }

  .remove-image {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }

  .remove-image:hover {
    background: #000;
    transform: scale(1.1);
  }

  /* Drag and drop states */
  .file-label.drag-over {
    border-color: #000;
    background: #e8e8e8;
    transform: scale(1.02);
  }
</style>

<script>
  const fileInput = document.getElementById('fileInput');
  const fileLabel = document.querySelector('.file-label');
  const fileName = document.querySelector('.file-name');
  const imagePreview = document.getElementById('imagePreview');
  const previewImg = document.getElementById('previewImg');
  const removeImage = document.getElementById('removeImage');

  // Handle file selection
  fileInput.addEventListener('change', function(e) {
    handleFile(this.files[0]);
  });

  // Handle drag and drop
  fileLabel.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('drag-over');
  });

  fileLabel.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('drag-over');
  });

  fileLabel.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('drag-over');

    const files = e.dataTransfer.files;
    if (files.length > 0 && files[0].type.startsWith('image/')) {
      fileInput.files = files;
      handleFile(files[0]);
    }
  });

  // Handle remove image
  removeImage.addEventListener('click', function() {
    fileInput.value = '';
    fileLabel.classList.remove('has-file');
    imagePreview.classList.remove('show');
    fileName.textContent = '';
  });

  // Function to handle file
  function handleFile(file) {
    if (file && file.type.startsWith('image/')) {
      fileName.textContent = file.name;
      fileLabel.classList.add('has-file');

      // Show preview
      const reader = new FileReader();
      reader.onload = function(e) {
        previewImg.src = e.target.result;
        imagePreview.classList.add('show');
      };
      reader.readAsDataURL(file);
    }
  }
</script>