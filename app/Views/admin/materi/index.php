
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-sm" id="example1">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Materi</th>
					<th>Pemateri</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($materi as $materi) { 
					
				?>
				<tr>
					<td><?= $no ?></td>
					<td>
						<?= $materi['materi'] ?><br>
						<small><?= $materi['nama_kelas']?></small>
					</td>
					<td>
						<?= $materi['nama']?>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		<a href="<?= base_url()?>/admin/organisasi_profesi" class="btn btn-sm btn-primary">Master Organisasi</a>
	</div>
</div>