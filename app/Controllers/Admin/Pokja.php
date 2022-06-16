<?php

namespace App\Controllers\Admin;

use App\Models\Pokja_model;
use App\Models\Pokja_fokus_model;
use App\Models\Pokja_standar_model;
use App\Models\Kelompok_standar_model;

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
        $pokja      = $m_pokja
                        ->select('pokja.*, kelompok_standar.kelompok_standar')
                        ->join('kelompok_standar','kelompok_standar.id_kelompok_standar = pokja.id_kelompok','LEFT')
                        ->orderBy('norut','ASC')
                        ->findAll();
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
        $m_standar  = new Pokja_standar_model();
        $m_fokus    = new Pokja_fokus_model();
        $pokja      = $m_pokja->where('has_pokja', $has_pokja)->first();
        $id_pokja   = $pokja['id_pokja'];
        $count_pokja= $m_fokus->count_id_pokja($id_pokja);
        $count_stdr = $m_standar->count($id_pokja);
        $data = [
            'title'         => 'Detail Pokja',
            'pokja'         => $pokja,
            'count_stdr'    => $count_stdr,
            'count_pokja'   => $count_pokja,
            'content'       => 'admin/pokja/detail',
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    public function edit($has_pokja)
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_pokja    = new Pokja_model();
        $m_kelompok = new Kelompok_standar_model();
        $pokja      = $m_pokja->where('has_pokja', $has_pokja)->first();
        $kelompok   = $m_kelompok->findAll();
        $data = [
            'title'     => 'Tambah Pokja',
            'pokja'     => $pokja,
            'kelompok'  => $kelompok,
            'content'   => 'admin/pokja/edit',
        ];
//        var_dump($data);
        echo view('admin/layout/wrapper', $data);
    }
    public function tambah()
    {
//        checklogin();
        $id_user    = $this->session->get('id_user');
        $m_pokja    = new Pokja_model();
        $m_kelompok = new Kelompok_standar_model();
        $kelompok   = $m_kelompok->findAll();
        $total      = $m_pokja->total();
        $data = [
            'title'     => 'Tambah Pokja',
            'kelompok'  => $kelompok,
            'total'     => $total,
            'content'   => 'admin/pokja/tambah',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    public function create(){
//        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_pokja        = new Pokja_model();
        $time           = time();
        $data_validasi  = [
            'nama_pokja'    => 'required',
            'id_kelompok'   => 'required'
        ];
        if($this->request->getMethod() === 'post'){
            if($this->validate($data_validasi)){
                $data = [
                    'nama_pokja'    => $this->request->getPost('nama_pokja'),
                    'id_kelompok'   => $this->request->getPost('id_kelompok'),
                    'norut'         => $this->request->getPost('norut'),
                    'created_at'    => $time,
                    'created_by'    => $id_user,
                    'has_pokja'     => md5(uniqid())
                ];
                $add_pokja = $m_pokja->save($data);
                if($add_pokja != NULL){
                    $this->session->setFlashdata('sukses', 'Data berhasil ditambah');
                    return redirect()->to(base_url('admin/pokja'));
                }else{
                    $this->session->setFlashdata('warning', 'Data gagal ditambah');
                    return redirect()->to(base_url('admin/pokja'));
                }
            }
        }
    }

    //send email
    public function update($has_pokja){
//        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_pokja        = new Pokja_model();
        $pokja          = $m_pokja->where('has_pokja',$has_pokja)->first();
        $time           = time();
        $data_validasi  = [
            'nama_pokja' => 'required'
        ];
        if($this->request->getMethod() === 'post') {
            if ($this->validate($data_validasi)) {
                $data           = [
                    'id_pokja'      => $pokja['id_pokja'],
                    'id_kelompok'   => $this->request->getPost('id_kelompok'),
                    'norut'         => $this->request->getPost('norut'),
                    'nama_pokja'    => $this->request->getPost('nama_pokja'),
                    'penjelasan'    => $this->request->getPost('penjelasan'),
                    'updated_at'    => $time
                ];

                $update_pokja = $m_pokja->save($data);
                if($update_pokja != NULL){
                    $this->session->setFlashdata('sukses', 'Data berhasil dirubah');
                    return redirect()->to(base_url('admin/pokja'));
                }else{
                    $this->session->setFlashdata('warning', 'Data gagal dirubah');
                    return redirect()->to(base_url('admin/pokja'));
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
    public function standar($has_pokja){
//        checklogin();
        $id_user        = $this->session->get('id_user');
        $m_pokja        = new Pokja_model();
        $pokja          = $m_pokja->where('has_pokja', $has_pokja)->first();
        $id_pokja       = $pokja['id_pokja'];
        $m_standar      = new Pokja_standar_model();
        $standar        = $m_standar->where('id_pokja', $id_pokja)->findAll();
        $data           = [
            'title'     => 'Standar '.$pokja['nama_pokja'],
            'pokja'     => $pokja,
            'standar'   => $standar,
            'content'   => 'admin/pokja/standar'
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
