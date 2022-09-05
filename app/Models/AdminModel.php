<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class AdminModel extends Model
{
	protected $table = "tbl_admin";
	protected $allowedFields = ['username', 'admin_nama', 'admin_no_hp', 'admin_email'];
	protected $column_order = [null, 'username', 'admin_nama', 'admin_no_hp', 'admin_email', null];
	protected $column_search = ['username', 'admin_nama', 'admin_no_hp', 'admin_email'];
	protected $order = ['id' => 'desc'];
	protected $request;
	protected $db;
	protected $dt;

	function __construct(RequestInterface $request)
	{
		parent::__construct();
		$this->db = db_connect();
		$this->request = $request;
		$this->dt = $this->db->table($this->table)
			->join('tbl_login', 'tbl_login.username = tbl_admin.username');
	}

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

	private function _get_datatables_query()
	{
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($this->request->getPost('search')['value']) {
				if ($i === 0) {
					$this->dt->groupStart();
					$this->dt->like($item, $this->request->getPost('search')['value']);
				} else {
					$this->dt->orLike($item, $this->request->getPost('search')['value']);
				}
				if (count($this->column_search) - 1 == $i)
					$this->dt->groupEnd();
			}
			$i++;
		}

		if ($this->request->getPost('order')) {
			$this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->dt->orderBy(key($order), $order[key($order)]);
		}
	}

	public function save_admin_in_admin($data)
	{
		$builder = $this->db->table('tbl_admin');
		return $builder->insert($data);
	}

	public function save_admin_in_login($data2)
	{
		$builder2 = $this->db->table('tbl_login');
		return $builder2->insert($data2);
	}

	public function update_admin_in_admin($data)
	{
		$builder = $this->db->table('tbl_admin');
		return $builder->replace($data);
	}

public function update_admin($data,$id)
    {
        $builder =  $this->db->table('tbl_admin');
        $builder->where('id', $id);
        return $builder->update($data);
    }

	public function getAdmin()
	{
		$query =  $this->db->table('tbl_admin')
			->select('*')
			->get();
		return $query;
	}



	public function update_admin_in_login($data2)
	{
		$builder2 = $this->db->table('tbl_login');
		return $builder2->replace($data2);
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($this->request->getPost('length') != -1)
			$this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
		$query = $this->dt->get();
		return $query->getResult();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		return $this->dt->countAllResults();
	}

	public function count_all()
	{
		$tbl_storage = $this->db->table($this->table);
		return $tbl_storage->countAllResults();
	}

	// public function delete_admin_in_login($username)
	// {
	// 	$builder = $this->db->table('tbl_login');
	// 	return $builder->replace($data);
	// }

	 public function delete_admin_in_login($username)
    {
        $builder = $this->db->table('tbl_login');
        return $builder->delete('username', $username);
    }


    	public function get_admin_by_id($id)
    {
        $query =  $this->db->table('tbl_admin')
			->select('*')
			->where('tbl_admin.id', $id)
			->get();
		return $query;
    }
}

/* End of file AdminModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/AdminModel.php */