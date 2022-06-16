<div class="row">

    <div class="col-md-10">
        <a href="<?= base_url('admin/fokus/addpokja/'.$pokja['has_pokja'])?>" class="btn btn-sm btn-primary">Tambah Fokus Penilaian</a>
        <table class="table table-sm table-striped" id="example3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fokus Penilaian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach ($fokus as $fokus):
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $fokus['nama_fokus']?></td>
                    <td><a href="<?= base_url('admin/fokus/detail/'.$fokus['has_fokus'])?>" class="btn btn-sm btn-info">Detail</a></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
