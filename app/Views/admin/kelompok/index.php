<div class="row">

	<div class="col-md-10">
        <a href="<?= base_url('admin/kelompok/tambah')?>" class="btn btn-sm btn-primary mb-2">Tambah</a>
		<table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kelompok Standar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach ($kelompok as $kelompok):
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $kelompok['kelompok_standar']?></td>
                    <td><a href="<?= base_url('admin/kelompok/detail/'.$kelompok['has_kelompok_standar'])?>" class="btn btn-sm btn-info">Detail</a></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
	</div>
