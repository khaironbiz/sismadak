<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= base_url('/admin/tugas_kelas') ?>">Tugas Kelas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kelas')?>" target="_blank">Kelas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/tugas')?>">Kategori Tugas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/tugas_metode')?>">Metode Penugasan</a>
            </li>

        </ul>
    </div>
</nav>