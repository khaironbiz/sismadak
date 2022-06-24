<a href="<?= base_url('admin/penilaian/tambah')?>" class="btn btn-primary">Tambah</a>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Penilaian</th>
            <th>Count</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $x=1;
    foreach ($penilaian as $penilaian):
    ?>
        <tr>
            <td><?= $x++;?></td>
            <td><?= $penilaian['nama_penilaian']?></td>
            <td></td>
            <td><a href="#" class="btn btn-sm btn-info">Detail</a></td>
        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>