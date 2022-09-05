<?php
namespace App\Controllers\Opd;
use App\Controllers\BaseController;

use App\Models\Opd\FormasiPetugasModel;
use App\Models\Opd\DashboardPetugasModel;
use Config\Services;

class DataFormasi extends BaseController
{
	protected $M_formasi_Petugas;
	protected $M_dashboard_opd;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_formasi_Petugas = new FormasiPetugasModel($this->request);

		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();


		$this->M_dashboard_opd = new DashboardPetugasModel($this->request);
		
	}

	
	// Halaman Data Formasi
	public function index()
	{
		$data['title']  = "App-SIP | Data Formasi";
		$data['page']   = "dataformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');


		// date_default_timezone_set('Asia/Jakarta');
		// echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');
		// echo date('Y-m-d H:i:s');
		// die("stttop");
		
		$username   = $this->session->get('username');
		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$username   = $this->session->get('username');
		$idInstansi  = $this->M_formasi_Petugas->getInstansiByLogin($username)->getResult();

		// $idInstansi = $this->session->get('instansi_id');
		$data['getDetailFormasi'] = $this->M_formasi_Petugas->getDetailFormasi($idInstansi['0']->instansi_id)->getResult();

		return view('v_dataFormasi_petugas/index', $data);
	}


	public function ajukan_perubahan_abk_opd()
	{
		$username   = $this->session->get('username');
		$idInstansi  = $this->M_formasi_Petugas->getInstansiByLogin($username)->getResult();

		$data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();

		$get_inputan_instansi_unor = $this->request->getPost('instansi_unor');
		$get_inputan_jabatan_kode = $this->request->getPost('jabatan_kode');

		$datenow = date("Y");
		$explode_tahun_ajuan_perubahan_abk = substr($datenow,2);

		date_default_timezone_set('Asia/Jakarta');
		// echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');

		// echo date('Y-m-d H:i:s');
		// die("stttop");

		$data_temp_formasi = array(
			'temp_formasi_id' => 'TF-'.$get_inputan_instansi_unor.'-'.$get_inputan_jabatan_kode.'-'.$explode_tahun_ajuan_perubahan_abk,
			'instansi_id'       => $idInstansi['0']->instansi_id,
			'instansi_unor'     => $get_inputan_instansi_unor,
			'tanggal_ajuan' 	=> date('Y-m-d H:i:s'),
			'jabatan_kode' 		=> $get_inputan_jabatan_kode,
			'jumlah_abk_baru' 	=> $this->request->getPost('jumlah_abk_yang_diajukan'),
			'status_ajuan_abk_id' => '1',

		);
		$input_temp_formasi_ajukan_perubahan_abk = $this->M_formasi_Petugas->input_temp_formasi_ajukan_perubahan_abk($data_temp_formasi);

		if (isset($input_temp_formasi_ajukan_perubahan_abk)) {
			$data['message_success'] = "Usulan anda telah berhasil di tambahkan";

			$data['title']     = 'Data Input Usulan';
			$data['page']      = "opd/datausulan/inputusulanopd";
			$data['nama']      = $this->session->get('nama');
			$data['email']     = $this->session->get('email');


			$data['getDetailFormasiUsulan'] = $this->M_formasi_Petugas->getKebutuhanFormasi($idInstansi['0']->instansi_id)->getResult();
			//$data['cekSudahKirim'] = $this->M_usulan_OPD->cekSudahKirim($idInstansi['0']->instansi_id)->getRow();
			// $data['cekFormasiAjuanABK'] = $this->M_usulan_OPD->cekFormasiAjuanABK($idInstansi['0']->instansi_id);

			$session = session();

			$session->setFlashdata('success', 'User Updated successfully');

			return redirect()->to('/opd/dataformasi/');
		} else {
			$data['message_failed'] = "Data Usulan anda gagal di update. Silahkan cek dan coba kembali !";
		}
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