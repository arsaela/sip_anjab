<?php namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class AlurPengusulanModel extends Model  
{

	protected $table = "tbl_alur_pengusulan";
	// protected $allowedFields = ['tgl_buka', 'tgl_tutup', 'tgl_pengumuman'];
	// protected $column_order = [null, 'tgl_buka', 'tgl_tutup', 'tgl_pengumuman', null];
	// protected $column_search = ['tgl_buka', 'tgl_tutup', 'tgl_pengumuman'];
	protected $order = ['alur_pengusulan_id' => 'desc'];
	protected $allowedFields = ["alur_pengusulan_img","alur_pengusulan_detail"];
	protected $request;
	protected $db;
	protected $dt;

	function __construct(RequestInterface $request){
	   parent::__construct();
	   $this->db = db_connect();
	   $this->request = $request;
	   $this->dt = $this->db->table($this->table);
	}

	public function getAlurPengusulan()
	{
		$query =  $this->db->table('tbl_alur_pengusulan')
			->select('*')
			->get();
		return $query;
	}

	public function save_alur_pengusulan($data)
    {
        $builder = $this->db->table('tbl_alur_pengusulan');
        return $builder->insert($data);
    }

	public function get_alur_pengusulan_by_id($id)
    {
        $query =  $this->db->table('tbl_alur_pengusulan')
			->select('*')
			->where('tbl_alur_pengusulan.alur_pengusulan_id', $id)
			->get();
		return $query;
    }

	public function updatealurpengusulan($data,$id)
    {
        $builder =  $this->db->table('tbl_alur_pengusulan');
        $builder->where('alur_pengusulan_id', $id);
        return $builder->update($data);
    }

     public function edit_data($id,$data)
    {
        $query = $this->db->table($this->table)->update($data, array('alur_pengusulan_id' => $id));
        return $query;
    }


}

/* End of file InformasiModel.php */
/* Location: .//C/xampp/htdocs/app-pmb/app/Models/InformasiModel.php */