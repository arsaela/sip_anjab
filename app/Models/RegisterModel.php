<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class RegisterModel extends Model
{
	protected $table = "tbl_petugas";
	protected $allowedFields = ['username', 'petugas_nama', 'petugas_no_hp', 'petugas_email', 'instansi_id'];
	protected $column_order = [null, 'username', 'petugas_nama', 'petugas_no_hp', 'petugas_email', 'instansi_id', null];
	protected $column_search = ['username', 'petugas_nama', 'petugas_no_hp', 'petugas_email', 'instansi_id'];
	protected $order = ['id' => 'asc'];
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

    
    public function RegisterPetugas($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }


}

/* End of file FormasiModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/FormasiModel.php */