<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    protected $encrypter;
    protected $form_validation;
    protected $M_user;
    protected $session;

    public function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
        $this->form_validation =  \Config\Services::validation();
        $this->M_user = new UserModel($this->request);
        $this->session = \Config\Services::session();
    }

    // Halaman Login
    public function index()
    {
        $data['title']   = "App-SIP | Login";
        return view('v_login/index', $data);
    }

    // Pengecekan User
    public function cekUser()
    {
        $username    = $this->request->getPost('username');
        $password    = $this->request->getPost('password');

        //Validasi 
        $cek_validasi = [
            'username' => $username,
            'password' => $password
        ];

        // print_r($cek_validasi);
        //           die('sttoppp');




        //Cek Validasi, Jika Data Tidak Valid 
        if ($this->form_validation->run($cek_validasi, 'login') == FALSE) {

            $validasi = [
                'error'   => true,
                'login_error' => $this->form_validation->getErrors()
            ];
            echo json_encode($validasi);
        }

        //Data Valid
        else {



            //Cek Data username berdasarkan username
            $cekUser = $this->M_user->where('tbl_login.username', $username)->first();
            $ciphertext = $cekUser['password'];


            // print_r($cekUser);
            // die('sttop');

            // $cekUser2 = $this->M_user->getUserByUsername($username)->getResult();


            // print_r($cekUser);
            // print_r($cekUser2);
            // die('sttop');




            //Jika user ada
            if ($cekUser) {
                //Cek password
                $p = $this->encrypter->decrypt(base64_decode($ciphertext));
                // $p = $this->encrypt->decode($ciphertext, $key);

                //Jika password benar
                if ($password == $p) {
                    $newdata = [
                        //'login_id'      => $cekUser['login_id'],
                        'hak_akses'     => $cekUser['hak_akses'],
                        'username'      => $cekUser['username'],
                        // 'email'         => $cekUser['petugas_email'],
                        // 'instansi_id'   => $cekUser['instansi_id'],
                        // 'nama'   => $cekUser['petugas_nama'],

                    ];
                    $this->session->set($newdata);


                    // print_r($newdata);
                    // die('sttop');

                    //Cek role_id apakah Admin atau Petugas
                    if ($cekUser['hak_akses'] == 'admin') {
                        //Admin
                        $validasi = [
                            'success'   => true,
                            'link'   => base_url('dashboard')
                        ];
                        echo json_encode($validasi);
                    } else if ($cekUser['hak_akses'] == 'petugas') {
                        //Petugas OPD
                        $validasi = [
                            'success'   => true,
                            'link'   => base_url('opd/Dashboard')
                        ];
                        echo json_encode($validasi);
                    } else {
                        //Petugas
                        $validasi = [
                            'success'   => true,
                            'link'   => base_url('pendaftaran/cekStatusPendaftaran')
                        ];
                        echo json_encode($validasi);
                    }
                }
                //Password salah
                else {
                    $validasi = [
                        'error'   => true,
                        'login_error' => [
                            'password' => 'Password yang anda masukkan salah !'
                        ]
                    ];
                    echo json_encode($validasi);
                }
            }

            //Dan jika user tidak ada
            else {
                $validasi = [
                    'error'   => true,
                    'login_error' => [
                        'user' => 'User Tidak Terdaftar!'
                    ]
                ];
                echo json_encode($validasi);
            }
        }
    }
}

/* End of file Login.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Controllers/Login.php */
