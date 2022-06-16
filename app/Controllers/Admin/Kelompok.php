<?php

namespace App\Controllers\Admin;

use App\Models\Pokja_model;
use App\Models\Pokja_ep_model;
use App\Models\Pokja_fokus_model;
use App\Models\Pokja_standar_model;
use App\Models\Kelompok_standar_model;

class Kelompok extends BaseController
{
    public function __construct(){
        $this->email = \Config\Services::email();
    }
    public function index()
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_kelompok = new Kelompok_standar_model();
        $kelompok   = $m_kelompok->findAll();
        $data = [
            'title'     => 'List Kelompok Standar',
            'kelompok'  => $kelompok,
            'content'   => 'admin/kelompok/index'
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    public function detail($has_kelompok_standar)
    {
//        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_standar      = new Pokja_standar_model();
        $m_kelompok     = new Kelompok_standar_model();
        $m_pokja        = new Pokja_model();
        $kelompok       = $m_kelompok->where('has_kelompok_standar', $has_kelompok_standar)->first();
        $count_kelompok = $m_pokja->count_kelompok($kelompok['id_kelompok_standar']);
        $data = [
            'title'             => 'Detail Kelompok Standar',
            'kelompok'          => $kelompok,
            'count_kelompok'    => $count_kelompok,
            'content'           => 'admin/kelompok/detail',
        ];
//        var_dump($kelompok);
        echo view('admin/layout/wrapper', $data);
    }
    public function tambah()
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_kelompok = new Kelompok_standar_model();
        $kelompok   = $m_kelompok->findAll();
        $total      = $m_kelompok->total();

        $data = [
            'title'     => 'Tambah Pokja',
            'total'     => $total,
            'content'   => 'admin/kelompok/tambah',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function create(){
        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_kelompok     = new Kelompok_standar_model();
        $time           = time();
        $data_validasi  = [
            'kelompok_standar' => 'required',
        ];
        if($this->request->getMethod() === 'post'){
            if($this->validate($data_validasi)){
                $data = [
                    'kelompok_standar'      => $this->request->getPost('kelompok_standar'),
                    'created_at'            => $time,
                    'created_by'            => $id_user,
                    'has_kelompok_standar'  => md5(uniqid())
                ];
                $add = $m_kelompok->save($data);
                if($add != NULL){
                    $this->session->setFlashdata('sukses', 'Data berhasil ditambah');
                    return redirect()->to(base_url('admin/kelompok'));
                }else{
                    $this->session->setFlashdata('warning', 'Data gagal ditambah');
                    return redirect()->to(base_url('admin/kelompok'));
                }


            }
        }
    }
    public function edit($has_kelompok_standar)
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_kelompok = new Kelompok_standar_model();
        $kelompok   = $m_kelompok->where('has_kelompok_standar', $has_kelompok_standar)->first();
        $data = [
            'title'     => 'Detail Fokus Penilaian',
            'kelompok'  => $kelompok,
            'content'   => 'admin/kelompok/edit',
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    public function update($has_kelompok_standar){
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_kelompok = new Kelompok_standar_model();
        $kelompok   = $m_kelompok->where('has_kelompok_standar', $has_kelompok_standar)->first();

        $time           = time();
        $data_validasi  = [
            'kelompok_standar'    => 'required'
        ];
        if($this->request->getMethod() === 'post') {
            if ($this->validate($data_validasi)) {
                $data           = [
                    'id_kelompok_standar'   => $kelompok['id_kelompok_standar'],
                    'kelompok_standar'      => $this->request->getPost('kelompok_standar'),
                    'updated_at'            => $time
                ];
                $update = $m_kelompok->save($data);
                if($update != NULL){
                    $this->session->setFlashdata('sukses', 'Data berhasil dirubah');
                    return redirect()->to(base_url('admin/kelompok'));
                }else{
                    $this->session->setFlashdata('warning', 'Data gagal dirubah');
                    return redirect()->to(base_url('admin/kelompok'));
                }
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            $this->session->setFlashdata('warning', 'Akses Illegal');
            return redirect()->to(base_url('admin/kelompok'));
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
