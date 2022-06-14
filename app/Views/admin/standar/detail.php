<a href="<?= base_url('admin/standar/edit/'. $standar['has_standar'])?>" class="btn btn-sm btn-success" >Edit Standar</a>
<br>
<b>Standar</b><br>
<?= $standar['nama_standar']?><br>
<b>Maksud dan Tujuan</b><br>
<?= $standar['penjelasan']?><br>

<b>Elemen Penilaian</b><br>
<a href="<?= base_url('admin/ep/standar/'.$standar['has_standar']) ?>" class="btn btn-sm btn-primary mb-2">Tambah Elemen Penilaian</a>
<table class="table table-sm table-striped" id="example3">
    <thead>
        <tr>
            <th>#</th>
            <th>Elemen Penilaian</th>
            <th>Jenis Bukti</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $x=1;
    foreach ($ep as $ep):
    ?>
        <tr>
            <td><?= $x++; ?></td>
            <td class="w-75"><?= $ep['nama_ep']; ?></td>
            <td></td>
            <td><a href="<?= base_url('admin/ep/detail/'.$ep['has_ep'])?>" class="btn btn-sm btn-info">Detail</a></td>
        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>
