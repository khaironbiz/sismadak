<?php 

$session = \Config\Services::session();
?>
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2><?= $title ?></h2>
        </div>
        </div>
    </section><!-- End Breadcrumbs Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-2">
                    <div class="card">
                        <div class="card-header">
                            <h4><?= $kelas->nama_kelas ?></h4>
                        </div>
                        <div class="card-body table-responsive">
                            <h5>Materi Pembelajaran</h5>
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Waktu</th>
                                        <th class="w-75">Materi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $x=1;
                                    foreach($materi as $materi):
                                        $detik_mulai    = strtotime($materi['waktu_mulai']);
                                        $detik_selesai  = strtotime($materi['waktu_selesai']);
                                    ?>
                                    <tr>
                                        <td><?= $x++; ?></td>
                                        <td><?= date('H:i', $detik_mulai)?>-<?= date('H:i', $detik_selesai)?></td>
                                        <td>
                                            <?= $materi['materi']?><br>
                                            <b>By : <?= $materi['nama']?></b>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach
                                    ?>
                                </tbody>

                            </table>
                            <h5>SKP</h5>
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Organisasi Profesi</th>
                                        <th>SKP</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $nomor  = 1;
                                        foreach($skp as $skp):
                                    ?>
                                    <tr>
                                        <td><?= $nomor++; ?></td>
                                        <td><?= $skp['nama_op']?></td>
                                        <td><?= $skp['nominal_skp']?></td>
                                        <td><?= $skp['keterangan']?></td>
                                    </tr>
                                    <?php
                                        endforeach
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#daftar<?= $kelas->has_kelas ?>">
                        Daftar
                        </button>
                        <!-- Modal -->
                        <?php
                        if($id_user>0){
                            echo form_open(base_url('admin/kelas_peserta/create/'.$kelas->has_kelas));
                            echo csrf_field();
                        }else{
                        ?>
                        <?= form_open(base_url('admin/kelas_peserta/daftar_tamu/'.$kelas->has_kelas));
                        echo csrf_field();
                        }
                        ?>
                        <div class="modal fade" id="daftar<?= $kelas->has_kelas ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Pendaftaran Kegiatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Member -->

                                <!-- Non Member -->
                                <div class="modal-body">
                                    <div class="row mb-1">
                                        <label for="staticEmail" class="col-md-3">Kelas</label>
                                        <div class="col-md-9">
                                            <select class="form-control form-control-sm" name="id_kelas">
                                                <option value="<?= $kelas->id_kelas; ?>"><?= $kelas->nama_kelas; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Member -->
                                    <?php
                                        if($id_user>0){
                                    ?>
                                    <div class="row mb-1">
                                        <label for="staticEmail" class="col-md-3">Email</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="email_peserta" value="<?= $user['email']?>">
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="inputPassword" class="col-md-3">No HP</label>
                                        <div class="col-md-9">
                                            <input type="telp" class="form-control form-control-sm" name="hp_peserta" >
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="inputPassword" class="col-md-3">Nama di Sertifikat</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="nama_sertifikat" value="<?= $user['nama']?>">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-1">
                                        <label for="inputPassword" class="col-md-3">Harga Member</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control form-control-sm" name="harga" value="<?= $kelas->harga_jual; ?>">
                                        </div>
                                    </div>
                                    <?php
                                        }else{
                                        ?>
                                    <div class="row mb-1">
                                        <label for="staticEmail" class="col-md-3">Email</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="email_peserta">
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="inputPassword" class="col-md-3">No HP</label>
                                        <div class="col-md-9">
                                            <input type="telp" class="form-control form-control-sm" name="hp_peserta">
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="inputPassword" class="col-md-3">Nama di Sertifikat</label>
                                        <div class="col-md-9">
                                            <input type="telp" class="form-control form-control-sm" name="nama_sertifikat">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-1">
                                        <label for="inputPassword" class="col-md-3">Harga Non Member</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control form-control-sm" name="harga" value="<?php if($kelas->harga_jual<1){echo "10000";}else{ echo ($kelas->harga_jual*1.1); } ?>">
                                        </div>
                                    </div>
                                    <?php
                                        }
                                        ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-default btn-sm">Save</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <?php
                        if($kelas->poster){
                        ?>
                        <img src="<?= base_url('assets/upload/image/' . $kelas->poster) ?>">
                        <?php
                        }
                        ?>
                        <div class="card-body">
                            
                            <?= $kelas->nama_kategori_kelas ?>
                            <?php
                                $waktu_awal = strtotime($kelas->tanggal_mulai);
                                $waktu_ahir = strtotime($kelas->tanggal_selesai);
                                if($waktu_awal == $waktu_ahir){
                                    echo "Satu Hari";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->
</main><!-- End #main -->