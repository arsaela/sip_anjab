<?php

namespace App\Models\Opd;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DashboardPetugasModel extends Model
{
	protected $table = "tbl_petugas";
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

	public function getInstansi()
	{
		$query =  $this->db->table('tbl_instansi')
			//->join('tbl_instansi', 'tbl_usulan.instansi_id = tbl_instansi.instansi_id')
			//  ->join('tbl_unor', 'tbl_usulan.instansi_unor = tbl_unor.instansi_unor')
			//  ->where('tbl_usulan.tahun_usulan',$yearnow)
			->get();
		return $query;
	}

	public function getPetugasNamaOpd($username) {
		$query =  $this->db->table('tbl_login')
			->select('*')
			->join('tbl_petugas', 'tbl_petugas.username = tbl_login.username')
			->join('tbl_instansi', 'tbl_petugas.instansi_id = tbl_instansi.instansi_id')
			->where('tbl_login.username', $username)
			->get();
		return $query;
	}
}

/* End of file PetugasModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/PetugasModel.php */