<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class AdminModel1 extends Model
{
    protected $table = 'tbl_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'admin_nama', 'admin_no_hp', 'admin_email'];
    protected $useTimestamps = 'true';
    

    public function get_admin()
	{
		$query =  $this->db->table('tbl_admin')
			->select('*')
			->join('tbl_login', 'tbl_login.username = tbl_admin.username')
			//->join('tbl_unor', 'tbl_usulan.instansi_unor = tbl_unor.instansi_unor')
			// ->where('tbl_admin.username', $yearnow)
			->get();
		return $query;
	}
}

/* End of file AdminModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/AdminModel.php */