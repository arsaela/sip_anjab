<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class UsulanModel extends Model
{
	protected $table = "tbl_usulan";
	//--
	protected $allowedFields = ['usulan_id', 'instansi_id', 'instansi_unor', 'jabatan_kode', 'jumlah'];
	protected $column_order = [null, 'usulan_id', 'instansi_id', 'instansi_unor', 'jabatan_kode', 'jumlah', null];
	protected $column_search = ['usulan_id', 'instansi_id', 'instansi_unor', 'jabatan_kode', 'jumlah'];
	protected $order = ['usulan_id' => 'desc'];
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

	public function getUsulan($yearnow)
	{
		$query =  $this->db->table('tbl_usulan')
		->select('*')
		->join('tbl_instansi', 'tbl_usulan.instansi_id = tbl_instansi.instansi_id')
			//->join('tbl_unor', 'tbl_usulan.instansi_unor = tbl_unor.instansi_unor')
		->where('tbl_usulan.tahun_usulan', $yearnow)
		->get();
		return $query;
	}


	public function getDetailUsulan($idUsulan)
	{
		$query =  $this->db->table('tbl_detail_usulan')
		->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan,tbl_instansi.instansi_nama, count(tbl_pegawai.pegawai_nip) as jumlahasn')
		->where('tbl_detail_usulan.usulan_id', $idUsulan)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_detail_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id =  tbl_detail_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_formasi.instansi_id', 'left')
		->join('tbl_pegawai', 'tbl_formasi.instansi_unor = tbl_pegawai.instansi_unor and tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
		->groupBy('jabatan')
		->orderBy('tbl_formasi.instansi_unor asc')
		->get();
		return $query;
	}

	public function getDetailPegawaiUsulan($idUnor, $idJabatan)

	{
		$query =  $this->db->table('tbl_detail_usulan')
		->select('*,tbl_instansi.instansi_nama, count(tbl_pegawai.pegawai_nip) as jumlahasn')
		->join('tbl_usulan', 'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id', 'left')
		->join('tbl_formasi', 'tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_usulan.instansi_id', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('tbl_pegawai', 'tbl_formasi.instansi_unor = tbl_pegawai.instansi_unor and tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
		->where('tbl_pegawai.jabatan_kode', $idJabatan)
		->where('tbl_pegawai.instansi_unor', $idUnor)
		->get();
		return $query;
	}


	public function getApproveUsulan($data, $id)
	{
		$query =  $this->db->table('tbl_detail_usulan')
		->where('detail_usulan_id', $id);
		return $query->update($data);
	}


	public function updateApprovalUsulan($data, $id)
	{
		$query = $this->db->table('tbl_detail_usulan')->update($data, array('detail_usulan_id' => $id));
		return $query;
	}

	public function updateRejectUsulan($data, $id)
	{
		$query = $this->db->table('tbl_detail_usulan')->update($data, array('detail_usulan_id' => $id));
		return $query;
	}


	public function getLihatUsulan($idInstansi)
	{
		$query =  $this->db->table('tbl_history_usulan')
		->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
		->where('tbl_history_usulan.instansi_id', $idInstansi)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_history_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_history_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id =  tbl_history_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_history_usulan.instansi_id', 'left')
		->groupBy('jabatan')
		->orderBy('tbl_formasi.instansi_unor asc')
		->get();
		return $query;
	}

	public function getLihatUsulanDescYear($idInstansi)
	{
		$query =  $this->db->table('tbl_history_usulan')
		->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
		->where('tbl_history_usulan.instansi_id', $idInstansi)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_history_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_history_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id = tbl_history_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_history_usulan.instansi_id', 'left')
		->groupBy('tbl_history_usulan.tahun_usulan')
		->orderBy('tbl_history_usulan.tahun_usulan DESC')
		->get();
		return $query;
	}

	public function getUsulanByYear($idInstansi, $tahun_usulan_now)
	{
		$query =  $this->db->table('tbl_history_usulan')
		->select('*')
		->where('tbl_history_usulan.instansi_id', $idInstansi)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_history_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_history_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_history_usulan.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_history_usulan.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id = tbl_history_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_history_usulan.instansi_id', 'left')
		->where('tbl_history_usulan.tahun_usulan', $tahun_usulan_now)
		->get();
		return $query;
	}


	public function getLihatUsulanNow($idInstansi, $tahun_usulan_now)
	{
		$query =  $this->db->table('tbl_history_usulan')
		->select('*')
		->where('tbl_history_usulan.instansi_id', $idInstansi)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_history_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_history_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_history_usulan.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_history_usulan.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id = tbl_history_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_history_usulan.instansi_id', 'left')
		->where('tbl_history_usulan.tahun_usulan', $tahun_usulan_now)
		->get();
		return $query;
	}

	public function getLihatUsulanByYear($tahun_usulan_now)
	{
		$query =  $this->db->table('tbl_detail_usulan')
		->select('*')
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_detail_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_detail_usulan.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_detail_usulan.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id = tbl_detail_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_formasi.instansi_id', 'left')
		->where('tbl_detail_usulan.status_usulan_id', "3")
		->get();
		return $query;
	}	


	public function getDetailUsulanByInstansi($tahun_usulan_now)
	{
		// $query =  $this->db->table('tbl_detail_usulan')
		// // ->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan,tbl_instansi.instansi_nama, count(tbl_pegawai.pegawai_nip) as jumlahasn')
		// ->select('*')
		// ->join('tbl_usulan',  'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id', 'left')
		// ->where('tbl_usulan.tahun_usulan', $tahun_usulan_now)
		// ->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_detail_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')		
		// ->join('tbl_jabatan', 'tbl_detail_usulan.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		// ->join('tbl_unor', 'tbl_detail_usulan.instansi_unor = tbl_unor.instansi_unor', 'left')
		// ->join('status_usulan', 'status_usulan.status_usulan_id = tbl_detail_usulan.status_usulan_id', 'left')
		// ->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_formasi.instansi_id', 'left')
		// ->where('tbl_detail_usulan.status_usulan_id', "3")
		// ->get();


		$query =  $this->db->table('tbl_detail_usulan')
		->select('*')
		->join('tbl_usulan',  'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id', 'left')
		->where('tbl_usulan.tahun_usulan', $tahun_usulan_now)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_detail_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id =  tbl_detail_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_formasi.instansi_id', 'left')
		->join('tbl_pegawai', 'tbl_formasi.instansi_unor = tbl_pegawai.instansi_unor and tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
		->where('tbl_detail_usulan.status_usulan_id', "3")
		->orderBy('tbl_formasi.instansi_unor asc')
		->get();
		return $query;
	}





	public function getInstansiUsulan($tahun_usulan_now){
		$query =  $this->db->table('tbl_history_usulan')
		->select('*')
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_history_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_history_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_history_usulan.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_history_usulan.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id = tbl_history_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_history_usulan.instansi_id', 'left')
		->where('tbl_history_usulan.tahun_usulan', $tahun_usulan_now)
		->groupBy('tbl_history_usulan.instansi_id')
		->get();
		return $query;
	}

	public function update_status_history_usulan($get_usulan, $datausul){
		$builder =  $this->db->table('tbl_history_usulan');
		$builder->where('history_usulan_id ', $get_usulan);
		return $builder->update($datausul);
	}
}




/* End of file PetugasModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/PetugasModel.php */