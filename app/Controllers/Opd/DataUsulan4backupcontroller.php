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
		$tahun_usulan_now = date("Y");

		$data['getDetailFormasiUsulan'] = $this->M_usulan_OPD->getKebutuhanFormasi($idInstansi['0']->instansi_id)->getResult();

		$data['getcheckstatususulan'] = $this->M_usulan_OPD->getCheckStatusUsulan($idInstansi['0']->instansi_id)->getResult();
		

// echo "<pre>";
// //print_r($data['getDetailFormasiUsulan']);
// print_r($data['getcheckstatususulan']);
// die('STTTOP');

		$data['status'] = $this->M_usulan_OPD->getStatusUsulan($idInstansi['0']->instansi_id,$tahun_usulan_now)->getResult();
		// $data['status'] = $this->M_usulan_OPD->getStatusUsulan($idInstansi,$tahun_usulan_now);
		// echo "<pre>";
		// print_r($data['status']);
		// die('stop');

		// echo "<pre>";
		// print_r($data['getDetailFormasiUsulan']);
		// die('stttoppp');

		return view('v_datausulan_petugas/index', $data);
	}

	public function inputusulanopd()
	{
		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$get_inputan_instansi_unor = $this->request->getPost('instansi_unor');
		$get_inputan_jabatan_kode = $this->request->getPost('jabatan_kode');

		$datenow = date("Y");
		$explode_tahun_usulan = substr($datenow,2);
		// print_r($explode_tahun_usulan);

		$data_history_usulan_opd = array(
			'history_usulan_id ' => 'HU-'.$get_inputan_instansi_unor.'-'.$get_inputan_jabatan_kode.'-'.$explode_tahun_usulan,
			'instansi_id'       => $idInstansi['0']->instansi_id,
			'instansi_unor'       => $get_inputan_instansi_unor,
			'tahun_usulan' 		=> date("Y"),
			'jabatan_kode' 		=> $get_inputan_jabatan_kode,
			'jumlah_usulan' 	=> $this->request->getPost('jumlah_usulan_formasi'),
			'status_usulan_id' 	=> '1',

		);
		$input_history_usulan_opd = $this->M_usulan_OPD->input_history_usulan_opd($data_history_usulan_opd);

		if (isset($input_history_usulan_opd)) {
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

		$tahun_usulan_now = date("Y");
		$data['getLihatUsulan'] = $this->M_usulan_OPD->getLihatUsulanNow($idInstansi['0']->instansi_id, $tahun_usulan_now)->getResult();

		return view('v_lihat_datausulan_petugas/index', $data);
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

		$datenow = date("Y");
		$explode_tahun_usulan = substr($datenow,2);
		
		//$data2 = [];
		foreach ($getUsulanByYear as $key =>  $value) {

			$data_usulan = array(
				'usulan_id'			=> 'U-'.$value->instansi_id.'-'.$explode_tahun_usulan,     
				'instansi_id'       => $value->instansi_id,
				'tahun_usulan' 		=> $value->tahun_usulan,
			);

			$data_detail_usulan[] = array(
				'detail_usulan_id'  => 'U-'.$value->instansi_unor.'-'.$value->jabatan_kode.'-'.$explode_tahun_usulan,
				'usulan_id'			=> 'U-'.$value->instansi_id.'-'.$explode_tahun_usulan,
				'instansi_unor'     => $value->instansi_unor,
				'jabatan_kode'     	=> $value->jabatan_kode,
				'jumlah_usulan'     => $value->jumlah_usulan,
				'jumlah_approve'    => '-',
				'status_usulan_id'	=> '2',
				'keterangan'		=> '-',
			);
			$get_usulan = 'HU-'.$value->instansi_unor.'-'.$value->jabatan_kode.'-'.$explode_tahun_usulan;

			$datausul = array(
				'status_usulan_id' => '2',
			);
			$update_status_history_usulan = $this->M_usulan_OPD->update_status_history_usulan($get_usulan, $datausul);

		}

		$inputusulanopd = $this->M_usulan_OPD->aksi_kirim_usulan_opd($data_usulan);
		$inputdata_detail_usulan_opd = $this->M_usulan_OPD->aksi_kirim_detail_usulan_opd($data_detail_usulan);

		if (isset($inputusulanopd)) {
			$session = session();

			$session->setFlashdata('success', 'Usulan Berhasil di Kirim');

			return redirect()->to('/opd/datausulan/kirimdatausulanopd');
		} else {
			$data['message_failed'] = "Data Usulan anda gagal di kirim. Silahkan cek dan coba kembali !";
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

		// $data['getLihatUsulan'] = $this->M_usulan_OPD->getLihatUsulan($idInstansi['0']->instansi_id)->getResult();
		$tahun_usulan_now = date("Y");
		$data['getLihatUsulan'] = $this->M_usulan_OPD->getLihatUsulan($idInstansi['0']->instansi_id,$tahun_usulan_now)->getResult();


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

		$tahun_usulan_now = date("Y");
		$data['getLihatUsulan'] = $this->M_usulan_OPD->getLihatUsulan($idInstansi['0']->instansi_id,$tahun_usulan_now)->getResult();

		// echo "<pre>";
		// print_r($data['getLihatUsulan']);
		// die('sttop');

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



	public function inputusulanopd_backup()
	{
		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$get_inputan_instansi_unor = $this->request->getPost('instansi_unor');
		$get_inputan_jabatan_kode = $this->request->getPost('jabatan_kode');


		$data_usulan_opd = array(
			'usulan_id'			=> 'U-'.$idInstansi['0']->instansi_id.'-'.$get_inputan_jabatan_kode.'-'.date("Y"),
			'instansi_id'       => $idInstansi['0']->instansi_id,
			'tahun_usulan' 		=> date("Y"),
		);
		$inputusulanopd = $this->M_usulan_OPD->inputusulanopd($data_usulan_opd);

		// print_r($data_usulan_opd);
		// die('sttop');

		// echo "<pre>";
		// print_r($data_usulan_opd);
		// echo "<br>";
		// print_r($data_detail_usulan_opd);
		// echo "aaa";
		// die('sttop');



		$data_detail_usulan_opd = array(
			'usulan_id'			=> 'U-'.$idInstansi['0']->instansi_id.'-'.$get_inputan_jabatan_kode.'-'.date("Y"),
			'instansi_unor'     => $get_inputan_instansi_unor,
			'jabatan_kode' 		=> $get_inputan_jabatan_kode,
			'jumlah_usulan' 	=> $this->request->getPost('jumlah_usulan_formasi'),
			'status_usulan_id' 	=> '1',
		);
		$inputdetailusulanopd = $this->M_usulan_OPD->inputdetailusulanopd($data_detail_usulan_opd);

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



// Halaman Data Lihat Usulan
	public function rekapusulanopd()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_usulan_OPD->getInstansiByLogin($username)->getResult();

		// $data['getLihatUsulan'] = $this->M_usulan_OPD->getLihatUsulan($idInstansi['0']->instansi_id)->getResult();

		$tahun_usulan_now = date("Y");
		$data['getLihatUsulan'] = $this->M_usulan_OPD->getLihatUsulan($idInstansi['0']->instansi_id,$tahun_usulan_now)->getResult();

		return view('v_datausulan_petugas/rekap_usulan_opd', $data);
	}











}

/* End of file DataFormasi.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Controllers/DataFormasi.php */