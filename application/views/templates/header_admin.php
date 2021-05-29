<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title ?></title>

  <script src="https://kit.fontawesome.com/2baad1d54e.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/logo/favicon.ico" type="image/x-icon">

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    input[type="number"] {
      -moz-appearance: textfield;
    }
  </style>

</head>

<body id="page-top">

  <?= $this->session->flashdata('alert'); ?>

  <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-plane-departure"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
      </a>

      <hr class="sidebar-divider my-0">

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>admin/users">
          <i class="fas fa-fw fa-users"></i>
          <span>Pengguna</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>admin/bookings">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Pesanan</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>admin/flights">
          <i class="fas fa-fw fa-plane-departure"></i>
          <span>Penerbangan</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>admin/airports">
          <i class="fas fa-fw fa-plane-arrival"></i>
          <span>Bandara</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>admin/airlines">
          <i class="fas fa-fw fa-plane"></i>
          <span>Maskapai</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>admin/pages">
          <i class="fas fa-fw fa-file"></i>
          <span>Halaman</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal" href="#">
          <i class="fa fa-fw fa-power-off"></i>
          <span>Keluar</span></a>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <ul class="navbar-nav ml-auto">
            <?php $dataAmin = $this->db->get('admin')->row_array(); ?>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $dataAmin['name'] ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url(); ?>assets/img/profile.svg">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url(); ?>admin/edit">
                  <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                  Edit Profil
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>

          </ul>

        </nav>

        <div class="container-fluid">