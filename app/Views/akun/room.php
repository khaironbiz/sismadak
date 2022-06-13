<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?= $title ?></h2>
        <ol>
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li><?= $title ?></li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
            <h2><?= $title ?></h2>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <b><?= $kelas->nama_kelas?></b><br>
                            <small>
                                <?= $kelas->nama_kategori_kelas?> :
                                <?php
                                if($kelas->tanggal_mulai == $kelas->tanggal_selesai){
                                    ?>
                                    <b class="text-primary"><?= $kelas->tanggal_mulai?></b>
                                    <?php
                                }else{
                                    ?>
                                    <b class="text-primary"><?= $kelas->tanggal_mulai?> sd <?= $kelas->tanggal_selesai?></b>
                                    <?php
                                }
                                ?><br>
                                <b class="text-primary"><small><?= $kelas->nama_client?></small></b>

                            </small>
                        </div>
                        <div class="card-body">
                          <b>Materi</b>
                          <table class="table table-sm table-striped">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Time</th>
                                      <th class="w-75">Materi</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                              $x    = 1;
                                foreach ($materi as $materi):
                                    $detik_mulai = strtotime($materi['waktu_mulai']);
                                    $detik_selesai = strtotime($materi['waktu_selesai']);
                              ?>
                                  <tr>
                                      <td><?= $x++?></td>
                                      <td><?= date('H:i', $detik_mulai)?> - <?= date('H:i', $detik_selesai)?></td>
                                      <td><?= $materi['materi']?><br><b><?= $materi['nama']?></b></td>
                                  </tr>
                              <?php
                                endforeach;
                              ?>
                              </tbody>
                          </table>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="<?= base_url('assets/upload/image/'.$kelas->poster)?>" class="w-100">
                    <p id="demo" class="text-center text-success text-bold"></p>

                    <script>
                        // Mengatur waktu akhir perhitungan mundur
                        var countDownDate = new Date("2022-05-13 16:37:25").getTime();

                        // Memperbarui hitungan mundur setiap 1 detik
                        var x = setInterval(function() {

                            // Untuk mendapatkan tanggal dan waktu hari ini
                            var now = new Date().getTime();

                            // Temukan jarak antara sekarang dan tanggal hitung mundur
                            var distance = countDownDate - now;

                            // Perhitungan waktu untuk hari, jam, menit dan detik
                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            // Keluarkan hasil dalam elemen dengan id = "demo"
                            if(days>0){
                                document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                                    + minutes + "m " + seconds + "s ";
                            }else if(hours >0){
                                document.getElementById("demo").innerHTML = hours + "h "
                                    + minutes + "m " + seconds + "s ";
                            }else if(minutes>0){
                                document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
                            }else{
                                document.getElementById("demo").innerHTML = seconds + "s ";
                            }



                            // Jika hitungan mundur selesai, tulis beberapa teks
                            if (distance < 0) {
                                clearInterval(x);
                                document.getElementById("demo").innerHTML = "<a href='https://ppni.or.id' class='btn btn-sm btn-success mt-2'>Klik</a>";
                            }
                        }, 1000);
                    </script>
                </div>

            </div>

        </div>
    </section><!-- End Doctors Section -->


</main><!-- End #main -->