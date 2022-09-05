<?php

namespace App\Models;


use CodeIgniter\Model;

class importDataModel extends Model
{
	protected $table = 'tbl_pegawai';
	protected $primaryKey = 'id';
	protected $allowedFields =['pegawai_nama','pegawai_status','instansi_id','instansi_unor','jabatan_kode','pegawai_nip','pegawai_gol'];

}

/* End of file PetugasModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/PetugasModel.php */




