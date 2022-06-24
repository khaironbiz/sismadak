<a href="<?= base_url('admin/standar/edit/'. $standar['has_standar'])?>" class="btn btn-sm btn-success" >Edit Standar</a>
<br>
<b>Standar</b><br>
<?= $standar['nama_standar']?><br>
<b>Maksud dan Tujuan</b><br>
<?= $standar['penjelasan']?><br>
<b>Elemen Penilaian</b><br>
    <?php
    $x=1;
    foreach ($ep as $ep):
    ?>
    <li><?= $ep['nama_ep']; ?></li>
    <?php
    endforeach;
    ?>
    <a href="<?= base_url('admin/ep/standar/'.$standar['has_standar']) ?>" class="btn btn-sm btn-primary mb-2">Tambah Elemen Penilaian</a>

