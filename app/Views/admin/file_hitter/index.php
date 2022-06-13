<?php 

use App\Models\Organisasi_profesi_model;
?>
<div class="row">
	<div class="col-md-8">

		<table class="table table-bordered table-sm" id="example3">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul File</th>
					<th>Time</th>
                    <th>IP</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				
				foreach ($file_hitter as $fh) {
					
				?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $fh['id_file_hitter'] ?></td>
                    <td></td>
					<td><?= $fh['ip'] ?></td>

					
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		
	</div>
</div>