<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Elemen Penilaian</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $x=1;
    foreach ($ep as $ep)
    ?>
        <tr>
            <td><?= $x++?></td>
            <td><?= $ep['nama_ep']?></td>
            <td><a href="<?= base_url('admin/ep/detail/'.$ep['has_ep'])?>" class="btn btn-sm btn-info">Detail</a></td>
        </tr>
    </tbody>
</table>