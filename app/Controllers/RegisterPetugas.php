<?php

namespace App\Controllers;

use App\Models\RegisterModel;
use Config\Services;

class RegisterPetugas extends BaseController
{
	protected $M_register;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_register = new RegisterModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

    // Halaman Register Petugas
    public function index()
    {
        $data['title']  = "App-SIP | Register";
        $data['page']   = "register";
        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');
        
        return view('v_register/index', $data);
    }

    public function register(){
        
        $data = array(
            'username' => $this->request->getPost('username'),
            'petugas_nama'   => $this->request->getPost('petugas_nama'),
            'petugas_no_hp'  => $this->request->getPost('petugas_no_hp'),
            'petugas_email'  => $this->request->getPost('petugas_email'),
            'petugas_buat'   => $this->request->getPost('petugas_buat'),
            'petugas_ubah'   => '-',
            'instansi_id'    =>  $this->request->getPost('instansi_id'),
            'hak_akses'      => 'petugas opd',
            'petugas_status' => 'belum diapprove',
        );

        $this->M_register->RegisterPetugas($data);

        // $model->saveBarang($data);
        echo '<script>
                alert("Berhasil Register Petugas");
                window.location="'.base_url('RegisterPetugas/confirmRegister').'"
            </script>';
    }

    public function confirmRegister()
    {
        $data['title']  = "App-SIP | Register";
        $data['page']   = "register";
        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');
        
        return view('v_register/confirm_register', $data);
    }


}

/* End of file Dashboard.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Controllers/Dashboard.php */
