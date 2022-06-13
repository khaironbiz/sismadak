<a href="<?= base_url('admin/standar/edit/'. $standar['has_standar'])?>" class="btn btn-sm btn-success" >Edit</a>
<br>
<b>Standar : <?= $standar['nama_standar']?></b><br>
<b>Maksud dan Tujuan</b><br>
<?= $standar['penjelasan']?><br>

<b>Elemen Penilaian</b><br>
<table class="table table-sm table-striped" id="example1">
    <thead>
        <tr>
            <th>#</th>
            <th>Elemen Penilaian</th>
            <th>Jenis Bukti</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($ep as $ep):
    ?>
        <tr>
            <td></td>
        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>
