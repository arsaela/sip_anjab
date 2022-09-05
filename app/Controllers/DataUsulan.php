<?php

namespace App\Controllers;

use App\Models\UsulanModel;
use Config\Services;

class DataUsulan extends BaseController
{
	protected $M_usulan;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_usulan = new UsulanModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

	// Halaman Data usulan
	public function index()
	{
		$data['title']     = 'Data Usulan';
		$data['page']   = "datausulan";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$yearnow = date('Y');
		$data['getUsulan'] = $this->M_usulan->getUsulan($yearnow)->getResult();

		return view('v_dataUsulan/index', $data);
	}

	// Halaman Data Prodi
	public function detail_usulan($idUsulan)
	{
		$data['title']  = "App-SIP | Data Usulan";
		$data['page']   = "datausulan";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$data['getDetailUsulan'] = $this->M_usulan->getDetailUsulan($idUsulan)->getResult();
		//$data['getUsulanID'] = $this->M_usulan->getDetailUsulan($idUsulan)->getResult();
		//$data['getUsulan'] = $this->M_usulan->getUsulan($idUsulan)->getResult();

		return view('v_dataUsulan/detail_data_usulan', $data);
	}

	public function detail_pegawai_usulan()
	{
		if ($this->request->isAJAX()) {
			$idUnor =   $this->request->getVar('instansiunor');
			$idJabatan =  $this->request->getVar('jabatankode');
			$data = $this->M_usulan->getDetailPegawaiUsulan($idUnor, $idJabatan)->getResult();
			echo json_encode($data);
		}
	}

	public function approval_usulan_by_id($id)
	{
		$id = $this->request->getPost('detail_usulan_id');
		$usulan_id = $this->request->getPost('usulan_id');
		$data = array(
			'jumlah_approve_pppk'            => $this->request->getPost('jumlah_approve_pppk'),
			'jumlah_approve_cpns'            => $this->request->getPost('jumlah_approve_cpns'),
			'status_usulan_id'      	=> '3',
			'keterangan'      		    => '-',
		);

		// echo "<pre>";
		// print_r($data);
		// die('stop');

		$ApproveUsulan = $this->M_usulan->updateApprovalUsulan($data, $id);


		$get_usulan = 'H'.$id;
		$datausul = array(
				'status_usulan_id' => '3',
			);
		$update_status_history_usulan = $this->M_usulan->update_status_history_usulan($get_usulan, $datausul);

		// print_r($data);
		// print_r($get_usulan);
		// die('stttop');


		if($ApproveUsulan){
			session()->setFlashdata('message', 'Data berhasil di simpan');
			return redirect()->to('DataUsulan/detail_usulan/'. $usulan_id);
		} else {
			session()->setFlashdata('err',\Config\Services::validation()->listErrors()); 
			return redirect()->to('/DataUsulan/detail_usulan/'. $usulan_id); 
		}

		$dataredirect['page']   = "Detail_data_usulan";
		$dataredirect['nama']   = $this->session->get('nama');
		$dataredirect['email']   = $this->session->get('email');

		return redirect()->back();
	}


	public function reject_usulan_by_id($id)
	{
		$id = $this->request->getPost('detail_usulan_id');
		$usulan_id = $this->request->getPost('usulan_id');

		$data = array(
			'jumlah_approve_pppk'    => '0',
			'jumlah_approve_cpns'    => '0',
			'keterangan'        => $this->request->getPost('keterangan'),
			'status_usulan_id'     => '4',
		);

		$RejectUsulan = $this->M_usulan->updateRejectUsulan($data, $id);


		if($RejectUsulan){
			session()->setFlashdata('message', 'Data berhasil di simpan');
			return redirect()->to('DataUsulan/detail_usulan/'. $usulan_id);
		} else {
			session()->setFlashdata('err',\Config\Services::validation()->listErrors()); 
			return redirect()->to('/DataUsulan/detail_usulan/'. $usulan_id); 
		}

		$dataredirect['page']   = "Detail_data_usulan";
		$dataredirect['nama']   = $this->session->get('nama');
		$dataredirect['email']   = $this->session->get('email');

		// print_r($id);
		// die('STPPPPP');
		return redirect()->back();
	}

	public function get_pegawai_by_unor_and_instansi($idJabatan)
	{
		$data['page']   = "Get Data Pegawai by unor opd";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		#$getPegawaiByUnorAndInstansi = $this->M_usulan->getPegawaiByUnorAndInstansi($idJabatan)->getResult();


		return view('v_dataUsulan/index', $data);
	}

	public function cetak_usulan_all_by_year()
	{
		// Halaman Data Cetak Usulan

		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "datausulan";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$username   = $this->session->get('username');
		
		$tahun_usulan_now = date("Y");
		$data['getLihatUsulan'] = $this->M_usulan->getLihatUsulanByYear($tahun_usulan_now)->getResult();


		$tahun_usulan_now = date("Y");
		$data['getInstansiUsulan'] = $this->M_usulan->getInstansiUsulan($tahun_usulan_now)->getResult();

		// echo "<pre>";
		// print_r($data['getLihatUsulan']);
		// die('sstttopopp');

		return view('v_dataUsulan/cetak', $data);
	}

	// Halaman Data Pegawai
	public function cetakdatausulan()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		
		$username   = $this->session->get('username');
		//$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		//$idInstansi  = $this->M_pegawai->getInstansiByLogin($username)->getResult();
		//$getIDInstansi = $idInstansi['0']->instansi_id;
		
		$tahun_usulan_now = date("Y");
		$data['getDetailUsulanByInstansi'] = $this->M_usulan->getDetailUsulanByInstansi($tahun_usulan_now)->getResult();

		// echo "<pre>";
		// print_r($data['getDetailUsulanByInstansi']);
		// die('stttp');

		// echo "<pre>";
		// print_r($data['getPegawaiByInstansi']);
		// die('sttop');

		return view('v_dataUsulan/cetak_usulan_admin', $data);
	}
}
