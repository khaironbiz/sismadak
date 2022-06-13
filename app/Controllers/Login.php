<?php

namespace App\Controllers;

use App\Models\Konfigurasi_model;
use App\Models\User_model;
use App\Models\Token_model;
use App\Models\Provinsi_model;
use App\Models\Registrasi_model;

class Login extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    // Homepage
    public function index()
    {
        $session       = \Config\Services::session();
        $m_konfigurasi = new Konfigurasi_model();
        $m_user        = new User_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $id_user       = $this->session->get('id_user');
        
        $data = [
            'title'         => 'Member Area',
            'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'session'       => $session,
        ];
        if($id_user>0){
            return redirect()->to(base_url());
        }
        echo view('login/index', $data);
        // End proses
    }
    public function register()
    {
        $session       = \Config\Services::session();
        $m_konfigurasi = new Konfigurasi_model();
        $m_user        = new User_model();
        $m_provinsi     = new Provinsi_model();
        $provinsi       = $m_provinsi->listing();
        $konfigurasi   = $m_konfigurasi->listing();
        
        $data = [
            'title'         => 'Registrasi',
            'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'session'       => $session,
            'provinsi'      => $provinsi,
        ];
        echo view('login/register', $data);
        // End proses
    }
    public function aktifasi($has_registrasi){
        $session        = \Config\Services::session();
        $m_konfigurasi  = new Konfigurasi_model();
        $m_registrasi   = new Registrasi_model();
        $m_token        = new Token_model();
        $count_token    = $m_token->count_token($has_registrasi);
        $registrasi     = $m_registrasi->has_registrasi($has_registrasi);       
        $konfigurasi    = $m_konfigurasi->listing();
        if($registrasi != NULL){
            if($count_token >0){
                $data           = [
                    'title'         => 'Aktifasi Akun',
                    'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
                    'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
                    'registrasi'    => $registrasi,
                    'session'       => $session,
                ];
                echo view('login/aktifasi', $data);
            }else{
                $this->session->setFlashdata('warning', 'Mohon maaf token ada sudah digunakan, silahkan ajukan reset password');
                return redirect()->to(base_url('forgot'));
            }
            
        }else{
            $this->session->setFlashdata('warning', 'Mohon maaf token ada tidak valid');
                return redirect()->to(base_url('forgot'));
        }
        
    }
    public function aktifkan($has_registrasi){
        $m_registrasi   = new Registrasi_model();
        $m_token        = new Token_model();
        $token          = $m_token->detail($has_registrasi);
        $registrasi     = $m_registrasi->has_registrasi($has_registrasi);
        $data_validasi = [
            'password' => [
                'rules'     => 'required|min_length[6]|alpha_numeric_punct|matches[password_2]',
                'errors'    => [
                    'required'              => 'Password harus diisi',
                    'min_length'            => 'Password minimal 6 karakter',
                    'matches'               => 'Password harus sama dengan password konfirmasi',
                    'alpha_numeric_punct'   => 'Password hanya berupa angka, huruf dan karakter uniq $,#,~,!,*,_,-,=,+',
                ]
            ],
        ];
        if ($this->request->getMethod() === 'post' && $has_registrasi == $registrasi['has_registrasi']){
            if ($this->validate($data_validasi)){
                $data_registrasi    = [
                    'id_registrasi'     => $registrasi['id_registrasi'],
                    'status_registrasi' => 1,
                    'updated_at'        => date('Y-m-d H:i:s'),
                    'password'          => md5( $this->request->getPost('password_1'))
                ];
                $m_registrasi->update($registrasi['id_registrasi'], $data_registrasi);
                $data_token = [
                    'id_token'  => $token['id_token'],
                    'token'     => $token['token'],
                    'read_at'   => time(),
                ];
                $update_token = $m_token->update($token['id_token'], $data_token);
                $nama       = $registrasi['nama'];
                $email      = $registrasi['email'];
                $to         = $email;
                $subject    = "Pendaftaran Akun";
                $alamat_ip  = $_SERVER['REMOTE_ADDR'];
                $message    = "<p><b>Hay $nama </b>Selamat akun anda telah aktif</p>
                <hr>
                Hormat Kami,<br>
                Pengurus <br>
                <b>Himpunan Perawat Informatika Indonesia</b>
                
                
                ";
                $this->sendMail($to,$subject,$message,2);
                $this->session->setFlashdata('sukses', 'Pendaftaran anda telah berhasil');
                return redirect()->to(base_url('login'));
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            echo "Akses Ilegal";
        }
                
        
    }

    //daftar
    public function daftar(){
        $session        = \Config\Services::session();
        $m_konfigurasi  = new Konfigurasi_model();
        $m_user         = new User_model();
        $m_registrasi   = new Registrasi_model();
        $m_token        = new Token_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $data_validasi  = [
            'nama' => [
                'rules'     => 'required|min_length[3]',
                'errors'    => [
                    'required'      => 'Nama harus diisi',
                    'min_length'    => 'Nama minimal 3 karakter'
                ]
            ],
            'nik'   => [
                'rules'     => 'required|exact_length[16]|numeric|is_unique[registrasi.nik]',
                'errors'    => [
                    'required'      => 'NIK harus diisi',
                    'exact_length'  => 'NIK harus 16 karakter',
                    'numeric'       => 'NIK Harus berupa angka',
                    'is_unique'     => 'NIK sudah terdaftar',
                ]
            ],
            'hp'    => [
                'rules'     => 'required|min_length[10]|numeric|is_unique[registrasi.hp]',
                'errors'    => [
                    'required'      => 'HP harus diisi',
                    'min_length'    => 'HP minimal 10 karakter',
                    'numeric'       => 'HP harus berupa angka',
                    'is_unique'     => 'HP sudah terdaftar',
                ]
            ],
            'nira'  => [
                'rules'     => 'required|min_length[11]|numeric|is_unique[registrasi.nira]',
                'errors'    => [
                    'required'      => 'NIRA harus diisi',
                    'min_length'    => 'NIRA minimal 11 karakter',
                    'numeric'       => 'NIRA harus berupa angka',
                    'is_unique'     => 'NIRA sudah terdaftar',
                ]
            ],
            'email' => [
                'rules'     => 'required|min_length[11]|valid_email|is_unique[registrasi.email]',
                'errors'    => [
                    'required'      => 'Email harus diisi',
                    'min_length'    => 'Email minimal 11 karakter',
                    'valid_email'   => 'Email harus mengikuti kaidah penulisan email',
                    'is_unique'     => 'Email sudah terdaftar',
                ]
            ],
            'dpw'   => [
                'rules'     => 'required|numeric',
                'errors'    => [
                    'required'      => 'DPW harus diisi',
                    'numeric'       => 'DPW harus berupa angka'
                ]
            ]
        ];
        
        // Start validasi
        if ($this->request->getMethod() === 'post'){
            if ($this->validate($data_validasi))
            {
                $nama           = $this->request->getVar('nama');
                $jenis_kelamin  = $this->request->getVar('jenis_kelamin');
                $tanggal_lahir  = $this->request->getVar('tanggal_lahir');
                $nik            = $this->request->getVar('nik');
                $nira           = $this->request->getVar('nira');
                $email          = $this->request->getVar('email');
                $hp             = $this->request->getVar('hp');
                $dpw            = $this->request->getVar('dpw');
                $has_registrasi = md5(uniqid());
                // $password       = $this->request->getVar('password_1');
                $now            = date('Y-m-d H:i:s');
                $data = [
                    'nama'          => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tanggal_lahir' => $tanggal_lahir,
                    'nik'           => $nik,
                    'nira'          => $nira,
                    'email'         => $email,
                    'hp'            => $hp,
                    'dpw'           => $dpw,
                    'created_at'    => $now,
                    'level_akses'   => '1',
                    'has_registrasi'=> $has_registrasi,
                ];
                $tamabah_registrasi = $m_registrasi->save($data);
                if($tamabah_registrasi){
                    $tautan     = base_url('aktifasi/'.$has_registrasi);
                    $to         = $email;
                    $subject    = "Pendaftaran Akun";
                    $alamat_ip  = $_SERVER['REMOTE_ADDR'];
                    $message    = "<p>Selamat Datang di Himpunan Perawat Informatika Indonesia</p>
                    <b>Data Pendaftaran Anda :</b><br>
                    <table>
                        <tr>
                            <td>Nama</td><td>:</td><td>$nama</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td><td>:</td><td>$jenis_kelamin</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td><td>:</td><td>$tanggal_lahir</td>
                        </tr>
                        <tr>
                            <td>NIK</td><td>:</td><td>$nik</td>
                        </tr>
                        <tr>
                            <td>NIRA</td><td>:</td><td>$nira</td>
                        </tr>
                        <tr>
                            <td>Email</td><td>:</td><td>$email</td>
                        </tr>
                        <tr>
                            <td>HP</td><td>:</td><td>$hp</td>
                        </tr>
                    </table>
                    <hr>
                    Klik tautan berikut untuk melanjutkan pendaftaran saudara <a href='$tautan'>$tautan</a>";
                    $this->sendMail($to,$subject,$message,2);
                    $exp_date   = time()+(60*60*24);
                    $data_token = [
                        'token'         => $has_registrasi,
                        'exp_date'      => $exp_date,
                        'jenis_token'   => "Aktivasi Akun",
                        'created_at'    => date('Y-m-d H:i:s')
                    ];
                    $add_token  = $m_token->save($data_token);
                    $this->session->setFlashdata('sukses', 'Pendaftaran anda telah berhasil');
                    return redirect()->to(base_url('login'));
                }else{
                    echo"Gagal masuk database";
                    echo "<script> alert(\"Data Gagal Diproses\");history.go(-1)</script>";	
                }
            }else{
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }else{
            $this->session->setFlashdata('warning', 'Akses Ilegal');
            return redirect()->to(base_url('registrasi'));
        }
    }
    // login
    public function login(){
        $session       = \Config\Services::session();
        $m_konfigurasi = new Konfigurasi_model();
        $m_user        = new User_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $data_validasi = [
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[3]',
        ];
        // Start validasi
        if ($this->request->getMethod() === 'post') {
            if($this->validate($data_validasi)){
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $user     = $m_user->login($username, $password);
                // Proses login
                if ($user != NULL) {
                    // Jika username password benar
                    $this->session->set('username', $username);
                    $this->session->set('id_user', $user['id']);
                    $this->session->set('akses_level', $user['level']);
                    $this->session->set('nama', $user['nama']);
                    $this->session->setFlashdata('sukses', 'Hai ' . $user['nama'] . ', Anda berhasil login');

                    return redirect()->to(base_url('admin/akun/'));
                    // var_dump($user);
                }else{
                    // jika username password salah
                    $this->session->setFlashdata('warning', 'Username atau password salah');
                    return redirect()->to(base_url('login'));
                }
            }
        }
        // End validasi
    }
    // change password
    public function reset($token){
        $session        = \Config\Services::session();
        $m_token        = new Token_model();
        $m_konfigurasi  = new Konfigurasi_model();
        $konfigurasi    = $m_konfigurasi->listing();
        $data_token     = $m_token->reset($token);
        $hitung_token   = $m_token->count_token($token);
        if($hitung_token['count']<1){
            $this->session->setFlashdata('warning', 'Halaman tidak ditemukan');
            return redirect()->to(base_url('login'));        
        }else{
            $data = [
            'title'         => 'Lupa Password',
            'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'session'       => $session,
            'token'         => $data_token['token'],
            'id_token'      => $data_token['id_token'],
            'nama'          => $data_token['nama'],
        ];
        // var_dump($data_token);
        // echo $hitung_token['count'];
        echo view('login/reset', $data);
        }
        
    }
    // change password
    public function reset_password($token){
        $session        = \Config\Services::session();
        $m_token        = new Token_model();
        $m_user         = new User_model();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
                [
                    'password_1' => 'required|min_length[3]|matches[password_2]',
                ]
            )) {
            $password           = $this->request->getPost('password_1');
            $data_token         = $m_token->reset($token);
            $hitung_token       = $m_token->count_token($token);
            if ($hitung_token['count']>0){
                $id_user        = $data_token['created_by'];
                $id_token       = $data_token['id_token'];
                $read_at        = time();
                $isi_token      = [
                    'id_token'  => $data_token['id_token'],
                    'read_at'   => $read_at,
                ];
                $data_user      = [
                    'id_user'   => $data_token['created_by'],
                    'password'  => sha1($password),
                ];
                // var_dump($data_user);
                $m_user->update($id_user, $data_user);
                $m_token->update($id_token, $isi_token);
                $this->session->setFlashdata('sukses', 'Password berhasil dibuat');
                return redirect()->to(base_url('login'));
            }else{
                    $this->session->setFlashdata('warning', 'Periksa Kembali email anda, pastikan email yang anda masukkan terdftar pada sistem kami');
                    return redirect()->to(base_url('login/lupa'));
            }
        }
    }
    // lupa
    public function lupa(){
        $session       = \Config\Services::session();
        $m_konfigurasi = new Konfigurasi_model();
        $m_user        = new User_model();
        $konfigurasi   = $m_konfigurasi->listing();
        $data = [
            'title'         => 'Lupa Password',
            'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'session'       => $session,
        ];
        echo view('login/lupa', $data);
    }
    // request password
    public function password_request(){
        $session    = \Config\Services::session();
        $m_token    = new Token_model();
        $m_user     = new User_model();
        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
                [
                    'email' => 'required|min_length[3]|valid_email',
                ]
            )) {
            $email              = $this->request->getPost('email');
            $count_email        = $m_user->count_email($email);
            $count_email_user   = $count_email['count'];
            if ($count_email_user>0){
                $user       = $m_user->reset_password($email);
                $id_user    = $user['id_user'];
                $token      = md5(uniqid());
                $exp_date   = time()+(60*60*24);
                $data       = [
                    'token'         => $token,
                    'created_by'    => $id_user,
                    'exp_date'      => $exp_date,
                    'jenis_token'   => "Reset Password",
                    'created_at'    => date('Y-m-d H:i:s')
                ];
                $add_token  = $m_token->save($data);
                if($add_token){
                    $to         = "khaironbiz@gmail.com";
                    $subject    = "Reset Password";
                    $alamat_ip  = $_SERVER['REMOTE_ADDR'];
                    $time_login = date('Y-m-d H:i:s');
                    $browser    = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
                    $url_reset  = base_url().'/login/reset/'.$token;
                    $link       = "<a href='$url_reset'>Reset</a>";
                    $link_2     = "<a href='$url_reset'>$url_reset</a>";
                    $message    = "
                                    <p>Anda Berhasil Login</p>
                                    <p>$link atau copy tautan dibawah ini</p>
                                    <p>$link_2</p>
                                    <p>Browser   : $browser</p>
                                    <p>IP Address : $alamat_ip</p>
                                    <p>Waktu Reset  : $time_login</p>
                                    <p>Abaikan email ini jika anda tidak merasa mengajukan reset password.</p>
                                ";
                    $this->sendMail($to, $subject, $message, 2);
                    $this->session->setFlashdata('sukses', 'Hai ' . $user['nama'] . ', permohonan reset password telah dikirim ke email anda');
                    return redirect()->to(base_url('login'));
                }else{
                    $this->session->setFlashdata('warning', 'Hai , permohonan reset password gagal dikirim ke email anda');
                    return redirect()->to(base_url('login'));
                }
            }else{
                    $this->session->setFlashdata('warning', 'Periksa Kembali email anda, pastikan email yang anda masukkan terdftar pada sistem kami');
                    return redirect()->to(base_url('login/lupa'));
            }
        }
    }
    // Logout
    public function logout(){
        $session    = \Config\Services::session();
        $this->session->destroy();
        return redirect()->to(base_url());
    }
    //send email
    private function sendMail($to,$subject,$message,$server=1){
        $email = \Config\Services::email();
        if($server==1){
            $email_pengirim = "server@hpii.or.id";
            $email_password = "@Pentagon250909#";
            $smtp_host      = "smtp.hostinger.com";
            $nama_pengirim  = "Himpunan Perawat Informatika Indonesia";
        }else if($server==2){
            $email_pengirim = "hpii.ppni@gmail.com";
            $email_password = "@Mail250909#";
            $smtp_host      = "smtp.gmail.com";
            $nama_pengirim  = "Himpunan Perawat Informatika Indonesia";
        }
        $config["protocol"]     = "smtp";
        $config["SMTPHost"]     = $smtp_host;
        $config["SMTPUser"]     = $email_pengirim;
        $config["SMTPPass"]     = $email_password;
        $config["SMTPPort"]     = 465;
        $config["SMTPCrypto"]   = "ssl";
        $email->initialize($config);
        $email->setTo($to);
        $email->setFrom($email_pengirim, $nama_pengirim);
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()){
            echo 'Email successfully sent';
        }
        else{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
    private function get_browser_name($user_agent)
    {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        return 'Other';
    }
}
