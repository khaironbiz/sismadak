<p>
	<button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>
<?= form_open(base_url('admin/url/tambah'));
echo csrf_field();
?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Perpendek URL</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<label class="col-3">URL Asli</label>
					<div class="col-9 row">
						<input type="text" name="url_asli" class="form-control form-control-sm" placeholder="Url Asli" value="<?= set_value('url_asli') ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3">URL Short</label>
					<div class="col-md-9 row">
						<input type="text" class="form-control form-control-sm col-6 text-right" value="https://hpii.or.id/a/b/" readonly>
						<input type="text" name="short" class="form-control form-control-sm col-6" placeholder="Perpendek" value="<?= set_value('short') ?>" required>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= form_close(); ?>