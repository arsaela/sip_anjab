<?php
namespace App\Controllers\Opd;
use App\Controllers\BaseController;

use App\Models\Opd\AjuanABKModel;
use App\Models\Opd\DashboardPetugasModel;
use Config\Services;

class DataAjuanABK extends BaseController
{
	protected $M_AjuanABK_OPD;
	protected $M_dashboard_opd;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_AjuanABK_OPD = new AjuanABKModel($this->request);

		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();

	
		$this->M_dashboard_opd = new DashboardPetugasModel($this->request);
		
	}

	
	// Halaman Data Ajuan ABK
	public function index()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		
		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_AjuanABK_OPD->getInstansiByLogin($username)->getResult();

		// $idInstansi = $this->session->get('instansi_id');
		$data['getAjuanABK'] = $this->M_AjuanABK_OPD->getAjuanABK($idInstansi['0']->instansi_id)->getResult();

		return view('v_data_ajuan_abk_petugas/index', $data);
	}


}

/* End of file DataFormasi.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Controllers/DataFormasi.php */