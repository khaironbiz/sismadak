<div class="row">
    <div class="col-md-6">
        
        <div class="card">
            <div class="card-header bg-dark">
                <b>Detail Kegiatan</b>
            </div>
            <div class="card-body">
                <div class="row">
                    <label class="col-sm-3">Acara</label>
                    <div class="col-sm-9">
                        <?= $materi['judul_berita']?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3">Topik</label>
                    <div class="col-sm-9">
                        <?= $materi['materi']?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3">Pemateri</label>
                    <div class="col-sm-9">
                        <?= $materi['nama']?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3">Waktu Mulai</label>
                    <div class="col-sm-9">
                        <?= $materi['waktu_mulai']?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3">Waktu Selesai</label>
                    <div class="col-sm-9">
                        <?= $materi['waktu_selesai']?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3">Durasi</label>
                    <div class="col-sm-9">
                        <?= round((strtotime($materi['waktu_selesai']))-(strtotime($materi['waktu_mulai'])))/60?> Menit
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-success mt-2" data-toggle="modal" data-target="#modal-<?= $materi['has_materi']?>">
                        <i class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger mt-2" data-toggle="modal" data-target="#delete-<?= $materi['has_materi']?>">
                        <i class="fa fa-trash"></i>
                </button>
                <?= form_open(base_url('admin/materi/update/'."/".$materi['has_materi']));
                echo csrf_field();
                $detik_mulai    = strtotime($materi['waktu_mulai']);
                $detik_selesai  = strtotime($materi['waktu_selesai']);
                ?>
                    <div class="modal fade" id="modal-<?= $materi['has_materi']?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Materi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <label class="col-3">Materi</label>
                                        <div class="col-9 row">
                                            <input type="text" class="form-control form-control-sm" value="<?= $materi['materi']?>" required name="materi">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-3">Pemateri</label>
                                        <div class="col-9 row">
                                            <select class="form-control form-control-sm" name="pemateri">
                                                <option value="<?= $materi['pemateri']?>"><?= $materi['nama']?></option>
                                                <?php
                                                foreach($user as $u){
                                                ?>
                                                <option value="<?= $u['id_user']?>"><?= $u['nama']?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3">Waktu</label>
                                        <div class="col-md-9 row">
                                            <input type="text" class="form-control form-control-sm tanggal col-sm-3" value="<?= date('d-m-Y', $detik_mulai)?>" name="tanggal_mulai">
                                            <input type="text" class="form-control form-control-sm jam col-sm-2" value="<?= date('H:i', $detik_mulai)?>" name="jam_mulai">
                                            <label class="col-sm-2">SD</label>
                                            <input type="text" class="form-control form-control-sm tanggal col-sm-3" value="<?= date('d-m-Y', $detik_selesai)?>" name="tanggal_selesai">
                                            <input type="text" class="form-control form-control-sm jam col-sm-2" value="<?= date('H:i', $detik_selesai)?>" name="jam_selesai">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                <!-- /.modal -->
                <?= form_close(); ?>
                
                
                <?= form_open(base_url('admin/materi/soft_delete/'."/".$materi['has_materi']));
                echo csrf_field();
                $detik_mulai    = strtotime($materi['waktu_mulai']);
                $detik_selesai  = strtotime($materi['waktu_selesai']);
                ?>
                    <div class="modal fade" id="delete-<?= $materi['has_materi']?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Delete Materi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <label class="col-3">Materi</label>
                                        <div class="col-9 row">
                                            <input type="text" class="form-control form-control-sm" value="<?= $materi['materi']?>" required name="materi">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-3">Pemateri</label>
                                        <div class="col-9 row">
                                            <select class="form-control form-control-sm" name="pemateri">
                                                <option value="<?= $materi['pemateri']?>"><?= $materi['nama']?></option>
                                                <?php
                                                foreach($user as $u){
                                                ?>
                                                <option value="<?= $u['id_user']?>"><?= $u['nama']?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3">Waktu</label>
                                        <div class="col-md-9 row">
                                            <input type="text" class="form-control form-control-sm tanggal col-sm-3" value="<?= date('d-m-Y', $detik_mulai)?>" name="tanggal_mulai">
                                            <input type="text" class="form-control form-control-sm jam col-sm-2" value="<?= date('H:i', $detik_mulai)?>" name="jam_mulai">
                                            <label class="col-sm-2">SD</label>
                                            <input type="text" class="form-control form-control-sm tanggal col-sm-3" value="<?= date('d-m-Y', $detik_selesai)?>" name="tanggal_selesai">
                                            <input type="text" class="form-control form-control-sm jam col-sm-2" value="<?= date('H:i', $detik_selesai)?>" name="jam_selesai">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3">Blokir</label>
                                        <div class="col-md-9 row">
                                            <select class="form-control form-control-sm" name="blokir">
                                                <option value="1">Ya</option>
                                                <option value="0">Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                <!-- /.modal -->
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark">
                <b>Bahan Ajar</b>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-6">
                        <a href="<?= base_url('admin/materi_file/file/'.$materi['has_materi'])?>" class="btn btn-sm btn-primary">Tambah Media File</a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="<?= base_url('admin/materi_file/video/'.$materi['has_materi'])?>" class="btn btn-sm btn-danger">Tambah Media Video</a>
                    </div>
                </div>
                <table class="table table-sm table-striped">
                    <tr>
                        <th>#</th>
                        <th>Nama File</th>
                        <th>Hit</th>
                    </tr>
                    <?php
                    $no =1;
                    foreach($materi_file as $mf):
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>

                            <?php
                            if($mf['id_file'] !=0){
                                echo $mf['judul_file'];
                            }else{
                                echo $mf['judul_video'];
                            }
                            ?>
                        </td>
                        <td><?= $mf['hits']?></td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
        
    </div>
</div>
<div class="card-footer">
    <a href="<?= base_url('admin/kelas/detail/'.$kelas->has_kelas)?>" class="btn btn-sm btn-primary">Kembali</a>
</div>