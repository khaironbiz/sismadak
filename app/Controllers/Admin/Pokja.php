<?php

namespace App\Controllers\Admin;

use App\Models\User_model;
use App\Models\Pokja_model;

class Pokja extends BaseController
{
    public function __construct(){
        $this->email = \Config\Services::email();
    }
    public function index()
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_pokja    = new Pokja_model();
        $pokja      = $m_pokja->findAll();
        $data = [
            'title'     => 'List Pokja',
            'pokja'     => $pokja,
            'content'   => 'admin/pokja/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function detail($has_pokja)
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_pokja    = new Pokja_model();
        $pokja      = $m_pokja->where('has_pokja', $has_pokja)->first();
        $data = [
            'title'     => 'Tambah Pokja',
            'pokja'     => $pokja,
            'content'   => 'admin/pokja/detail',
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    public function tambah()
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_pokja    = new Pokja_model();
        $pokja      = $m_pokja->findAll();
        $data = [
            'title'     => 'Tambah Pokja',
            'content'   => 'admin/pokja/tambah',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function create(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_pokja        = new Pokja_model();
        $time           = time();
        $data_validasi  = [
            'nama_pokja' => 'required'
        ];
        if($this->request->getMethod() === 'post'){
            if($this->validate($data_validasi)){
                $data = [
                    'nama_pokja'    => $this->request->getPost('nama_pokja'),
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_pokja'     => md5(uniqid())
                ];
                $add_pokja = $m_pokja->save($data);
                if($add_pokja != NULL){
                    echo "Pokja sukses ditambah";
                }else{
                    echo "Pokja gagal ditambah";
                }
            }
        }
    }
    //send email
    public function update(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_user         = new User_model();
        $user           = $m_user->find($id_user);
        $data_validasi  = [
            'password' => 'required'
        ];

        // Start validasi
        if ($this->request->getMethod() === 'post') {
            if($this->validate($data_validasi)){
                $data = [
                    'id'        => $user['id'],
                    'nama'      => $this->request->getPost('nama'),
                    'email'     => $this->request->getPost('email'),
                    'pass'      => $this->request->getPost('password'),
                ];
                $m_user->save($data);
                //file attachment
                $attachment = base_url('asstets/upload/file/Daftar_Harga_Kursus_2020_v2.pdf');
                //html message untuk body email
                $message = "<h1>Invoice Pembelian</h1>Kepada Berikut Invoice atas pembelian";
                //memanggil private function sendEmail
                $this->sendEmail($attachment, 'khaironbiz@gmail.com', 'Invoice', $message);
                // masuk database
                $this->session->setFlashdata('sukses', 'Data telah diedit');
                return redirect()->to(base_url('admin/akun'));
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            }
    }
    public function update_foto(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_user         = new User_model();
        $user           = $m_user->find($id_user);
        $data_validasi  = [
            'gambar' => [
                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[gambar,4096]',
            ],
        ];
        // Start validasi
        if ($this->request->getMethod() === 'post') {
            if($this->validate($data_validasi)){
                // Image upload
                $avatar   = $this->request->getFile('gambar');
                $namabaru = $avatar->getRandomName();
                $avatar->move('assets/upload/image/', $namabaru);
                // Create thumb
                $image = \Config\Services::image()
                    ->withFile('assets/upload/image/' . $namabaru)
                    ->fit(100, 100, 'center')
                    ->save('assets/upload/image/thumbs/' . $namabaru);
                $data = [
                    'id'    =>  $user['id'],
                    'foto'  => $namabaru
                ];
                // masuk database
                $m_user->save($data);
                //file attachment
                $attachment = base_url('asstets/upload/file/Daftar_Harga_Kursus_2020_v2.pdf');
                //html message untuk body email
                $message = "<h1>Invoice Pembelian</h1>Kepada Berikut Invoice atas pembelian";
                //memanggil private function sendEmail
                $this->sendEmail($attachment, 'khaironbiz@gmail.com', 'Invoice', $message);
                // masuk database
                $this->session->setFlashdata('sukses', 'Data telah diedit');
                return redirect()->to(base_url('admin/akun'));


            }
        }
    }
    private function sendEmail($attachment, $to, $title, $message){

		$this->email->setFrom('hpii.ppni@gmail.com','khairon');
		$this->email->setTo($to);

		$this->email->attach($attachment);

		$this->email->setSubject($title);
		$this->email->setMessage($message);

		if(! $this->email->send()){
			return false;
		}else{
			return true;
		}
	}
}
