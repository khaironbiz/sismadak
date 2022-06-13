<?php use App\Models\Konfigurasi_model;

$konfigurasi = new Konfigurasi_model();
$site        = $konfigurasi->listing();
// Menu
use App\Models\Menu_model;
$menu         = new Menu_model();
$site         = $konfigurasi->listing();
$menu_berita  = $menu->berita();
$menu_profil  = $menu->profil();
$menu_layanan = $menu->layanan();
?>
<!-- ======= Footer ======= -->
  <footer id="footer" class="bg-info text-dark">
    <div class="footer-top ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h4><?= $site['namaweb'] ?></h4>
              <p>
                <?= $site['alamat'] ?>
                <br>
                <strong>Phone:</strong> <?= $site['telepon'] ?><br>
                <strong>Email:</strong> <?= $site['email'] ?><br>
              </p>
              <div class="social-links mt-3">
                <a href="<?= $site['twitter'] ?>" class="twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="<?= $site['facebook'] ?>" class="facebook" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="<?= $site['instagram'] ?>" class="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="<?= $site['youtube'] ?>" class="google-plus" target="_blank"><i class="fab fa-youtube"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>About Us</h4>
            <ul>
              <?php foreach ($menu_profil as $menu_profil) { ?>
              <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('berita/profil/' . $menu_profil['slug_berita']) ?>"><?= $menu_profil['judul_berita'] ?></a></li>
              <?php } ?>
              <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('staff') ?>">Staff &amp; Team Kami</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <?php foreach ($menu_layanan as $menu_layanan) { ?>
              <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('berita/layanan/' . $menu_layanan['slug_berita']) ?>"><?= $menu_layanan['judul_berita'] ?></a></li>
              <?php } ?>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Find Us on Map</h4>
            <style type="text/css" media="screen">
              iframe {
                width: 100%;
                height: 200px;
              }
            </style>
            <?= $site['google_map'] ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span><?= $site['namaweb'] ?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
        Designed with <i class="bi bi-heart-fill"></i> by <a href="https://nurse.my.id/" class="text-white">Khairon</a> 
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>/assets/template/assets/vendor/aos/aos.js"></script>
  <!-- bootstrap 5 -->
  <!-- <script src="<?= base_url() ?>/assets/template/assets/vendor/bootstrap/js/bs5.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script src="<?= base_url() ?>/assets/template/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url() ?>/assets/template/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url() ?>/assets/template/assets/vendor/purecounter/purecounter.js"></script>
  <script src="<?= base_url() ?>/assets/template/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>/assets/template/assets/js/main.js"></script>
  <!-- DataTables  & Plugins -->

<script src="<?= base_url() ?>/assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script>
  $(function () {
    $('#example1').DataTable();
  });
  </script>
  <!-- SWEETALERT -->
  <?php if ($session->getFlashdata('sukses')) { ?>
  <script>
    swal("Berhasil", "<?= $session->getFlashdata('sukses'); ?>","success")
  </script>
  <?php } ?>

  <?php if (isset($error)) { ?>
  <script>
    swal("Oops...", "<?= strip_tags($error); ?>","warning")
  </script>
  <?php } ?>

  <?php if ($session->getFlashdata('warning')) { ?>
  <script>
    swal("Oops...", "<?= $session->getFlashdata('warning'); ?>","warning")
  </script>
  <?php } ?>

</body>

</html>