<?php

namespace App\Controllers\Admin;

use App\Models\Kelompok_standar_model;
use App\Models\User_model;
use App\Models\Pokja_model;
use App\Models\Pokja_ep_model;
use App\Models\Pokja_standar_model;
use App\Models\Pokja_penilaian_model;

class Penilaian extends BaseController
{
    public function __construct(){
        $this->email = \Config\Services::email();
    }
    public function index()
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_penilaian= new Pokja_penilaian_model();
        $penilaian  = $m_penilaian->findAll();
        $data = [
            'title'     => 'Penilaian Akreditasi Rumah Sakit',
            'penilaian' => $penilaian,
            'content'   => 'admin/penilaian/index',
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    //tambah data penilaian
    public function tambah(){
        $id_user        = $this->session->get('id_user');
        $m_penilaian    = new Pokja_penilaian_model();
        $data           = [
            'title'     => "Tambah Penilaian",
            'content'   => "admin/penilaian/tambah"
        ];
        echo view('admin/layout/wrapper', $data);
    }
}
