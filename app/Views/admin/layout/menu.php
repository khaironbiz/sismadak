<?php
use App\Models\Konfigurasi_model;
$konfigurasi = new Konfigurasi_model();
$site        = $konfigurasi->listing();
?>
<style type="text/css" media="screen">
  .nav-item a:hover {
    color: yellow !important;
  }
</style>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('assets/upload/image/' . $site['icon']) ?>" alt="Gambar Profile" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= $site['singkatan'] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/upload/image/user3-128x128.jpg') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url('admin/akun') ?>" class="d-block"><?= $session->get('nama') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dahboard -->
          <li class="nav-item">
            <a href="<?= base_url('admin/dasbor') ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('admin/konfigurasi') ?>" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>Konfigurasi</p>
            </a>
          </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/kelompok') ?>" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Kelompok</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/pokja') ?>" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Pokja</p>
                </a>
            </li>
            <!-- Staff -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>Pokja
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/staff') ?>" class="nav-link">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Data Staff/Team</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/staff/tambah') ?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Tambah Staff/Team</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/kategori_staff') ?>" class="nav-link">
                  <i class="fas fa-tags nav-icon"></i>
                  <p>Kategori Staff/Team</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- logout -->
          <li class="nav-item">
            <a href="<?= base_url('login/logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1><?= $title ?></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?= $title ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                  $validation = \Config\Services::validation();
                  $errors = $validation->getErrors();
                    if (! empty($errors)) {
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5>gagal validasi</h5>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php        
                      
                    }
                ?>

                <?php if (session('msg')) : ?>
                    <div class="alert alert-info alert-dismissible">
                        <?= session('msg') ?>
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    </div>
                <?php endif ?>
                <?php 
	