<?php include 'tambah.php'; ?>
<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Username</th>
			<th>Email</th>
			<th>Level</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;

foreach ($user as $user) { ?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $user['nama'] ?></td>
			<td><?= $user['username'] ?></td>
			<td><?= $user['email'] ?></td>
			<td><?= $user['akses_level'] ?></td>
			<td>
				<a href="<?= base_url('admin/user/edit/' . $user['has_user']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a href="<?= base_url('admin/user/delete/' . $user['has_user']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>