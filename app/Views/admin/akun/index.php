<div class="row">
	<div class="col-md-2 mb-1">
		<?php
        $gambar_profil = base_url('assets/upload/image/user3-128x128.jpg');
		?>
		<img src="<?= $gambar_profil?>" class="img img-thumbnail w-100">
	</div>
	<div class="col-md-10">
		<form action="<?= base_url('admin/akun/update/'.$user['kode']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<?= csrf_field();
            ?>
			<input type="hidden" name="id_user" value="<?= $user['id'] ?>">
			<div class="form-group row">
				<label class="col-3">Nama</label>
				<div class="col-9">
					<input type="text" name="nama" class="form-control" placeholder="Nama user" value="<?= $user['nama'] ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-3">Email</label>
				<div class="col-9">
					<input type="email" name="email" class="form-control" placeholder="Email" value="<?= $user['email'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Password</label>
				<div class="col-9">
					<input type="text" name="password" class="form-control" placeholder="Password" value="">
					<small class="text-danger">Minimal 6 karakter dan maksimal 32 karakter atau biarkan kosong</small>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3"></label>
				<div class="col-9">
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
