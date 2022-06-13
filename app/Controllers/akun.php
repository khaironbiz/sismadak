<?php

namespace App\Controllers;

use App\Models\Client_model;
use App\Models\Kelas_model;
use App\Models\Kelas_peserta_model;
use App\Models\Konfigurasi_model;
use App\Models\Materi_model;

class Akun extends BaseController
{

    // kelas yang dimiliki oleh user
    public function index(){
//        checklogin();
        // $session        = \Config\Services::session();
        $id_user        = $this->session->get('id_user');
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_peserta      = new Kelas_peserta_model();
        $peserta        = $m_peserta->list_by_id_user($id_user);
        $data           = [
            'title'         => 'Dashboard',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $peserta,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'akun/index',
        ];
        echo view('layout/wrapper', $data);
    }
    // all
    public function soon(){
        checklogin();
        // $session        = \Config\Services::session();
        $id_user        = $this->session->get('id_user');
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_peserta      = new Kelas_peserta_model();
        $peserta        = $m_peserta->list_by_id_user_soon($id_user);
        $data           = [
            'title'         => 'Kelas Saya',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $peserta,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/index',
        ];
        echo view('layout/wrapper', $data);
    }
    // may room class
    public function room($has_kelas){
        checklogin();
        // $session        = \Config\Services::session();
        $id_user        = $this->session->get('id_user'); 
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $m_kelas        = new Kelas_model();       
        $kelas          = $m_kelas->by_has_kelas($has_kelas);
        $id_kelas       = $kelas->id_kelas;
        $m_materi       = new Materi_model();
        $materi         = $m_materi->list_id_kelas($id_kelas);
//        var_dump($kelas);
        $data           = [
            'title'         => 'Kelas Saya',
            'description'   => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => 'Client Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'kelas'         => $kelas,
            'materi'        => $materi,
            'konfigurasi'   => $konfigurasi,
            'content'       => 'kelas/room',
        ];
        echo view('layout/wrapper', $data);
    }
}
