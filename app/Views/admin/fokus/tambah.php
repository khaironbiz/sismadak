
<form action="<?= base_url('admin/fokus/create') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                            <select class="form-control form-control-sm" name="id_pokja" required>
                                <option value="">---pilih---</option>
                                <?php
                                foreach ($pokja as $pokja):
                                ?>
                                <option value="<?= $pokja['id_pokja']?>"><?= $pokja['nama_pokja']?></option>
                                <?php
                                endforeach;
                                ?>
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
                        <label class="col-12">Nama Fokus</label>
                        <div class="col-12">
                            <input type="text" name="nama_fokus" class="form-control form-control-sm" placeholder="nama fokus" value="<?= set_value('nama_fokus') ?>" required>
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

