
<form action="<?= base_url('admin/standar/update/'.$standar['has_standar']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <?php
    echo csrf_field();
    ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center bg-success">
                    <b>Update Standar</b>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <label class="col-12">Nama Pokja</label>
                        <div class="col-12">
                            <select class="form-control form-control-sm">
                                <option value="<?= $pokja['id_pokja']?>"><?= $pokja['nama_pokja']?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label class="col-12">Nama Standar</label>
                        <div class="col-12">
                            <input type="text" name="nama_standar" class="form-control form-control-sm" value="<?= $standar['nama_standar']?>" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label class="col-12">Nomor Urut Standar</label>
                        <div class="col-12">
                            <select class="form-control form-control-sm" name="norut">
                                <?php
                                for ($x = 0; $x <= 50; $x++) {
                                ?>
                                <option value="<?= $x?>"
                                    <?php
                                    if($x == $standar['norut']){echo "selected";}
                                    ?>
                                ><?= $x?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label class="col-12">Maksud dan Tujuan</label>
                        <div class="col-12">
                            <textarea name="penjelasan" class="form-control konten" rows="5"><?= $standar['penjelasan']?></textarea>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-center">

                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close(); ?>

