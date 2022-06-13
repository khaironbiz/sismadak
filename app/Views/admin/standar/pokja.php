
<table class="table table-sm table-striped" id="example1">
    <thead>
        <tr>
            <th>#</th>
            <th>Standar</th>
            <th>Elemen Penilaian</th>
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
            <td><?= $standar['nama_standar']?></td>
            <td></td>
            <td><a href="<?= base_url('admin/standar/detail/'.$standar['has_standar'])?>" class="btn btn-sm btn-info">Detail</a></td>

        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>

