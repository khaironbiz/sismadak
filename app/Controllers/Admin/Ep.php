<?php

namespace App\Controllers\Admin;

use App\Models\User_model;
use App\Models\Pokja_model;
use App\Models\Pokja_ep_model;
use App\Models\Pokja_standar_model;

class Ep extends BaseController
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
    public function detail($has_ep)
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_ep       = new Pokja_ep_model();
        $ep         = $m_ep->where('has_ep', $has_ep)->first();
        $m_standar  = new Pokja_standar_model();
        $standar    = $m_standar->find($ep['id_standar']);
        $data = [
            'title'     => 'Detail Standar',
            'standar'   => $standar,
            'ep'        => $ep,
            'content'   => 'admin/ep/detail',
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    public function edit($has_standar)
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_standar  = new Pokja_standar_model();
        $standar    = $m_standar->where('has_standar', $has_standar)->first();
        $id_pokja   = $standar['id_pokja'];
        $m_pokja    = new Pokja_model();
        $pokja      = $m_pokja->find($id_pokja);
        $data = [
            'title'     => 'Tambah Pokja',
            'pokja'     => $pokja,
            'standar'   => $standar,
            'content'   => 'admin/standar/edit',
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

    public function create_standar($has_standar){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_standar      = new Pokja_standar_model();
        $standar        = $m_standar->where('has_standar', $has_standar)->first();
        $id_standar     = $standar['id_standar'];
        $id_pokja       = $standar['id_pokja'];
        $m_ep           = new Pokja_ep_model();
        $time           = time();
        $data_validasi  = [
            'nama_ep'  => 'required',
            'norut'    => 'required'
        ];
        if($this->request->getMethod() === 'post'){
            if($this->validate($data_validasi)){
                $data = [
                    'id_pokja'      => $id_pokja,
                    'id_standar'    => $id_standar,
                    'norut'         => $this->request->getPost('norut'),
                    'nama_ep'       => $this->request->getPost('nama_ep'),
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_ep'        => md5(uniqid())
                ];
                $add_ep = $m_ep->save($data);
                if($add_ep != NULL){
                    $this->session->setFlashdata('sukses', 'Data berhasil ditambah');
                    return redirect()->to(base_url('admin/standar/detail/'.$standar['has_standar']));
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
    public function update($has_standar){
//        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_standar      = new Pokja_standar_model();
        $standar        = $m_standar->where('has_standar', $has_standar)->first();
        $id_pokja       = $standar['id_pokja'];
        $m_pokja        = new Pokja_model();
        $pokja          = $m_pokja->find($id_pokja);
        $time           = time();
        $data_validasi  = [
            'nama_standar'  => 'required',
            'penjelasan'    => 'required'
        ];
        if($this->request->getMethod() === 'post') {
            if ($this->validate($data_validasi)) {
                $data           = [
                    'id_standar'    => $standar['id_standar'],
                    'id_pokja'      => $pokja['id_pokja'],
                    'nama_standar'  => $this->request->getPost('nama_standar'),
                    'norut'         => $this->request->getPost('norut'),
                    'penjelasan'    => $this->request->getPost('penjelasan'),
                    'updated_at'    => $time
                ];

                $update = $m_standar->save($data);
                if($update != NULL){
                    $this->session->setFlashdata('sukses', 'Data berhasil dirubah');
                    return redirect()->to(base_url('admin/standar/pokja/'.$pokja['has_pokja']));
                }else{
                    $this->session->setFlashdata('warning', 'Data gagal dirubah');
                    return redirect()->to(base_url('admin/standar/pokja/'.$pokja['has_pokja']));
                }
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            $this->session->setFlashdata('warning', 'Akses Illegal');
            return redirect()->to(base_url('admin/pokja'));
        }


    }
    public function standar($has_standar){
//        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_standar      = new Pokja_standar_model();
        $standar        = $m_standar->where('has_standar', $has_standar)->first();
        $id_standar     = $standar['id_standar'];
        $m_ep           = new Pokja_ep_model();
        $ep             = $m_ep->where('id_standar', $id_standar)->findAll();
        $data           = [
            'title'     => 'Elemen Penilaian',
            'ep'        => $ep,
            'standar'   => $standar,
            'content'   => 'admin/ep/standar'
        ];

//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
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
