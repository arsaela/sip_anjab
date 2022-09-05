<?php

namespace App\Models\Opd;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class AjuanABKModel extends Model
{
	protected $table = "tbl_temp_formasi";
	protected $allowedFields = ['instansi_id', 'instansi_uker', 'jabatan_kode', 'formasi_jumlah'];
	protected $column_order = [null, 'instansi_id', 'instansi_uker', 'jabatan_kode', 'formasi_jumlah', null];
	protected $column_search = ['instansi_id', 'instansi_uker', 'jabatan_kode', 'formasi_jumlah'];
	protected $order = ['temp_formasi_id' => 'asc'];
	protected $request;
	protected $db;
	protected $dt;

	function __construct(RequestInterface $request)
	{
		parent::__construct();
		$this->db = db_connect();
		$this->request = $request;
		$this->dt = $this->db->table($this->table);
	}


	public function getInstansiByLogin($username) {
		$query =  $this->db->table('tbl_login')
		->select('tbl_petugas.instansi_id')
		->join('tbl_petugas', 'tbl_petugas.username = tbl_login.username')
		->where('tbl_login.username', $username)
		->get();
		return $query;
	}


	public function getAjuanABK($idInstansi)
	{
		$query =  $this->db->table('tbl_temp_formasi')
		->select('*')
		->where('tbl_temp_formasi.instansi_id', $idInstansi)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_temp_formasi.instansi_unor and tbl_formasi.jabatan_kode = tbl_temp_formasi.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_temp_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_temp_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		// ->join('status_usulan', 'status_usulan.status_usulan_id = tbl_temp_formasi.status_ajuan_abk_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_temp_formasi.instansi_id', 'left')
		->where('tbl_temp_formasi.status_ajuan_abk_id', '1')
		->get();
		return $query;
	}




}

/* End of file FormasiModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/FormasiModel.php */