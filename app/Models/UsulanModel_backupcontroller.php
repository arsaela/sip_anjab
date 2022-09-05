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

	// public function getDetailUsulan($idInstansi)
	// {
	// 	$query =  $this->db->table('tbl_detail_usulan')
	// 		->select('*,tbl_instansi.instansi_nama, count(tbl_pegawai.pegawai_nip) as jumlahasn,,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')

	// 		->join('tbl_usulan', 'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id', 'left')
	// 		->join('tbl_formasi', 'tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')
	// 		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_detail_usulan.instansi_id', 'left')
	// 		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
	// 		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
	// 		->join('tbl_pegawai', 'tbl_formasi.instansi_unor = tbl_pegawai.instansi_unor and tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode and tbl_formasi.instansi_id = tbl_detail_usulan.instansi_id', 'left')
	// 		//->where('tbl_detail_usulan.instansi_id', '')
	// 		//->where('tbl_detail_usulan.usulan_id', $idUsulan)
	// 		//->groupBy('jabatan')
	// 		->where('tbl_detail_usulan.instansi_id', $idInstansi)
	// 		->orderBy('tbl_detail_usulan.detail_usulan_id asc')
	// 		->get();
	// 	return $query;
	// }

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
	// {
	// 	$query =  $this->db->table('tbl_formasi')
	// 		->select('tbl_formasi.instansi_id,tbl_formasi.instansi_unor,tbl_formasi.jabatan_kode,formasi_jumlah,tbl_jabatan.jabatan_nama,tbl_unor.instansi_unor_nama,tbl_pegawai.pegawai_nama,tbl_pegawai.pegawai_nip')
	// 		->where('tbl_formasi.instansi_unor', $idUnor)
	// 		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
	// 		->join('tbl_unor', 'tbl_unor.instansi_unor = tbl_formasi.instansi_unor', 'left')
	// 		->join('tbl_pegawai', 'tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
	// 		->where('tbl_pegawai.jabatan_kode', $idJabatan)
	// 		->where('tbl_pegawai.instansi_unor', $idUnor)
	// 		->get();
	// 	return $query;
	// }

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



	// public function getUsulanByID($id)
	// {
	// 	$query =  $this->db->table('tbl_usulan')
	// 		->select('*,count(tbl_pegawai.pegawai_nama) as jumlahasn')
	// 		->join('tbl_instansi', 'tbl_usulan.instansi_id = tbl_instansi.instansi_id','left')
	// 		->join('tbl_detail_usulan', 'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id','left')
	// 		->join('tbl_unor', 'tbl_detail_usulan.instansi_unor = tbl_unor.instansi_unor','left')
	// 		->join('tbl_formasi', 'tbl_detail_usulan.formasi_id = tbl_formasi.formasi_id','left')
	// 		->join('tbl_pegawai', 'tbl_pegawai.instansi_unor = tbl_detail_usulan.instansi_unor','left')
	// 		->where('tbl_usulan.usulan_id', $id)
	// 		->get();
	// 	return $query;
	// }

	// public function getDetailUsulanByID($id)
	// {
	// 	$query =  $this->db->table('tbl_detail_usulan')
	// 		->select('*,count(tbl_pegawai.pegawai_nama) as jumlahasn')
	// 		->join('tbl_usulan', 'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id','left')
	// 		->join('tbl_formasi', 'tbl_detail_usulan.formasi_id = tbl_formasi.formasi_id','left')
	// 		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode','left')
	// 		->join('tbl_pegawai', 'tbl_pegawai.jabatan_kode = tbl_formasi.jabatan_kode','left')
	// 		->where('tbl_detail_usulan.usulan_id', $id)
	// 		->orderBy('tbl_detail_usulan.status_usulan', 'ASC')
	// 		->get();
	// 	return $query;
	// }

	// public function getDetailUsulanByID_2($id)
	// {
	// 	$query =  $this->db->table('tbl_detail_usulan')
	// 		->join('tbl_usulan', 'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id')
	// 		->join('tbl_jabatan', 'tbl_detail_usulan.jabatan_kode = tbl_jabatan.jabatan_kode')
	// 		->join('tbl_instansi', 'tbl_usulan.instansi_id = tbl_instansi.instansi_id')
	// 		->join('tbl_unor', 'tbl_usulan.instansi_unor = tbl_unor.instansi_unor')
	// 		->where('tbl_detail_usulan.usulan_id', $id)
	// 		->orderBy('tbl_detail_usulan.status_usulan', 'ASC')
	// 		->get();
	// 	return $query;
	// }

	// public function getJabatanKodeByDetailUsulan($id)
	// {
	// 	$query   = $this->db->query('SELECT tbl_formasi.formasi_jumlah FROM tbl_detail_usulan 
	// 	LEFT JOIN tbl_usulan ON tbl_detail_usulan.usulan_id = tbl_usulan.usulan_id
	// 	LEFT JOIN tbl_formasi ON tbl_usulan.instansi_id = tbl_formasi.instansi_id
	// 	WHERE tbl_detail_usulan.usulan_id=' . $id . '');

	// 	return $query;
	// }

	// public function getInstansiKodeByUsulan($id)
	// {
	// 	$query   = $this->db->query('SELECT tbl_usulan.instansi_unor FROM tbl_usulan 
	// 	LEFT JOIN tbl_detail_usulan ON tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id
	// 	WHERE tbl_usulan.usulan_id=' . $id . '');

	// 	return $query;
	// }

	// public function getJumlahKebutuhanFormasi($getJabatanKodeByDetailUsulan, $getInstansiKodeByUsulan)
	// {
	// 	$query   = $this->db->query('SELECT formasi_jumlah FROM tbl_formasi 
	// 	WHERE instansi_uker=' . $getInstansiKodeByUsulan . ' AND jabatan_kode=' . $getJabatanKodeByDetailUsulan . '');

	// 	return $query;
	// }

	// public function getJabatanKodeByDetailUsulan2($id)
	// {
	// 	$query   = $this->db->query('SELECT tbl_detail_usulan.jabatan_kode, tbl_usulan.instansi_unor,tbl_usulan.instansi_id,tbl_detail_usulan.usulan_id FROM tbl_detail_usulan 
	// 	LEFT JOIN tbl_usulan ON tbl_detail_usulan.usulan_id = tbl_usulan.usulan_id
	// 	WHERE tbl_detail_usulan.usulan_id=' . $id . '');

	// 	return $query;
	// }

	// public function getCountPegawaiExisting()
	// {
	// 	$query = $this->db->table('tbl_formasi')->select('tbl_formasi.id, tbl_formasi.instansi_id,tbl_formasi.instansi_uker,tbl_formasi.jabatan_kode,formasi_jumlah,tbl_jabatan.jabatan_nama,tbl_unor.instansi_unor_nama,tbl_pegawai.pegawai_nama, count(tbl_pegawai.pegawai_nama) as jumlahasn')->join('tbl_jabatan', 'tbl_jabatan.jabatan_kode = tbl_formasi.jabatan_kode', 'left')->join('tbl_unor', 'tbl_unor.instansi_unor = tbl_formasi.instansi_uker')->join('tbl_pegawai', 'tbl_pegawai.jabatan_kode = tbl_formasi.jabatan_kode')->groupBy('tbl_pegawai.jabatan_kode,tbl_pegawai.instansi_uker')->where('tbl_pegawai.instansi_uker = tbl_formasi.instansi_uker');
	// 	return $query;
	// }

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


	// public function getPegawaiByUnorAndInstansi($idJabatan)
	// {
	// 	$query =  $this->db->table('tbl_pegawai')
	// 		->where('jabatan_kode', $idJabatan)
	// 		->get();
	// 	return $query->result();
	// }

	// public function getDetailPegawaiUsulan($idUnor, $idJabatan)
	// {
	// 	$query =  $this->db->table('tbl_formasi')
	// 		->select('tbl_formasi.instansi_id,tbl_formasi.instansi_unor,tbl_formasi.jabatan_kode,formasi_jumlah,tbl_jabatan.jabatan_nama,tbl_unor.instansi_unor_nama,tbl_pegawai.pegawai_nama,tbl_pegawai.pegawai_nip')
	// 		->where('tbl_formasi.instansi_unor', $idUnor)
	// 		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
	// 		->join('tbl_unor', 'tbl_unor.instansi_unor = tbl_formasi.instansi_unor')
	// 		->join('tbl_pegawai', 'tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode')
	// 		->join('tbl_usulan', 'tbl_usulan.instansi_unor = tbl_pegawai.instansi_unor')
	// 		->join('tbl_detail_usulan', 'tbl_detail_usulan.formasi_id = tbl_pegawai.jabatan_kode and tbl_detail_usulan.usulan_id=tb')
	// 		->where('tbl_detail_usulan.formasi_id', $idJabatan)
	// 		->where('tbl_pegawai.instansi_unor', $idUnor)
	// 		->get();
	// 	return $query;
	// }

	// private function _get_datatables_query()
	// {
	// 	$i = 0;
	// 	foreach ($this->column_search as $item) {
	// 		if ($this->request->getPost('search')['value']) {
	// 			if ($i === 0) {
	// 				$this->dt->groupStart();
	// 				$this->dt->like($item, $this->request->getPost('search')['value']);
	// 			} else {
	// 				$this->dt->orLike($item, $this->request->getPost('search')['value']);
	// 			}
	// 			if (count($this->column_search) - 1 == $i)
	// 				$this->dt->groupEnd();
	// 		}
	// 		$i++;
	// 	}

	// 	if ($this->request->getPost('order')) {
	// 		$this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
	// 	} else if (isset($this->order)) {
	// 		$order = $this->order;
	// 		$this->dt->orderBy(key($order), $order[key($order)]);
	// 	}
	// }

	// function get_datatables()
	// {
	// 	$this->_get_datatables_query();
	// 	if ($this->request->getPost('length') != -1)
	// 		$this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
	// 	$query = $this->dt->get();
	// 	return $query->getResult();
	// }

	// function count_filtered()
	// {
	// 	$this->_get_datatables_query();
	// 	return $this->dt->countAllResults();
	// }

	// public function count_all()
	// {
	// 	$tbl_storage = $this->db->table($this->table);
	// 	return $tbl_storage->countAllResults();
	// }


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
			//->where('tbl_usulan.tahun_usulan', $tahun_usulan_now)
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
}




/* End of file PetugasModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/PetugasModel.php */