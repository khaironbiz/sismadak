
<table class="table table-sm table-striped" id="example3">
    <thead>
        <tr>
            <th>#</th>
            <th>Kelompok</th>
            <th>Pokja</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $x=1;
    foreach ($pokja as $pokja):
    ?>
        <tr>
            <td><?= $x++?></td>
            <td><?= $kelompok['kelompok_standar']?>
            <td><?= $pokja['nama_pokja']?></td>
            <td><a href="<?= base_url('admin/pokja/detail/'.$pokja['has_pokja'])?>" class="btn btn-sm btn-info">Detail</a></td>
        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>

