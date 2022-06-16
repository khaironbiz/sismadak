
<form action="<?= base_url('admin/standar/create_pokja/'.$pokja['has_pokja']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <?php
    echo csrf_field();
    ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center bg-success">
                    <b>Tambah Standar</b>
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
                        <label class="col-12">Nomor Urut</label>
                        <div class="col-12">
                            <select class="form-control form-control-sm" name="norut">
                                <?php
                                for ($x = 1; $x <= 50; $x++) {
                                    ?>
                                    <option value="<?= $x?>"><?= $x?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="row mt-2">
                        <label class="col-12">Nama Standar</label>
                        <div class="col-12">
                            <input type="text" name="nama_standar" class="form-control form-control-sm" placeholder="nama standar" value="<?= set_value('nama_standar') ?>" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label class="col-12">Maksud dan Tujuan</label>
                        <div class="col-12">
                            <textarea name="penjelasan" class="form-control konten" rows="5"></textarea>
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

