<?php

namespace App\Controllers;

use App\Models\petugasModel;
use Config\Services;

class Datapetugas extends BaseController
{
	protected $encrypter;
	protected $M_petugas;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->encrypter = \Config\Services::encrypter();
		$this->request = Services::request();
		$this->M_petugas = new petugasModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Data petugas
	private function _action($idpetugas)
	{
		$link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editpetugas' title='Update' value='" . $idpetugas . "'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='" . base_url('datapetugas/delete/' . $idpetugas) . "' class='btn-deletepetugas' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	    ";
		return $link;
	}

	// Halaman Data petugas
	public function index()
	{
		$data['title']  = "App-SIP | Data petugas";
		$data['page']   = "datapetugas";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		$data['instansi_nama'] = $this->M_petugas->get_instansi();
		return view('v_datapetugas/index', $data);
	}

	// Add Data petugas
	public function add()
	{
		$username = $this->request->getPost('username2');
		$petugas_nama = $this->request->getPost('petugas_nama2');
		$petugas_no_hp = $this->request->getPost('petugas_no_hp2');
		$petugas_email = $this->request->getPost('petugas_email2');
		$petugas_password = $this->request->getPost('petugas_password2');
		$instansi_id = $this->request->getPost('instansi_id2');

		//Data petugas
		$data = [
			'username' => $username,
			'petugas_nama' => $petugas_nama,
			'petugas_no_hp' => $petugas_no_hp,
			'instansi_id' => $instansi_id,
			'petugas_email' => $petugas_email
		];

		$data2 = [
			'username' => $username,
			'password'    =>  base64_encode($this->encrypter->encrypt($petugas_password)),
			'hak_akses'   => 'petugas'
		];

		//Simpan Data petugas
		$this->M_petugas->save_petugas_in_petugas($data);
		$this->M_petugas->save_petugas_in_login($data2);

		$validasi = [
			'success'   => true
		];
		echo json_encode($validasi);
	}

	// Menampilkan Data petugas Pada Modal Edit Data petugas
	public function ajaxUpdate($idpetugas)
	{
		$data = $this->M_petugas->find($idpetugas);
		echo json_encode($data);
	}

	// Update Data petugas
	public function update()
	{
		$id = $this->request->getPost('idpetugas');
		$username = $this->request->getPost('username2');
		$petugas_nama = $this->request->getPost('petugas_nama2');
		$petugas_no_hp = $this->request->getPost('petugas_no_hp2');
		$petugas_email = $this->request->getPost('petugas_email2');
		$petugas_password = $this->request->getPost('petugas_password2');
		$instansi_id = $this->request->getPost('instansi_id2');

		//Data petugas
		$data = [
			'id' => $id,
			'username' => $username,
			'petugas_nama' => $petugas_nama,
			'petugas_no_hp' => $petugas_no_hp,
			'petugas_email' => $petugas_email,
			'instansi_id' => $instansi_id
		];

		$data2 = [
			'username' => $username,
			'password'    =>  base64_encode($this->encrypter->encrypt($petugas_password)),
			'hak_akses'   => 'petugas'
		];

		//Update Data petugas
		$this->M_petugas->update_petugas_in_petugas($data);
		$this->M_petugas->update_petugas_in_login($data2);

		$validasi = [
			'success'   => true
		];
		echo json_encode($validasi);
	}

	// Delete Data petugas
	public function delete($id)
	{
		$this->M_petugas->delete($id);
	}

	// Datatable server side
	public function ajaxDatapetugas()
	{

		if ($this->request->getMethod(true) == 'POST') {
			//$lists = $this->M_petugas->get_datatables();
			$lists = $this->M_petugas->get_petugas()->getResult();
			$data = [];
			$no = $this->request->getPost("start");
			//$decrypted_string = $this->encrypt->decode($encrypted_password, $key);
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $list->username;
				$row[] = $this->encrypter->decrypt(base64_decode($list->password));
				$row[] = $list->petugas_nama;
				$row[] = $list->petugas_no_hp;
				$row[] = $list->petugas_email;
				$row[] = $list->instansi_nama;
				$row[] = $this->_action($list->id_petugas);
				$data[] = $row;
			}
			$output = [
				"draw"                 => $this->request->getPost('draw'),
				"recordsTotal"         => $this->M_petugas->count_all(),
				"recordsFiltered"     => $this->M_petugas->count_filtered(),
				"data"                 => $data
			];
			echo json_encode($output);
		}
	}
}

/* End of file Datapetugas.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Controllers/Datapetugas.php */
