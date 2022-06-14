<a href="<?= base_url('admin/standar/add_pokja/'.$pokja['has_pokja'])?>" class="btn btn-sm btn-primary mb-3">Tambah</a>
<table class="table table-sm table-striped" id="example1">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Urut</th>
            <th class="w-75">Standar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $x=1;
    foreach ($standar as $standar):
    ?>
        <tr>
            <td><?= $x++?></td>
            <td><?= $standar['norut']?></td>
            <td><?= $standar['nama_standar']?></td>
            <td><a href="<?= base_url('admin/standar/detail/'.$standar['has_standar'])?>" class="btn btn-sm btn-info">Detail</a></td>

        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>

