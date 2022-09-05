<?php

namespace App\Controllers;

use App\Models\AlurPengusulanModel;
use Config\Services;

class DataAlurPengusulan extends BaseController
{
	protected $M_alur_pengusulan;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
        $this->db = db_connect();
        helper('form');

		$this->M_alur_pengusulan = new AlurPengusulanModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$session = \Config\Services::session();
	}

	// Halaman Data Alur Pengusulan
	public function index()
	{
		$data['title']     = 'Data Alur Pengusulan';
		$data['page']      = "dataalurpengusulan";
		$data['nama']      = $this->session->get('nama');
		$data['email']     = $this->session->get('email');

		$data['getAlurPengusulan'] = $this->M_alur_pengusulan->getAlurPengusulan()->getResult();

		return view('v_dataAlurPengusulan/index', $data);
	}

	public function add_alur_pengusulan()
	{
		helper(['form', 'url']);
		$data['title']     = 'Tambah Data Alur Pengusulan';
		$data['page']   = "dataalurpengusulan";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');


		if(isset($Save_Alur_Pengusulan)) {
			$data['message_success'] = "Data Alur Pengusulan berhasil di update";

			$data['title']     = 'Data Alur Pengusulan';
			$data['page']      = "dataalurpengusulan";
			$data['nama']      = $this->session->get('nama');
			$data['email']     = $this->session->get('email');

			$data['getAlurPengusulan'] = $this->M_alur_pengusulan->getAlurPengusulan()->getResult();

			return view('v_dataAlurPengusulan/index', $data);
		} else{
			$data['message_failed'] = "Data Alur Pengusulan gagal di update. Silahkan cek dan coba kembali !";

			return view('v_dataAlurPengusulan/add', $data);
		}
		
		return view('v_dataAlurPengusulan/add', $data);
	}

	public function upload() {

		helper(['form', 'url']);

		$database = \Config\Database::connect();
		$db = $database->table('tbl_alur_pengusulan');

		$input = $this->validate([
			'file' => [
				'uploaded[file]',
				'mime_in[file,image/jpg,image/jpeg,image/png]',
				'max_size[file,1024]',
			]
		]);

		if (!$input) {
			$session = session();
			$session->setFlashdata("error", "gambar masih kosong");

			return redirect()->to(base_url('/dataAlurPengusulan/add_alur_pengusulan'));
		} else {
			$img = $this->request->getFile('file');
            $namaAcak = $img->getRandomName(); //nama file gambar dibuat acak supaya tidak sama
            $img->move(ROOTPATH . 'public/uploads', $namaAcak); //direktori file uploads di dalam folder public

            $data = [
            	'alur_pengusulan_img' => $img->getName(),
            	'alur_pengusulan_judul' => $this->request->getPost('alur_pengusulan_judul'),
            	'alur_pengusulan_detail' => $this->request->getPost('alur_pengusulan_detail')
            ];

            $save = $db->insert($data);
            $session = session();
            $session->setFlashdata("success", "gambar berhasil terupload");
            return redirect()->to(base_url('/dataalurpengusulan'));
        }
    }


    public function update_alurpengusulan($id)
    {
    	$getAlurPengusulanByID = $this->M_alur_pengusulan->get_alur_pengusulan_by_id($id)->getRow();
    	if(isset($getAlurPengusulanByID))
    	{
    		$data['alur_pengusulan_by_id'] = $getAlurPengusulanByID;

    		$data['title']     = 'Update Data Alur Pengusulan';
    		$data['page']   	 = "updateDataAlurPengusulan";
    		$data['nama']   = $this->session->get('nama');
    		$data['email']   = $this->session->get('email');

    		return view('v_dataAlurPengusulan/update', $data);

    	}else{

    		echo '<script>
    		alert("Data Informasi ='.$id.' Tidak ditemukan");
    		window.location="'.base_url('datainformasi').'"
    		</script>';
    	}
    }

    public function edit_save_alur_pengusulan(){
    	if ($this->request->getMethod() !== 'post') {
    		return redirect()->to('dataalurpengusulan');
    	}
    	$id = $this->request->getPost('alur_pengusulan_id');
    	$validation = $this->validate([
    		'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
    	]);

    	if ($validation == FALSE) {

    		$data = [
    			// 'alur_pengusulan_img' => $img->getName(),
    			'alur_pengusulan_judul' => $this->request->getPost('alur_pengusulan_judul'),
    			'alur_pengusulan_detail' => $this->request->getPost('alur_pengusulan_detail')
    		];

    	} else {
    		$dt = $this->M_alur_pengusulan->get_alur_pengusulan_by_id($id)->getRow();

    		$gambar = $dt->alur_pengusulan_img;
    		$path = '../public/uploads/';
    		@unlink($path.$gambar);
    		$upload = $this->request->getFile('file_upload');
    		$upload->move(WRITEPATH . '../public/uploads/');

    		$data = [
    			'alur_pengusulan_img' => $upload->getName(),
    			'alur_pengusulan_judul' => $this->request->getPost('alur_pengusulan_judul'),
    			'alur_pengusulan_detail' => $this->request->getPost('alur_pengusulan_detail')
    		];

    	}
    	$this->M_alur_pengusulan->edit_data($id,$data);
    	return redirect()->to('./dataalurpengusulan')->with('berhasil', 'Data Berhasil di Ubah');
    }



// Delete Data Alur Pengusulan
    public function delete_alur_pengusulan($alur_pengusulan_id)
    {
        $success = $this->db->query("DELETE FROM tbl_alur_pengusulan WHERE alur_pengusulan_id  = '$alur_pengusulan_id'");


        if($success) {
            session()->setFlashdata('message', 'Data berhasil dihapus');
            return redirect()->to('/dataalurpengusulan/');
        }
    }



}