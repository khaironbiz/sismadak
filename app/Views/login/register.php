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
<div class="login-box" style="min-width: 60% !important; ">

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
      <h4 class="login-box-msg">Registrasi Anggota</h4>
      <hr>
      <?= '<span class="text-danger">' . \Config\Services::validation()->listErrors() . '</span>'; ?>
      <?= form_open(base_url('register')); ?>
      <?= csrf_field() ?>
        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nama" placeholder="nama" required value="<?= set_value('nama') ?>" required>
            </div>
            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-4">
              <select class="form-control" name="jenis_kelamin" required>
                <option value="<?php if(isset($_POST['jenis_kelamin'])){echo set_value('jenis_kelamin');}else{}?>"><?php if(isset($_POST['jenis_kelamin'])){echo set_value('jenis_kelamin');}else{echo "--pilih--";}?></option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
        </div>
        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-4">
                <input type="date" class="form-control" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>" required>
            </div>
            <label class="col-sm-2 col-form-label">Nomor KTP</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" name="nik" placeholder="nomor KTP" value="<?= set_value('nik') ?>" required>
            </div>
        </div>
        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email" placeholder="email" value="<?= set_value('email') ?>" required>
            </div>
            <label class="col-sm-2 col-form-label">HP</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" name="hp" placeholder="nomor HP" value="<?= set_value('hp') ?>" required>
            </div>
        </div>
        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">NIRA</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" name="nira" placeholder="Nomor NIRA PPNI" value="<?= set_value('nira') ?>" required>
            </div>
            <label class="col-sm-2 col-form-label">DPW PPNI</label>
            <div class="col-sm-4">
                <select class="form-control" name="dpw" required>
                    <option value="">Pilih</option>
                    <?php
                    foreach($provinsi as $prov){
                    ?>
                    <option value="<?= $prov['id_prov']?>"><?= $prov['nama_prov']?></option>
                    <?php
                    }
                    ?>
                </select>
            
            </div>
        </div>
        
        <hr>
        <div class="row justify-content-center">
          
          <div class="col-2">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      <?= form_close(); ?>
      <hr>
      <p class="mb-1 text-center">
        <a href="<?= base_url('login') ?>">Login</a> | <a href="<?= base_url() ?>" class="text-center">Home</a>
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
