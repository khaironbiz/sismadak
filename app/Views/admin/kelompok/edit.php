
<form action="<?= base_url('admin/kelompok/update/'.$kelompok['has_kelompok_standar']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <?php
    echo csrf_field();
    ?>
    <div class="row mt-2">
        <label class="col-2 col-md-1">No</label>
        <label class="col-10 col-md-11">Kelompok</label>
        <div class="col-2 col-md-1">
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
        <div class="col-10 col-md-11">
            <input type="text" name="kelompok_standar" class="form-control form-control-sm" value="<?= $kelompok['kelompok_standar']?>" required>
        </div>

    </div>

    <div class="row mt-2">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
    <?= form_close(); ?>

