
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-success">
                    <b>Rincian Pokja</b>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <tr>
                            <td>Nama Pokja</td><td>:</td><td><?= $pokja['nama_pokja']?></td>
                        </tr>
                        <tr>
                            <td>Standar</td><td>:</td><td><a href="<?= base_url('admin/standar/pokja/'.$pokja['has_pokja'])?>" class="btn btn-sm btn-info">Detail</a></td>
                        </tr>
                        <tr>
                            <td>EP Standar</td><td>:</td><td><?= $pokja['nama_pokja']?></td>
                        </tr>
                        <tr>
                            <td>Sub Standar</td><td>:</td><td><?= $pokja['nama_pokja']?></td>
                        </tr>
                        <tr>
                            <td>EP Sub Standar</td><td>:</td><td><?= $pokja['nama_pokja']?></td>
                        </tr>
                    </table>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <a href="<?= base_url('admin/pokja/edit/'.$pokja['has_pokja'])?>" class="btn btn-sm btn-success">Edit</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

