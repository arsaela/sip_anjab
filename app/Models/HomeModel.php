<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class HomeModel extends Model
{
	protected $table = "tbl_batas_pengusulan";
	//--
	protected $allowedFields = ['id', 'waktu'];
	protected $column_order = [null, 'id', 'waktu'];
	protected $order = ['id' => 'desc'];
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

	public function get_data_informasi()
	{
		$query =  $this->db->table('tbl_informasi')
			->get();
		return $query;
	}	

	public function get_data_alur_pengusulan()
	{
		$query =  $this->db->table('tbl_alur_pengusulan')
			->get();
		return $query;
	}

    public function select_time(){
		$query =  $this->db->table('tbl_batas_pengusulan')
			     ->get();
		return $query;
	}

    
}

/* End of file PetugasModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/PetugasModel.php */




