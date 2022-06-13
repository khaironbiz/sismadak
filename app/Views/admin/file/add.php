
<form action="<?= base_url('admin/file/create_to_materi/'.$materi['has_materi']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php
	echo csrf_field();
?>
<div class="row justify-content-center">
	<div class="col-md-6">
			<div class="card">
				<div class="card-header text-center bg-success">
					<b>Menambahkan File</b>
				</div>
				<div class="card-body">
					<div class="row mt-2">
						<label class="col-md-3">Judul File</label>
						<div class="col-md-9 row">
							<input type="text" name="judul_file" class="form-control form-control-sm" placeholder="Judul file" value="<?= set_value('judul_file') ?>" required>
							
						</div>
					</div>
					<div class="row mt-2">
						<label class="col-md-3">File</label>
						<div class="col-md-9 row">
							<input type="file" name="gambar" class="form-control form-control-sm" required>
							
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
	</div>
</div>
<?= form_close(); ?>

			