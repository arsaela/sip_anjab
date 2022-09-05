<?php

namespace App\Controllers;

use App\Models\InformasiModel;
use Config\Services;

class DataInformasi extends BaseController
{
	protected $M_informasi;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_informasi = new InformasiModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$session = \Config\Services::session();
	}

	// Halaman Data Informasi
	public function index()
	{
		$data['title']     = 'Data Informasi';
		$data['page']   = "datainformasi";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$data['getInformasi'] = $this->M_informasi->getInformasi()->getResult();

		return view('v_dataInformasi/index', $data);
	}

	public function update_informasi($id)
    {
        $getInformasiByID = $this->M_informasi->get_informasi_by_id($id)->getRow();
        if(isset($getInformasiByID))
        {
          	  $data['informasi_by_id'] = $getInformasiByID;
			
			  $data['title']     = 'Update Data Informasi';
			  $data['page']   	 = "updateDataInformasi";
			  $data['nama']   = $this->session->get('nama');
			  $data['email']   = $this->session->get('email');

			  return view('v_dataInformasi/update', $data);

        }else{

            echo '<script>
                    alert("Data Informasi ='.$id.' Tidak ditemukan");
                    window.location="'.base_url('datainformasi').'"
                </script>';
        }
    }

	public function save_update()
    {
        $id = $this->request->getPost('informasi_id');
        $data = array(
            'informasi_judul' => $this->request->getPost('informasi_judul'),
            'informasi_content' => $this->request->getPost('informasi_content')
        );
		
        $updatedatasuccess = $this->M_informasi->updateInformasi($data,$id);
		if(isset($updatedatasuccess)){
			$data['message_success'] = "Data Informasi berhasil di update";

			$data['title']     = 'Data Informasi';
			$data['page']   = "datainformasi";
			$data['nama']   = $this->session->get('nama');
			$data['email']   = $this->session->get('email');

			$data['getInformasi'] = $this->M_informasi->getInformasi()->getResult();

			return view('v_dataInformasi/index', $data);
		} else{
			$data['message_failed'] = "Data Informasi gagal di update. Silahkan cek dan coba kembali !";

			return view('v_dataInformasi/update', $data);
		}
		
	
	}
}