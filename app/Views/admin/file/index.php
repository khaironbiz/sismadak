<?php 

use App\Models\Organisasi_profesi_model;
?>
<div class="row">
	<div class="col-md-6">
		<a href="<?= base_url('admin/file/tambah')?>" class="btn btn-sm btn-primary mb-2">Tambah</a>
		<table class="table table-bordered table-sm" id="example1">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul File</th>
					<th>Hit</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				
				foreach ($file as $file) { 
					
				?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $file['judul_file'] ?></td>
					<td><?= $file['hit_file'] ?></td>
					<td>
						<a href="<?= base_url()?>/admin/file/unduh/<?= $file['has_file'] ?>" class="btn btn-sm btn-primary">Download</a>
					</td>
					
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		
	</div>
</div>