<?php

namespace App\Controllers;

use App\Models\InstansiModel;
use App\Models\FormasiModel;
use Config\Services;

class DataFormasi extends BaseController
{
	protected $M_instansi;
	protected $M_formasi;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_instansi = new InstansiModel($this->request);
		$this->M_formasi = new FormasiModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

	// Halaman Data Prodi
	public function detail_formasi($idInstansi)
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$data['getDetailFormasi'] = $this->M_formasi->getDetailFormasi($idInstansi)->getResult();

		return view('v_dataFormasi/view', $data);
	}

	public function detail_pegawai()
	{
		if ($this->request->isAJAX()) {
			$idUnor =   $this->request->getVar('instansiunor');
			$idJabatan =  $this->request->getVar('jabatankode');
			$data = $this->M_formasi->getDetailPegawai($idUnor, $idJabatan)->getResult();
			echo json_encode($data);
		}
	}
}

/* End of file DataFormasi.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Controllers/DataFormasi.php */
