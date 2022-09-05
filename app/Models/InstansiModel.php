<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class InstansiModel extends Model
{
	protected $table = "tbl_instansi";
	protected $allowedFields = ['instansi_id', 'instansi_nama'];
	protected $useTimestamps = true;
	protected $column_order = [null, 'instansi_id', 'instansi_nama', null];
	protected $column_search = ['instansi_id', 'instansi_nama'];
	protected $order = ['tbl_instansi.id' => 'desc'];
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
}

/* End of file PetugasModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/PetugasModel.php */