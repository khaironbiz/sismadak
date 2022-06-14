
<form action="<?= base_url('admin/ep/create_standar/'.$standar['has_standar']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <?php
    echo csrf_field();
    ?>
    <div class="row mt-2">
        <label class="col-2 col-md-1">No</label>
        <label class="col-10 col-md-11">Elemen Penilaian</label>
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
            <input type="text" name="nama_ep" class="form-control form-control-sm" placeholder="elemen penilaian" value="<?= set_value('nama_ep') ?>" required>
        </div>

    </div>

    <div class="row mt-2 ">
        <div class="col-md-12 text-center">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </div>
    <?= form_close(); ?>

