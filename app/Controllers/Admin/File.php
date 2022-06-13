<?php

namespace App\Controllers\Admin;

use App\Models\File_model;
use App\Models\Materi_model;

class File extends BaseController
{
    // index
    public function index()
    {
        checklogin();
        admin();
        $id_user            = $this->session->get('id_user');
        $m_file             = new File_model();
        $file               = $m_file->listing();
        $data = [
            'title'         => 'Kumpulan File Bahan Ajar',
            'file'          => $file,
            'content'       => 'admin/file/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // index
    public function tambah(){
        checklogin();
        admin();
        $id_user            = $this->session->get('id_user');
        $m_file             = new File_model();
        $file               = $m_file->listing();
        $data = [
            'title'         => 'Add File',
            'file'          => $file,
            'content'       => 'admin/file/tambah',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // index
    public function add($has_materi){
        checklogin();
        admin();
        $id_user            = $this->session->get('id_user');
        $m_materi           = new Materi_model();
        $materi             = $m_materi->has_materi($has_materi);
        $m_file             = new File_model();
        $file               = $m_file->listing();
        $data = [
            'title'         => 'Add File',
            'file'          => $file,
            'materi'        => $materi,
            'content'       => 'admin/file/add',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // kategori
    public function kategori($id_kategori){
        checklogin();
        admin();
        $m_berita   = new Berita_model();
        $m_kategori = new Kategori_model();
        $kategori   = $m_kategori->detail($id_kategori);
        $berita     = $m_berita->kategori_all($id_kategori);
        $total      = $m_berita->total_kategori($id_kategori);

        $data = ['title' => $kategori['nama_kategori'] . ' (' . $total . ')',
            'berita'     => $berita,
            'content'    => 'admin/berita/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    // save add
    public function create(){
        checklogin();
        admin();
        $id_user        = $this->session->get('id_user');
        $m_file         = new File_model();
        // Start validasi
        if ($this->request->getMethod() === 'post') 
            if (!$this->validate([
                'gambar'  => [
                    'rules'     => 'ext_in[gambar,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx]',
                    'errors'    => [
                        
                        'ext_in'        => 'File yang dizinkan adalah : png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx'
                    ]
                ],
                'judul_file'    => [
                    'rules'     => 'required|min_length[5]',
                    'errors'    => [
                        'required'      => 'Judul File Wajib diisi',
                        'min_length'    => 'Judul file minimal 5 karakter'
                    ]
                ],
            ])){
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }else{
                if (! empty($_FILES['gambar']['name'])) {
                    // Image upload
                    $avatar   = $this->request->getFile('gambar');
                    $namabaru = uniqid().str_replace(' ', '-', $avatar->getName());
                    $avatar->move('assets/upload/file/', $namabaru);
                    // masuk database
                    $data = [
                        'judul_file'        => $this->request->getVar('judul_file'),
                        'nama_file'         => $namabaru,
                        'created_by'        => $this->session->get('id_user'),
                        'created_at'        => date('Y-m-d H:i:s'),
                        'has_file'          => md5(uniqid()),
                    ];
                    $m_file->tambah($data);
                    return redirect()->to(base_url('admin/file'))->with('sukses', 'Data Berhasil di Simpan');
                }
                return redirect()->to(base_url('admin/file'))->with('warning', 'Invalid URL');
                
            }
        session()->setFlashdata('error', $this->validator->listErrors());
        return redirect()->back()->withInput();
    }
    public function create_to_materi($has_materi){
        checklogin();
        admin();
        $id_user        = $this->session->get('id_user');
        $m_file         = new File_model();
        // Start validasi
        if ($this->request->getMethod() === 'post') 
            if (!$this->validate([
                'gambar'  => [
                    'rules'     => 'ext_in[gambar,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx]',
                    'errors'    => [
                        
                        'ext_in'        => 'File yang dizinkan adalah : png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx'
                    ]
                ],
                'judul_file'    => [
                    'rules'     => 'required|min_length[5]',
                    'errors'    => [
                        'required'      => 'Judul File Wajib diisi',
                        'min_length'    => 'Judul file minimal 5 karakter'
                    ]
                ],
            ])){
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }else{
                if (! empty($_FILES['gambar']['name'])) {
                    // Image upload
                    $avatar     = $this->request->getFile('gambar');
                    $namabaru   = uniqid().str_replace(' ', '-', $avatar->getName());
                    $avatar->move('assets/upload/file/', $namabaru);
                    $has_file   = md5(uniqid());
                    // masuk database
                    $data = [
                        'judul_file'        => $this->request->getVar('judul_file'),
                        'nama_file'         => $namabaru,
                        'created_by'        => $this->session->get('id_user'),
                        'created_at'        => date('Y-m-d H:i:s'),
                        'has_file'          => $has_file, 
                    ];
                    $m_file->tambah($data);
                    return redirect()->to(base_url('admin/materi_file/file/'.$has_materi))->with('sukses', 'Data Berhasil di Simpan');
                }
                return redirect()->to(base_url('admin/file'))->with('warning', 'Invalid URL');
                
            }
        session()->setFlashdata('error', $this->validator->listErrors());
        return redirect()->back()->withInput();
    }
    public function update($has_materi){
        checklogin();
        admin();
        $m_kategori = new Kategori_model();
        $m_kelas    = new kelas_model();
        $m_materi   = new Materi_model();
        $m_berita   = new Berita_model();
        $kategori   = $m_kategori->listing();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'materi'    => 'required|min_length[6]',
                'pemateri'  => 'required|numeric',
            ]
        )) {
            
            $waktu_mulai    = date ('Y-m-d H:i:s', strtotime($this->request->getVar('tanggal_mulai')." ".$this->request->getVar('jam_mulai')));
            $waktu_selesai  = date ('Y-m-d H:i:s', strtotime($this->request->getVar('tanggal_selesai')." ".$this->request->getVar('jam_selesai')));
            $materi         = $m_materi->has_materi($has_materi);
            $id_materi      = $materi['id_materi'];
            $id_event       = $materi['id_event'];
            $berita         = $m_berita->by_id($id_event);
            $data           = [
                'materi'        => $this->request->getVar('materi'),
                'pemateri'      => $this->request->getVar('pemateri'),
                'waktu_mulai'   => $waktu_mulai,
                'waktu_selesai' => $waktu_selesai,
                'updated_at'    => date('Y-m-d H:i:s'),
                'blokir'        => $this->request->getVar('blokir'),
            ];
            $m_materi->update($id_materi, $data);
            return redirect()->to(base_url('admin/event/detail/'."/".$berita['has_berita']))->with('sukses', 'Data Berhasil di Simpan');;
        //    var_dump($materi) ;
        }
    }
    // Unduh
    public function unduh($has_file){
        $m_file     = new File_model();
        $file       = $m_file->has_file($has_file);
        // Update hits
        $data = [
            'id_file'   => $file['id_file'],
            'hit_file'  => $file['hit_file'] + 1,
        ];
        $update_hit = $m_file->edit($data);

        // Update hits
        return $this->response->download('assets/upload/file/' . $file['nama_file'], null);
    }
}
