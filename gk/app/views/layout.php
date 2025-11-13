<?php
// $viewPath, $title, and variables from $data are available
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title ?? 'QL Học Phần') ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-black: #000000;
      --secondary-black: #1a1a1a;
      --gray-dark: #2d2d2d;
      --gray-medium: #4a4a4a;
      --gray-light: #e5e5e5;
      --white: #ffffff;
      --off-white: #f8f9fa;
    }

    body {
      background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
      background-attachment: fixed;
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--secondary-black);
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(circle at 20% 50%, rgba(0, 0, 0, 0.03), transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(0, 0, 0, 0.05), transparent 50%);
      pointer-events: none;
      z-index: 1;
    }

    .navbar {
      background: var(--primary-black) !important;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      position: relative;
      z-index: 100;
    }

    .navbar-brand {
      color: var(--white) !important;
      font-weight: 700;
      font-size: 1.5rem;
      letter-spacing: -0.5px;
      transition: all 0.3s ease;
      position: relative;
    }

    .navbar-brand::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--white);
      transition: width 0.3s ease;
    }

    .navbar-brand:hover::after {
      width: 100%;
    }

    .navbar-brand:hover {
      transform: translateY(-2px);
      color: var(--gray-light) !important;
    }

    .navbar-brand i {
      color: var(--white);
      margin-right: 8px;
    }

    main.container {
      position: relative;
      z-index: 10;
    }

    .alert {
      border: none;
      border-radius: 15px;
      padding: 1rem 1.5rem;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      animation: slideInDown 0.5s ease-out;
      position: relative;
      overflow: hidden;
      border-left: 4px solid;
    }

    .alert-success {
      background: var(--white);
      color: var(--secondary-black);
      border-left-color: var(--primary-black);
    }

    .alert-success::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, rgba(0, 0, 0, 0.02) 0%, transparent 100%);
    }

    .alert-danger {
      background: var(--white);
      color: #721c24;
      border-left-color: #dc3545;
    }

    .alert-danger::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, rgba(220, 53, 69, 0.05) 0%, transparent 100%);
    }

    .alert i {
      margin-right: 10px;
      font-size: 1.2rem;
    }

    @keyframes slideInDown {
      from {
        transform: translateY(-100%);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .card {
      border: 1px solid var(--gray-light);
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
      background: var(--white);
      transition: all 0.3s ease;
      overflow: hidden;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
      border-color: var(--primary-black);
    }

    .btn {
      border-radius: 12px;
      padding: 0.6rem 1.5rem;
      font-weight: 600;
      transition: all 0.3s ease;
      border: 2px solid;
      position: relative;
      overflow: hidden;
    }

    .btn-primary {
      background: var(--primary-black);
      border-color: var(--primary-black);
      color: var(--white);
    }

    .btn-primary:hover {
      background: var(--secondary-black);
      border-color: var(--secondary-black);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .btn-success {
      background: var(--white);
      border-color: var(--primary-black);
      color: var(--primary-black);
    }

    .btn-success:hover {
      background: var(--primary-black);
      border-color: var(--primary-black);
      color: var(--white);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-outline-secondary {
      border-color: var(--gray-medium);
      color: var(--gray-medium);
    }

    .btn-outline-secondary:hover {
      background: var(--gray-medium);
      border-color: var(--gray-medium);
      color: var(--white);
    }

    .table {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .table thead th {
      background: var(--primary-black);
      color: var(--white);
      border: none;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.85rem;
      letter-spacing: 0.5px;
      padding: 1rem;
    }

    .table tbody tr {
      transition: all 0.3s ease;
      border-bottom: 1px solid var(--gray-light);
    }

    .table tbody tr:hover {
      background: rgba(0, 0, 0, 0.02);
      transform: scale(1.01);
    }

    .table tbody td {
      padding: 1rem;
      vertical-align: middle;
    }

    .form-control, .form-select {
      border-radius: 12px;
      border: 2px solid var(--gray-light);
      padding: 0.7rem 1rem;
      transition: all 0.3s ease;
      background: var(--white);
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--primary-black);
      box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
      background: var(--white);
    }

    .form-label {
      font-weight: 600;
      color: var(--secondary-black);
      margin-bottom: 0.5rem;
    }

    .badge {
      border-radius: 8px;
      padding: 0.4rem 0.8rem;
      font-weight: 600;
    }

    .badge.bg-primary {
      background: var(--primary-black) !important;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-track {
      background: var(--off-white);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--gray-medium);
      border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--primary-black);
    }

    /* Smooth page transitions */
    .page-enter {
      animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Link styles */
    a {
      color: var(--primary-black);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    a:hover {
      color: var(--gray-medium);
    }

    /* Page header styles */
    h1, h2, h3, h4, h5, h6 {
      color: var(--primary-black);
      font-weight: 700;
    }

    .text-muted {
      color: var(--gray-medium) !important;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="<?= BASE_URL ?>index.php?controller=giangvien&action=index">
      <i class="fas fa-graduation-cap"></i>
      Quản Lý Học Phần
    </a>
  </div>
</nav>

<main class="container py-4 page-enter">
  <?php if(!empty($_SESSION['msg'])): ?>
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i>
      <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
    </div>
  <?php endif; ?>
  <?php if(!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger">
      <i class="fas fa-exclamation-circle"></i>
      <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <?php require $viewPath; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>