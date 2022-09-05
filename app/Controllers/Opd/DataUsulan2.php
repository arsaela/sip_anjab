<?php

namespace App\Controllers\Opd;

use App\Controllers\BaseController;
use App\Models\Opd\DataPegawaiOPDModel;
use App\Models\Opd\UsulanOPDModel;
use App\Models\Opd\DashboardPetugasModel;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use Config\Services;

class DataUsulan extends BaseController
{
	protected $M_pegawai;
	protected $M_usulan_OPD;
	protected $M_dashboard_opd;
	protected $request;
	protected $form_validation;
	protected $qrCode;
	protected $barcode;
	//protected $session;

	public function __construct()
	{
		$this->qrCode = new QrCode();
		$this->barcode = new BarcodeGenerator();
		$this->request = Services::request();
		$this->M_usulan_OPD = new UsulanOPDModel($this->request);

		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->session->start();
		//$session = \Config\Services::session(); 
		$this->M_pegawai = new DataPegawaiOPDModel($this->request);

		$this->M_dashboard_opd = new DashboardPetugasModel($this->request);
	}


	// Halaman Data Usulan Petugas
	public function index()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		$data['getDetailFormasiUsulan'] = $this->M_usulan_OPD->getKebutuhanFormasi($idInstansi['0']->instansi_id)->getResult();

		// $data['get_data_usulan_found'] = $this->M_usulan_OPD->getDataUsulanFound($idInstansi['0']->instansi_id)->getResult();

		// echo "<pre>";
		// print_r($data['getDetailFormasi']);
		// die('stttop');

		return view('v_datausulan_petugas/index', $data);
	}

	public function inputusulanopd()
	{
		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$data = array(
			'instansi_id'       => $idInstansi['0']->instansi_id,
			'instansi_unor'     => $this->request->getPost('instansi_unor'),
			'tahun_usulan' 		=> date("Y"),
			'jabatan_kode' 		=> $this->request->getPost('jabatan_kode'),
			'jumlah_usulan' 	=> $this->request->getPost('jumlah_usulan_formasi'),
			'status_usulan_id' 	=> '1',
		);
		$inputusulanopd = $this->M_usulan_OPD->inputusulanopd($data);

		if (isset($inputusulanopd)) {
			$data['message_success'] = "Usulan anda telah berhasil di tambahkan";

			$data['title']     = 'Data Input Usulan';
			$data['page']      = "opd/datausulan/inputusulanopd";
			$data['nama']      = $this->session->get('nama');
			$data['email']     = $this->session->get('email');


			$data['getDetailFormasiUsulan'] = $this->M_usulan_OPD->getKebutuhanFormasi($idInstansi['0']->instansi_id)->getResult();

			$session = session();

			$session->setFlashdata('success', 'User Updated successfully');

			return redirect()->to('/opd/datausulan/');
		} else {
			$data['message_failed'] = "Data Usulan anda gagal di update. Silahkan cek dan coba kembali !";
		}
	}

	public function kirimdatausulanopd()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		$tahun_usulan_now = date("Y");
		$data['getLihatUsulanDescYear'] = $this->M_usulan_OPD->getLihatUsulanDescYear($idInstansi['0']->instansi_id)->getResult();

		return view('v_datausulan_petugas/kirim_usulan_opd', $data);
	}

	public function aksi_kirimdatausulanopd($instansi_id)
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$tahun_usulan_now = date("Y");
		$getUsulanByYear = $this->M_usulan_OPD->getUsulanByYear($idInstansi['0']->instansi_id, $tahun_usulan_now)->getResult();

		$no = 1;


		//$data2 = [];
		foreach ($getUsulanByYear as $value) {
			$data2 = array(


				'instansi_id'       => $value->instansi_id,
				'instansi_unor'     => $value->instansi_unor,
				'tahun_usulan' 		=> $value->tahun_usulan,
			);
		}
		// //echo $tahun_usulan_now;
		// echo "data =";
		// print_r($data2);
		// echo "<br>";
		// // 	//echo $value->instansi_id;
		// // echo "<br>";
		// // 	//echo $value->instansi_unor;
		// // echo "<br>";
		// // 	// die('stopop');



		echo "<pre>";
		print_r($data2);
		die('stopop');




		//$delete_tmp_data_usulan = $this->M_usulan_OPD->delete_tmp_data_usulan($data);


		//$data['get_tahun_usulan'] = $tahun_usulan;


	

		$inputusulanopd = $this->M_usulan_OPD->aksi_kirim_usulan_move_tmp_to_usulan($data2);

		if (isset($inputusulanopd)) {
			$session = session();

			$session->setFlashdata('success', 'User Updated successfully');

			return redirect()->to('/opd/datausulan/kirimdatausulanopd');
		}
	}

	public function detail_usulan_by_year_and_opd($tahun_usulan)
	{

		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		$data['getLihatUsulan'] = $this->M_usulan_OPD->getLihatUsulan($idInstansi['0']->instansi_id)->getResult();
		$data['get_tahun_usulan'] = $tahun_usulan;

		return view('v_datausulan_petugas/detail_usulan_by_year', $data);
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


	// Halaman Data Lihat Usulan
	public function lihatusulanopd()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		$data['getLihatUsulan'] = $this->M_usulan_OPD->getLihatUsulan($idInstansi['0']->instansi_id)->getResult();

		// echo "<pre>";
		// print_r($data['getDetailFormasi']);
		// die('stttop');

		return view('v_lihat_datausulan_petugas/index', $data);
	}


	// Halaman Data Cetak Data Pegawai
	public function cetakdatausulan()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		$getIDInstansi = $idInstansi['0']->instansi_id;
		$data['getnamaInstansi'] = $this->M_pegawai->getnamaInstansi($getIDInstansi)->getResult();

		$data['getLihatUsulan'] = $this->M_usulan_OPD->getLihatUsulan($idInstansi['0']->instansi_id)->getResult();

		$data['QR'] = $this->qrCode
			->setText('QR code by codeitnow.in')
			->setSize(100)
			->setPadding(10)
			->setErrorCorrection('high')
			->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
			->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
			->setLabel('Digitally Signed')
			->setLabelFontSize(11)
			->setImageType(QrCode::IMAGE_TYPE_PNG);

		//echo '<img src="data:' . $this->qrCode->getContentType() . ';base64,' . $this->qrCode->generate() . '" />';

		return view('v_dataUsulan_petugas/cetak', $data);
	}
}

/* End of file DataFormasi.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Controllers/DataFormasi.php */