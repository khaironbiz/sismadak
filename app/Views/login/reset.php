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
        <div class="login-box" style="min-width: 25% !important; ">
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body" style="border-radius: 10px;">
                    <div class="login-logo">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/upload/image/' . $site['icon']) ?>" class="img img-fluid" width="150px">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="login-box-msg"><?= $nama ?></p>
                    <?= '<span class="text-danger">' . \Config\Services::validation()->listErrors() . '</span>'; ?>
                    <?= form_open(base_url('login/reset_password/'."/".$token)); ?>
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="password" name="password_1" class="form-control" placeholder="Password">
                        <input type="hidden" name="token" class="form-control" value="<?= $token?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_2" class="form-control" placeholder="Ulangi Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Create New Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <?= form_close(); ?>
                    <hr>
                    <p class="mb-1 text-center">
                        <a href="<?= base_url('login') ?>">login</a> | <a href="<?= base_url('/registrasi') ?>" class="text-center">Daftar</a> | <a href="<?= base_url() ?>" class="text-center">Home</a>
                    </p>
                </div>
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
