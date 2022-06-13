<?php

namespace App\Controllers\Admin;

use App\Models\File_hitter_model;

class File_hitter extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_file_hitter  = new File_hitter_model();
        $file_hitter    = $m_file_hitter->listing();
        
        $data = [
            'title'         => 'Hitter File',
            'file_hitter'   => $file_hitter,
            'content'       => 'admin/file_hitter/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }
    // mainpage
    public function user()
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_file_hitter  = new File_hitter_model();
        $file_hitter    = $m_file_hitter->list_id_user($id_user);

        $data = [
            'title'         => 'Hitter File',
            'file_hitter'   => $file_hitter,
            'content'       => 'admin/file_hitter/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }
    // delete
    public function delete($has_kategori_kelas)
    {
        checklogin();
        $m_kategori_kelas   = new Kategori_kelas_model();
        $kategori_kelas     = $m_kategori_kelas->detail($has_kategori_kelas);
        $id_kategori_kelas  = $kategori_kelas['id_kategori_kelas'];
        $data               = [
            'id_kategori_kelas' => $id_kategori_kelas,
            'deleted_at'        => date('Y-m-d H:i:s'),
        ];
        $m_kategori_kelas->update($id_kategori_kelas, $data);
        // masuk database
        $this->session->setFlashdata('sukses', 'Data telah dihapus');
        return redirect()->to(base_url('admin/kategori_kelas'));
    }
    
}
