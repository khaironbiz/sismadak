<div class="row">

	<div class="col-md-10">
        <a href="<?= base_url('admin/pokja/tambah')?>" class="btn btn-sm btn-primary mb-2">Tambah</a>
		<table class="table table-sm table-striped" id="example1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pokja</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach ($pokja as $pokja):
                ?>
                <tr>
                    <td><?= $no++?></td>
                    <td>
                        <?= $pokja['norut'].". ".$pokja['nama_pokja']?><br>
                        <small><?= $pokja['kelompok_standar']?></small>
                    </td>
                    <td><a href="<?= base_url('admin/pokja/detail/'.$pokja['has_pokja'])?>" class="btn btn-sm btn-info">Detail</a></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
	</div>
