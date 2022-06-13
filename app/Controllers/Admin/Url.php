<?php

namespace App\Controllers\Admin;

use App\Models\Url_model;

class Url extends BaseController
{
    // mainpage
    public function index()
    {
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_url      = new Url_model();
        $url        = $m_url->listing($id_user);
        $total      = $m_url->total();
        
        $data = [
            'title'     => 'List Url ('.$total.')',
            'url'       => $url,
            'content'   => 'admin/url_short/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }
    //tambah data
    public function tambah(){
        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_url      = new Url_model();
        $url        = $m_url->listing($id_user);
        $total      = $m_url->total();
        // Start validasi
        if ($this->request->getMethod() === 'post' ){
            // 'url_asli'  => 'required|min_length[3]|valid_url',
            // 'short' => 'required|min_length[3]|is_unique[url.short]|alpha_numeric_punct',
            if (!$this->validate([
                'url_asli' => [
                    'rules' => 'required|min_length[10]|valid_url_strict[https]',
                    'errors' => [
                        'required'          => 'URL Asli Harus diisi',
                        'min_length'        => 'URL Asli minimal 10 karakter',
                        'valid_url_strict'  => 'URL yang anda input : '.$this->request->getPost('url_asli').' Tidak valid'
                    ]
                ],
                'short' => [
                    'rules'             => 'required|min_length[3]|is_unique[url.short]|alpha_numeric',
                    'errors'            => [
                        'required'      => '{field} Harus diisi',
                        'min_length'    => 'Short URL minimal 3 karakter',
                        'is_unique'     => 'Short URL sudah terdaftar, gunakan short url lain',
                        'alpha_numeric' => 'Karakter pada short url hanya angka dan huruf'
                    ]
                ]
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }else{
                $url_asli       = $this->request->getPost('url_asli');
                $short          = $this->request->getPost('short');
                $count          = $m_url->count($short);
                $data           = [                
                    'url_asli'      => $url_asli,
                    'short'         => $short,
                    'created_by'    => $this->session->get('id_user'),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'has_url'       => md5(uniqid())
                ];
                $m_url->save($data);
                // masuk database
                $this->session->setFlashdata('sukses', 'Data telah ditambah');
                return redirect()->to(base_url('admin/url'));
                // var_dump($count);
            }
        }else{
            $this->session->setFlashdata('warning', 'INVALID AKSES');
            return redirect()->to(base_url('admin/url'));
        }
        
        //return redirect()->to(base_url('a/b/'.$short));
    }
    //tambah data
    public function pengkinian($has_url){
        checklogin();
        $session       = \Config\Services::session();
        $id_user    = $this->session->get('id_user');
        $m_url      = new Url_model();
        $url        = $m_url->has_url($has_url);
        $id_url     = $url['id_url'];
        $short      = $this->request->getPost('short');
        $count      = $m_url->count($short);
        $total      = $m_url->total();
        // var_dump($count);
        // Start validasi
        if ($this->request->getMethod() === 'post' ) {
            // masuk database
            if(! $this->validate(
                [
                    'url_asli'  => [
                        'rules'     => 'required|min_length[10]|valid_url',
                        'errors'    => [
                            'required'      => 'URL Asli Harus diisi',
                            'min_length'    => 'URL Asli minimal 10 Karakter',
                        ]
                        ],
                    
                    'short'     => [
                        'rules'     => 'required|min_length[3]|is_unique[url.short]|alpha_numeric',
                        'errors'    => [
                            'required'      => 'Short URL Harus diisi',
                            'min_length'    => 'Short URL minimal 3 Karakter',
                            'is_unique'     => 'Short URL Sudah terdaftar, gunakan short url lain',
                            'alpha_numeric' => 'Short URL Hanya memuat karakter huruf dan angka'
                        ]
                    ]
                    
                ]
            )){
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            
            }else{
                $url_asli       = $this->request->getPost('url_asli');
                $data           = [ 
                    'url_asli'      => $url_asli,
                    'short'         => $short,
                    'updated_at'    => date('Y-m-d H:i:s'),
                ];
                $m_url->update($id_url, $data);
                // masuk database
                $this->session->setFlashdata('sukses', 'Data telah diupdate');
                return redirect()->to(base_url('admin/url'));
            }
            
        }else{
            $this->session->setFlashdata('warning', 'AKSES ILEGAL');
                return redirect()->to(base_url('admin/url'));
        }
        //return redirect()->to(base_url('a/b/'.$short));
    }

    // edit
    public function edit($has_kategori_kelas)
    {
        checklogin();
        $m_kategori_kelas   = new Kategori_kelas_model();
        $kategori_kelas     = $m_kategori_kelas->detail($has_kategori_kelas);
        $total              = $m_kategori_kelas->total();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'kategori_kelas' => 'required|min_length[3]',
            ]
        )) {
            // masuk database
            $id_kategori_kelas = $kategori_kelas['id_kategori_kelas'];
            $slug = url_title($this->request->getPost('kategori_kelas'), '-', true);
            $data = [
                'kategori_kelas'        => $this->request->getPost('kategori_kelas'),
                'slug_kategori_kelas'   => $slug,
                'updated_at'            => date('Y-m-d H:i:s'),
                'urutan'                => $this->request->getPost('urutan'),
            ];
            
            $update_kategori_kelas = $m_kategori_kelas->update($id_kategori_kelas, $data);
            // masuk database
            if(isset($update_kategori_kelas)){
                $this->session->setFlashdata('sukses', 'Data sukses diedit');
            }else{
                $this->session->setFlashdata('danger', 'Data gagal diedit');
            }
            
            return redirect()->to(base_url('admin/kategori_kelas'));
        }
        $data = [
            'title'             => 'Edit Kategori kelas: ' . $kategori_kelas['kategori_kelas'],
            'kategori_kelas'    => $kategori_kelas,
            'content'           => 'admin/kategori_kelas/edit',
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
