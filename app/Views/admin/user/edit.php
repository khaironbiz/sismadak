<?= form_open(base_url('admin/user/update/' . $user['id_user']));
echo csrf_field();
?>
    <div class="row mt-1">
        <label class="col-md-3">NIK</label>
        <div class="col-md-9">
            <input type="number" name="nik" class="form-control" placeholder="Nomor KTP" value="<?= $user['nik'] ?>" required title="Nomor KTP">
        </div>
    </div>

<div class="row mt-1">
	<label class="col-md-3">Nama Asli</label>
	<div class="col-md-9">
		<input type="text" name="nama" class="form-control" placeholder="Nama user" value="<?= $user['nama'] ?>" required title="Nama sesuai ijazah atau akta kelahiran">
	</div>
</div>
    <div class="row mt-1">
        <label class="col-md-3">Gelar</label>
        <div class="col-md-3">
            <input type="text" name="gelar_depan" class="form-control" placeholder="Gelar Depan" value="<?= $user['gelar_depan'] ?>" title="Gelar depan">
        </div>
        <div class="col-md-6">
            <input type="text" name="gelar_belakang" class="form-control" placeholder="Gelar Belakang" value="<?= $user['gelar_belakang'] ?>" required title="Gelar belakang">
        </div>
    </div>

<div class="mt-1 row">
	<label class="col-md-3">Email</label>
	<div class="col-md-9">
		<input type="email" name="email" class="form-control" placeholder="Email" value="<?= $user['email'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Level & Status</label>
	<div class="col-md-4">
		<select name="akses_level" class="form-control">
			<option value="Admin"
                <?php if ($user['akses_level'] == 'Admin') {
                    echo 'selected';
                } ?>
            >Admin</option>
			<option value="User" <?php if ($user['akses_level'] === 'User') {
    echo 'selected';
} ?>>User</option>
		</select>
	</div>
    <div class="col-md-5">
        <select name="status" class="form-control">
            <option value="0"
                <?php
                if ($user['status'] <1) {
                echo 'selected';
                }
                ?>
            >Blokir</option>
            <option value="1"
                <?php
                if ($user['status'] >0) {
                    echo 'selected';
                }
                ?>
            >Aktif</option>
        </select>
    </div>
</div>

<div class="form-group row">
	<label class="col-md-3"></label>
	<div class="col-md-9">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?= form_close(); ?>