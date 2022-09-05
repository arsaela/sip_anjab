<?php

namespace App\Controllers;

use App\Models\InstansiModel;
use Config\Services;

class DataInstansi extends BaseController
{
	protected $M_usulan;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
        $this->request = Services::request();
		$this->M_instansi = new InstansiModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

    // Halaman Data Instansi
	public function index()
	{
		$data['title']   = "App-SIP | Data Instansi";
		$data['page']    = "datainstansi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

        $data['getInstansi'] = $this->M_instansi->getInstansi()->getResult();

		return view('v_dataFormasi/index', $data);
	}
}

?>