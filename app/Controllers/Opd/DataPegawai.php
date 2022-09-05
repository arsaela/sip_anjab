<?php

namespace App\Controllers\Opd;
use App\Controllers\BaseController;

use App\Models\Opd\DataPegawaiOPDModel;
use App\Models\Opd\DashboardPetugasModel;
use Config\Services;

class DataPegawai extends BaseController
{
	protected $M_pegawai;
	protected $M_dashboard_opd;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_pegawai = new DataPegawaiOPDModel($this->request);

		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();


		$this->M_dashboard_opd = new DashboardPetugasModel($this->request);
		
	}

	
	// Halaman Data Pegawai
	public function index()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		
		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_pegawai->getInstansiByLogin($username)->getResult();
		$getIDInstansi = $idInstansi['0']->instansi_id;

		$data['getPegawaiByInstansi'] = $this->M_pegawai->getPegawaiByInstansiID($getIDInstansi)->getResult();

		// echo "<pre>";
		// print_r($data['getPegawaiByInstansi']);
		// die('sttop');

		return view('v_dataPegawaiOPD/index', $data);
	}

		// Halaman Data Cetak Data Pegawai
	public function cetakdatapegawaiopd()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		
		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_pegawai->getInstansiByLogin($username)->getResult();
		
		$getIDInstansi = $idInstansi['0']->instansi_id;
		$data['getnamaInstansi'] = $this->M_pegawai->getnamaInstansi($getIDInstansi)->getResult();




		$data['getPegawaiByInstansi'] = $this->M_pegawai->getPegawaiByInstansiID($getIDInstansi)->getResult();

		// echo "<pre>";
		// print_r($data['getnamaInstansi'][0]->instansi_nama);
		// die('sttop');

		return view('v_dataPegawaiOPD/cetak', $data);
	}

}

/* End of file Data Pegawai.php */