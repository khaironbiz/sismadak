
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-success">
                    <b>Rincian Pokja</b>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <tr>
                            <td>Kelompok</td>
                            <td>:</td>
                            <td class="w-75"><?= $kelompok['kelompok_standar']?></td>
                        </tr>
                        <tr>
                            <td>Pokja</td>
                            <td>:</td>
                            <td class="w-75"><?= $count_kelompok?></td>
                        </tr>
                        <tr>
                            <td>Fokus Penilaian</td>
                            <td>:</td>
                            <td class="w-75"></td>
                        </tr>
                        <tr>
                            <td>Standar</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>EP Standar</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Sub Standar</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>EP Sub Standar</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                    </table>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <a href="<?= base_url('admin/kelompok/edit/'.$kelompok['has_kelompok_standar'])?>" class="btn btn-sm btn-success">Edit</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

