<p>
	<button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah
	</button>
</p>
<?= form_open(base_url('admin/profesi/create'));
echo csrf_field();
?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Profesi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row mt-2">
					<label class="col-md-3">Nama Profesi</label>
					<div class="col-md-9 row">
						<input type="text" name="nama_profesi" class="form-control form-control-sm" placeholder="nama profesi" value="<?= set_value('nama_profesi') ?>" required>
						
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