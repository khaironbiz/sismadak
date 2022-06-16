
<form action="<?= base_url('admin/pokja/create') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <?php
    echo csrf_field();
    ?>
    <div class="row mt-2">
        <label class="col-2 col-md-1">No</label>
        <label class="col-10 col-md-11">Nama Pokja</label>
        <div class="col-2 col-md-1">
            <select class="form-control form-control-sm" name="norut">
                <?php
                for ($x = 1; $x <= 50; $x++) {
                    ?>
                    <option value="<?= $x?>"
                        <?php
                        $norut_baru = $total+1;
                        if($norut_baru == $x){echo "selected";}
                        ?>
                    ><?= $x?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-10 col-md-11">
            <input type="text" name="nama_pokja" class="form-control form-control-sm" placeholder="nama pokja" value="<?= set_value('nama_pokja') ?>" required>
        </div>

    </div>
    <div class="row mt-2">
        <label class="col-12">Kelompok</label>
        <div class="col-12">
            <select class="form-control form-control-sm" name="id_kelompok" required>
                <option value="">---Pilih---</option>
                <?php
                foreach ($kelompok as $kelompok) {
                    ?>
                    <option value="<?= $kelompok['id_kelompok_standar']?>"><?= $kelompok['kelompok_standar']?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <label class="col-12">Gambaran Umum</label>
        <div class="col-12">
            <textarea class="form-control konten" name="penjelasan"></textarea>
        </div>
    </div>
    <div class="row mt-2">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
    <?= form_close(); ?>

