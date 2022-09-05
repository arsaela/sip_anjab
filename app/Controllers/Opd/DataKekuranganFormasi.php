<?php

namespace App\Controllers\Opd;
use App\Controllers\BaseController;

use App\Models\Opd\KekuranganFormasiPetugasModel;
use App\Models\Opd\DashboardPetugasModel;
use Config\Services;

class DataKekuranganFormasi extends BaseController
{
	protected $M_kekurangan_formasi;
	protected $M_dashboard_opd;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_kekurangan_formasi = new KekuranganFormasiPetugasModel($this->request);

		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();

	
		$this->M_dashboard_opd = new DashboardPetugasModel($this->request);
		
	}

	
	// Halaman Data Prodi
	public function index()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		
		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_kekurangan_formasi->getInstansiByLogin($username)->getResult();

		// $idInstansi = $this->session->get('instansi_id');
		$data['getDetailFormasi'] = $this->M_kekurangan_formasi->getKebutuhanFormasi($idInstansi['0']->instansi_id)->getResult();

		return view('v_dataKekuranganFormasi_petugas/index', $data);
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