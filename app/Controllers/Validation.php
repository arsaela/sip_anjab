<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Validation extends Controller
{
        public function index()
        {	//Load Helper Form dan url
			helper(['form', 'url']);
			//Cek Methode yang digunakan 
			if ($this->request->getMethod() !== 'post') {
			//Jika methode bukan post maka tidak perlu dilakukan validasi
				$val = $this->validate([]);
				echo view('validation_form',[
						   'validation' => $this->validator
					]);
			}else
			{
				//Field  Yang di validasi
				$val = $this->validate([
					'UserId' => ['label' => 'User ID', 'rules' => 'required|min_length[5]'],
					'NamaUser' => ['label' => 'Nama User', 'rules' => 'required|min_length[10]'],
					'EMail'  => ['label' => 'E-Mail', 'rules' => 'required|valid_email'],
					'Password' => ['label' => 'Password', 'rules' => 'required|min_length[8]'],
					'KonfirmasiPassword' => ['label' => 'Konfirmasi Password', 'rules' => 'required|matches[Password]'],
					'Umur'  => ['label' => 'Umur', 'rules' => 'required|numeric'],
				]);
				//Proses Validasi
				if (!$val)
				{   //Masih ada kesalahan pada validasi
					echo view('validation_form', [
						   'validation' => $this->validator
					]);
		 
				}else
				{	//Semua Field sudah tervalidasi
					echo 'Sukses';
				}
			}
        }
}