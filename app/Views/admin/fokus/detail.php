
<div class="row">
    <div class="col-md-6">
        <div class="card">

            <div class="card-body">
                <table class="table table-sm table-striped">
                    <tr>
                        <td>Pojka</td>
                        <td>:</td>
                        <td><?= $pokja['nama_pokja']?></td>
                    </tr>
                    <tr>
                        <td>Fokus Penilaian</td>
                        <td>:</td>
                        <td><?= $fokus['nama_fokus']?></td>
                    </tr>
                    <tr>
                        <td>Standar</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Elemen Penilaian</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sub Standar</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Elemen Penilaian</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('admin/fokus/edit/'.$fokus['has_fokus'])?>" class="btn btn-sm btn-success">Edit</a>
                <a href="#" class="btn btn-sm btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>