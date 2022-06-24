<?php

namespace App\Controllers\Admin;

use App\Models\Kelompok_standar_model;
use App\Models\User_model;
use App\Models\Pokja_model;
use App\Models\Pokja_ep_model;
use App\Models\Pokja_fokus_model;
use App\Models\Pokja_standar_model;

class Fokus extends BaseController
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
        $m_fokus    = new Pokja_fokus_model();
        $fokus      = $m_fokus->orderBy('id_pokja','ASC')->orderBy('norut','ASC')->findAll();


        $data = [
            'title'     => 'List Pokja',
            'fokus'     => $fokus,
            'content'   => 'admin/fokus/index',
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    public function detail($has_fokus)
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_fokus    = new Pokja_fokus_model();
        $m_pokja    = new Pokja_model();
        $fokus      = $m_fokus->where('has_fokus', $has_fokus)->first();
        $pokja      = $m_pokja->find($fokus['id_pokja']);
        $data = [
            'title'     => 'Detail Fokus Penilaian',
            'fokus'     => $fokus,
            'pokja'     => $pokja,
            'content'   => 'admin/fokus/detail',
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
        $m_fokus    = new Pokja_fokus_model();

        $data = [
            'title'     => 'Tambah Pokja',
            'pokja'     => $pokja,
            'content'   => 'admin/fokus/tambah',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function create(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_pokja        = new Pokja_model();
        $m_fokus        = new Pokja_fokus_model();
        $time           = time();
        $norut          = $this->request->getPost('norut');
        $id_pokja       = $this->request->getPost('id_pokja');
        $validasi_norut = $m_fokus->count_id_pokja_norut($id_pokja,$norut);
        $data_validasi  = [
            'nama_fokus'    => 'required',
            'norut'         => 'required'
        ];
        if($this->request->getMethod() === 'post'){
            if($this->validate($data_validasi)){
                $data = [
                    'nama_fokus'    => $this->request->getPost('nama_fokus'),
                    'norut'         => $norut,
                    'id_pokja'      => $id_pokja,
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_fokus'     => md5(uniqid())
                ];
                if($validasi_norut<1){
                    $add= $m_fokus->save($data);
                    if($add != NULL){
                        $this->session->setFlashdata('sukses', 'Data berhasil ditambah');
                        return redirect()->to(base_url('admin/fokus'));
                    }else{
                        $this->session->setFlashdata('warning', 'Data gagal ditambah');
                        return redirect()->to(base_url('admin/fokus/'));
                    }
                }else{
                $this->session->setFlashdata('warning', 'Data nomor urut duplikasi');
                    return redirect()->back()->withInput();
                }


            }
        }
    }
    public function edit($has_fokus)
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_fokus    = new Pokja_fokus_model();
        $fokus      = $m_fokus->where('has_fokus', $has_fokus)->first();
        $m_pokja    = new Pokja_model();
        $pokja      = $m_pokja->find($fokus['id_pokja']);
        $data = [
            'title'     => 'Detail Fokus Penilaian',
            'fokus'     => $fokus,
            'pokja'     => $pokja,
            'content'   => 'admin/fokus/edit',
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    //list fokus penilaian berdasarkan group pokja
    public function pokja($has_pokja){
//        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_pokja        = new Pokja_model();
        $pokja          = $m_pokja->where('has_pokja', $has_pokja)->first();
        $id_pokja       = $pokja['id_pokja'];
        $m_fokus        = new Pokja_fokus_model();
        $fokus          = $m_fokus->where('id_pokja', $id_pokja)->findAll();
        $data           = [
            'title'     => 'Elemen Penilaian',
            'fokus'     => $fokus,
            'pokja'     => $pokja,
            'content'   => 'admin/fokus/pokja'
        ];

//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    //membuat fokus penilaian baru berdasarkan pokja
    public function addpokja($has_pokja)
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_kelompok = new Kelompok_standar_model();
        $m_pokja    = new Pokja_model();
        $m_fokus    = new Pokja_fokus_model();
        $pokja      = $m_pokja->where('has_pokja', $has_pokja)->first();
        $kelompok   = $m_kelompok->find($pokja['id_kelompok']);
        $max_norut  = $m_fokus->max_norut($pokja['id_pokja']);
        $data = [
            'title'     => 'Tambah Pokja',
            'pokja'     => $pokja,
            'kelompok'  => $kelompok,
            'max_norut' => $max_norut,
            'content'   => 'admin/fokus/add_pokja',
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    //Aksi pembuatan fokus penilaian baru berdasarkan pokja
    public function create_pokja($has_pokja){
//        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_pokja        = new Pokja_model();
        $pokja          = $m_pokja->where('has_pokja', $has_pokja)->first();
        $m_fokus        = new Pokja_fokus_model();
        $time           = time();
        $data_validasi  = [
            'nama_fokus'    => 'required',
            'norut'         => 'required'
        ];
        if($this->request->getMethod() === 'post'){
            if($this->validate($data_validasi)){
                $data = [
                    'id_pokja'      => $pokja['id_pokja'],
                    'id_kelompok'   => $this->request->getPost('id_kelompok'),
                    'norut'         => $this->request->getPost('norut'),
                    'nama_fokus'    => $this->request->getPost('nama_fokus'),
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_fokus'     => md5(uniqid())
                ];
                $add = $m_fokus->save($data);
                if($add != NULL){
                    $this->session->setFlashdata('sukses', 'Data berhasil ditambah');
                    return redirect()->to(base_url('admin/fokus/pokja/'.$pokja['has_pokja']));
                }else{
                    $this->session->setFlashdata('warning', 'Data gagal ditambah');
                    return redirect()->to(base_url('admin/fokus/pokja/'.$pokja['has_pokja']));
                }

            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            $this->session->setFlashdata('sukses', 'Data berhasil ditambah');
            return redirect()->to(base_url('admin/standar/pokja'));
        }
    }
    public function update($has_fokus){
//        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_fokus        = new Pokja_fokus_model();
        $fokus          = $m_fokus->where('has_fokus', $has_fokus)->first();
        $id_pokja       = $fokus['id_pokja'];
        $m_pokja        = new Pokja_model();
        $pokja          = $m_pokja->find($id_pokja);
        $time           = time();
        $data_validasi  = [
            'nama_fokus'    => 'required',
            'norut'         => 'required'
        ];
        if($this->request->getMethod() === 'post') {
            if ($this->validate($data_validasi)) {
                $data           = [
                    'id_fokus'      => $fokus['id_fokus'],
                    'nama_fokus'    => $this->request->getPost('nama_fokus'),
                    'norut'         => $this->request->getPost('norut'),
                    'updated_at'    => $time
                ];
                $update = $m_fokus->save($data);
                if($update != NULL){
                    $this->session->setFlashdata('sukses', 'Data berhasil dirubah');
                    return redirect()->to(base_url('admin/fokus'));
                }else{
                    $this->session->setFlashdata('warning', 'Data gagal dirubah');
                    return redirect()->to(base_url('admin/fokus'));
                }
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            $this->session->setFlashdata('warning', 'Akses Illegal');
            return redirect()->to(base_url('admin/fokus'));
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
