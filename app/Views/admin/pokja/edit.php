
<form action="<?= base_url('admin/pokja/update/'.$pokja['has_pokja']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <?php
    echo csrf_field();
    ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-success">
                    <b>Tambah Pokja</b>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <label class="col-md-3">Nama Pokja</label>
                        <div class="col-md-9 row">
                            <input type="text" name="nama_pokja" class="form-control form-control-sm" placeholder="nama pokja" value="<?= $pokja['nama_pokja'] ?>" required>

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

