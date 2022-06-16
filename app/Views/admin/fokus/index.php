

<div class="row">

	<div class="col-md-10">
        <a href="<?= base_url('admin/fokus/tambah')?>" class="btn btn-sm btn-primary mb-2">Tambah</a>
		<table class="table table-sm table-striped" id="example3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Norut</th>
                    <th>Pokja</th>
                    <th>Nama Fokus</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php

            use App\Models\Pokja_model;
            $m_pokja = new Pokja_model();
            $no = 1;
            foreach ($fokus as $fokus):
                $pokja = $m_pokja->find($fokus['id_pokja']);
                ?>
                <tr>
                    <td><?= $no++?></td>
                    <td><?= $fokus['norut']; ?></td>
                    <td><a href="<?= base_url('admin/fokus/pokja/'.$pokja['has_pokja'])?>" class="text-dark"><?= $pokja['nama_pokja']?></a></td>
                    <td><?= $fokus['nama_fokus']?></td>
                    <td><a href="<?= base_url('admin/fokus/detail/'.$fokus['has_fokus'])?>" class="btn btn-sm btn-info">Detail</a></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
	</div>
