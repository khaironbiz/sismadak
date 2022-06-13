<?= form_open(base_url('admin/kategori_kelas/edit/' . $kategori_kelas['has_kategori_kelas']));
echo csrf_field();
?>

<div class="form-group row">
	<label class="col-3">Kategori kelas</label>
	<div class="col-9">
		<input type="text" name="kategori_kelas" class="form-control" placeholder="Kategori_kelas" value="<?= $kategori_kelas['kategori_kelas'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Nomor urut Kategori kelas</label>
	<div class="col-4">
		<input type="number" name="urutan" class="form-control" placeholder="Nomor urut" value="<?= $kategori_kelas['urutan'] ?>" required>
		<input type="hidden" name="aksi" class="form-control form-control-sm" value="edit_profesi" required>
	</div>
	
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?= form_close(); ?>