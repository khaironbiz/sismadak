<?php use App\Models\Konfigurasi_model;
use App\Models\Menu_model;
$konfigurasi  = new Konfigurasi_model();
$menu         = new Menu_model();
$site         = $konfigurasi->listing();
$menu_berita  = $menu->berita();
$menu_profil  = $menu->profil();
$menu_layanan = $menu->layanan();
?>
<!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center d-none d-md-flex">
        <i class="fa fa-home"></i> <?= tagline(); ?>
      </div>
      <div class="d-flex align-items-center">
        <?php
        if($session->get('nama') !='') {
          if($session->get('akses_level') == 'Admin'){
        ?>
        <i class="fa fa-user" aria-hidden="true"></i><a href="<?= base_url('admin/dasbor')?>" class="btn btn-primary btn-sm">My Account</a> 
        <?php
        }else{
        ?>
        <i class="fa fa-user" aria-hidden="true"></i><a href="<?= base_url('kelas/main')?>" class="btn btn-primary btn-sm">My Account</a> 
        <?php
        }
      }
        ?>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="index.html" class="logo me-auto"><img src="<?= base_url('assets/upload/image/' . $site['logo']) ?>" alt="<?= $site['namaweb'] ?>"></a>
      
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="<?= base_url() ?>">Home</a></li>
          <li class="dropdown"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php foreach ($menu_profil as $menu_profil) { ?>
              <li><a href="<?= base_url('berita/profil/' . $menu_profil['slug_berita']) ?>"><?= $menu_profil['judul_berita'] ?></a></li>
              <?php } ?>
              
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="<?= base_url('berita') ?>">Berita</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('berita/event') ?>">Event</a></li>

          <li class="dropdown"><a href="#"><span>Galeri &amp; Video</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?= base_url('galeri') ?>">Galeri Gambar</a></li>
              <li><a href="<?= base_url('video') ?>">Galeri Video</a></li>
            </ul>
          </li>
            <?php
            $id_user = $session->get('id_user');
            if($id_user>0){
            ?>
            <li class="dropdown"><a href="#"><span>Kelasku</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="<?= base_url('kelas/progress') ?>">Progress</a></li>
                    <li><a href="<?= base_url('kelas/soon') ?>">Soon</a></li>
                    <li><a href="<?= base_url('kelas/main') ?>">Past</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
          <li><a class="nav-link scrollto" href="<?= base_url('download') ?>">Download</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('kontak') ?>">Kontak</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <?php

      if($id_user>0){
        
      ?>

      <a href="<?= base_url('login/logout') ?>" class="appointment-btn scrollto">Logout</a>
      <?php
      }else{
      ?>
      <a href="<?= base_url('login') ?>" class="appointment-btn scrollto">Login</a>
      <?php
      }
      ?>
    </div>
  </header><!-- End Header -->