<?php use App\Models\Konfigurasi_model;

$konfigurasi = new Konfigurasi_model();
$site        = $konfigurasi->listing();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <meta content="<?= strip_tags($description) ?>" name="description">
  <meta content="<?= $keywords ?>" name="keywords">
  <!-- Favicons -->
  <link href="<?= base_url('assets/upload/image/' . $site['icon']) ?>" rel="icon">
  <link href="<?= base_url('assets/upload/image/' . $site['icon']) ?>" rel="apple-touch-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- jQuery -->
<script src="<?= base_url() ?>/assets/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/dist/css/adminlte.min.css">
<!-- SWEETALERT -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="hold-transition login-page" style="background-color: #2596be;">
<div class="login-box" style="min-width: 35% !important; ">
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body" style="border-radius: 10px;">
            <div class="login-logo">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/upload/image/' . $site['icon']) ?>" class="img img-fluid" width="150px">
                    </div>
                </div>
            </div>
            <hr>
            <h4 class="login-box-msg">Reset Password</h4>
            <p class="login-box-msg"><?= $site['namaweb']?></p>
            <?= '<span class="text-danger">' . \Config\Services::validation()->listErrors() . '</span>'; ?>
            <?= form_open(base_url('login/password_request')); ?>
            <?= csrf_field() ?>
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6 col-md-4">
                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                </div>
                <!-- /.col -->
            </div>
            <?= form_close(); ?>
            <hr>
            <p class="mb-1 text-center">
                <a href="<?= base_url('login') ?>">Login</a> | <a href="<?= base_url('/registrasi') ?>" class="text-center">Daftar</a> | <a href="<?= base_url() ?>" class="text-center">Home</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<script>
<?php if ($session->getFlashdata('sukses')) { ?>
// Notifikasi
swal ( "Berhasil" ,  "<?= $session->getFlashdata('sukses'); ?>" ,  "success" )
<?php } ?>

<?php if (isset($_GET['logout'])) { ?>
// Notifikasi
swal ( "Berhasil" ,  "Anda berhasil logout." ,  "success" )
<?php } ?>

<?php if (isset($_GET['login'])) { ?>
// Notifikasi
swal ( "Oops..." ,  "Anda belum login." ,  "warning" )
<?php } ?>

<?php if ($session->getFlashdata('warning')) { ?>
// Notifikasi
swal ( "Mohon maaf" ,  "<?= $session->getFlashdata('warning'); ?>" ,  "warning" )
<?php } ?>

</script>


<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/assets/admin/dist/js/adminlte.min.js"></script>

</body>
</html>