<?php

namespace App\Models\Opd;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class UsulanOPDModel extends Model
{
	protected $table = "tbl_formasi, tbl_usulan";
	protected $allowedFields = ['instansi_id', 'instansi_uker', 'jabatan_kode', 'formasi_jumlah'];
	protected $column_order = [null, 'instansi_id', 'instansi_uker', 'jabatan_kode', 'formasi_jumlah', null];
	protected $column_search = ['instansi_id', 'instansi_uker', 'jabatan_kode', 'formasi_jumlah'];
	protected $order = ['formasi_id' => 'asc'];
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


	public function getInstansiByLogin($username)
	{
		$query =  $this->db->table('tbl_login')
		->select('tbl_petugas.instansi_id')
		->join('tbl_petugas', 'tbl_petugas.username = tbl_login.username')
		->where('tbl_login.username', $username)
		->get();
		return $query;
	}


	public function input_history_usulan_opd($data)
	{
		$query = $this->db->table('tbl_history_usulan')->insert($data);
		return $query;
	}

	public function inputusulanopd($data)
	{
		$query = $this->db->table('tbl_usulan')->insert($data);
		return $query;
	}

	public function inputdetailusulanopd($data)
	{
		$query = $this->db->table('tbl_detail_usulan')->insert($data);
		return $query;
	}

	public function getKebutuhanFormasi($idInstansi)
	{
		$query =  $this->db->table('tbl_formasi')
		->select('*,tbl_pegawai.pegawai_nip,count(tbl_pegawai.pegawai_nip) as jumlahasn,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
		->where('tbl_formasi.instansi_id', $idInstansi)
		->join('tbl_history_usulan', 'tbl_formasi.instansi_unor = tbl_history_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_history_usulan.jabatan_kode', 'left')
		->join('tbl_pegawai', 'tbl_formasi.instansi_unor = tbl_pegawai.instansi_unor and tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->groupBy('jabatan')
		->orderBy('tbl_jabatan.jabatan_nama asc')
		->get();
		return $query;
	}

	public function getCheckStatusUsulan($idInstansi)
	{
		$query =  $this->db->table('tbl_formasi')
		->select('tbl_history_usulan.status_usulan_id,tbl_pegawai.pegawai_nip,count(tbl_pegawai.pegawai_nip) as jumlahasn,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
		->where('tbl_formasi.instansi_id', $idInstansi)
		->join('tbl_history_usulan', 'tbl_formasi.instansi_unor = tbl_history_usulan.instansi_unor', 'left')
		->join('tbl_pegawai', 'tbl_formasi.instansi_unor = tbl_pegawai.instansi_unor and tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->groupBy('jabatan')
		->orderBy('tbl_jabatan.jabatan_nama asc')
		->get();
		return $query;
	}

	public function getDetailFormasi($idInstansi)
	{
		$query =  $this->db->table('tbl_formasi')
		->select('*,tbl_pegawai.pegawai_nip,count(tbl_pegawai.pegawai_nip) as jumlahasn,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
		->where('tbl_formasi.instansi_id', $idInstansi)
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('tbl_pegawai', 'tbl_formasi.instansi_unor = tbl_pegawai.instansi_unor and tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
		->groupBy('jabatan')
		->orderBy('tbl_formasi.instansi_unor asc')
		->get();
		return $query;
	}


	public function getDetailPegawai($idUnor, $idJabatan)
	{
		$query =  $this->db->table('tbl_formasi')
		->select('tbl_formasi.instansi_id,tbl_formasi.instansi_unor,tbl_formasi.jabatan_kode,formasi_jumlah,tbl_jabatan.jabatan_nama,tbl_unor.instansi_unor_nama,tbl_pegawai.pegawai_nama,tbl_pegawai.pegawai_nip')
		->where('tbl_formasi.instansi_unor', $idUnor)
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_unor.instansi_unor = tbl_formasi.instansi_unor', 'left')
		->join('tbl_pegawai', 'tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
		->where('tbl_pegawai.jabatan_kode', $idJabatan)
		->where('tbl_pegawai.instansi_unor', $idUnor)
		->get();
		return $query;
	}

	public function getLihatUsulan($idInstansi, $tahun_usulan_now)
	{
		$query =  $this->db->table('tbl_detail_usulan')
		->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
		->join('tbl_usulan',  'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id', 'left')
		->where('tbl_usulan.instansi_id', $idInstansi)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_detail_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id = tbl_detail_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_usulan.instansi_id', 'left')
		->where('tbl_usulan.tahun_usulan', $tahun_usulan_now)
		->orderBy('tbl_usulan.tahun_usulan DESC')
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

	public function getLihatDetailUsulan($idInstansi, $tahun_usulan)
	{
		$query =  $this->db->table('tbl_detail_usulan')
		->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
		->join('tbl_usulan',  'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id', 'left')
		->where('tbl_usulan.instansi_id', $idInstansi)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_detail_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id = tbl_detail_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_usulan.instansi_id', 'left')
		->where('tbl_usulan.tahun_usulan', $tahun_usulan)
		->orderBy('tbl_usulan.tahun_usulan DESC')
		->get();
		return $query;
	}

	public function getLihatRekapUsulan($idInstansi)
	{
		$query =  $this->db->table('tbl_detail_usulan')
		->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
		->join('tbl_usulan',  'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id', 'left')
		->where('tbl_usulan.instansi_id', $idInstansi)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_detail_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id = tbl_detail_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_usulan.instansi_id', 'left')
		->orderBy('tbl_usulan.tahun_usulan DESC')
		->get();
		return $query;
	}



	public function getLihatUsulan2($idInstansi)
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

	


	public function aksi_kirim_usulan_opd($data_usulan)
	{
		$query = $this->db->table('tbl_usulan')->insert($data_usulan);
		return $query;
	}

	public function aksi_kirim_detail_usulan_opd($data_detail_usulan)
	{
		$query = $this->db->table('tbl_detail_usulan')->insertBatch($data_detail_usulan);
		return $query;
	}

	public function update_status_history_usulan($get_usulan, $datausul)
	{
		$builder =  $this->db->table('tbl_history_usulan');
		$builder->where('history_usulan_id ', $get_usulan);
		return $builder->update($datausul);
	}

	// public function cekSudahKirim($idInstansi){
	// 	// $this->db->select('SUM(nilai) as total');
	// 	// $this->db->from('mahasiswa');
	// 	// return $this->db->get()->row()->total;
	// 	// $ceksudahkirim = $this->db;

	// 	$query =  $this->db->table('tbl_history_usulan')
	// 	->select('*')
	// 	->where('tbl_history_usulan.instansi_id', $idInstansi)
	// 	->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_history_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_history_usulan.jabatan_kode', 'left')
	// 	->join('tbl_jabatan', 'tbl_history_usulan.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
	// 	->join('tbl_unor', 'tbl_history_usulan.instansi_unor = tbl_unor.instansi_unor', 'left')
	// 	->join('status_usulan', 'status_usulan.status_usulan_id = tbl_history_usulan.status_usulan_id', 'left')
	// 	->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_history_usulan.instansi_id', 'left')
	// 	->where('tbl_history_usulan.status_usulan_id', '2')
	// 	->get();
	// 	// return $query;
	// 	return $query->countAll();
	// }

	// public function cekSudahKirim2(){
	// 	return $this->db->table('tbl_history_usulan')->countAll();
	// }

	//SELECT*FROM tbl_history_usulan WHERE tbl_history_usulan.status_usulan_id='1'

	public function cekStatusKirimUsulan($idInstansi,$tahun_usulan_now){
		return 
		$this->db->table('tbl_history_usulan')
		// ->where('tbl_history_usulan.instansi_id', $idInstansi)
		->where('tbl_history_usulan.status_usulan_id', '2')
		// ->where('tbl_history_usulan.tahun_usulan', $tahun_usulan_now)
		->countAllResults();
	}


	// public function cekStatusKirimUsulan($idInstansi,$tahun_usulan_now){
	
	// 	$query = $this->db->table('tbl_history_usulan')
	// 	->where('tbl_history_usulan.instansi_id', $idInstansi)
	// 	->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_history_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_history_usulan.jabatan_kode', 'left')
	// 	->join('tbl_jabatan', 'tbl_history_usulan.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
	// 	->join('tbl_unor', 'tbl_history_usulan.instansi_unor = tbl_unor.instansi_unor', 'left')
	// 	->join('status_usulan', 'status_usulan.status_usulan_id = tbl_history_usulan.status_usulan_id', 'left')
	// 	->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_history_usulan.instansi_id', 'left')
	// 	->get();
	// 	return $query;
	// 	// ->countAll();
	// }



	public function getStatusUsulan($idInstansi, $tahun_usulan_now)
	{
		$query =  $this->db->table('tbl_detail_usulan')
		->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
		->join('tbl_usulan',  'tbl_usulan.usulan_id = tbl_detail_usulan.usulan_id', 'left')
		->where('tbl_usulan.instansi_id', $idInstansi)
		->join('tbl_formasi',  'tbl_formasi.instansi_unor = tbl_detail_usulan.instansi_unor and tbl_formasi.jabatan_kode = tbl_detail_usulan.jabatan_kode', 'left')
		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
		->join('status_usulan', 'status_usulan.status_usulan_id = tbl_detail_usulan.status_usulan_id', 'left')
		->join('tbl_instansi', 'tbl_instansi.instansi_id = tbl_usulan.instansi_id', 'left')
		->where('tbl_usulan.tahun_usulan', $tahun_usulan_now)
		->orderBy('tbl_usulan.tahun_usulan DESC')
		->get();
		return $query;
	}

}

/* End of file FormasiModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/FormasiModel.php */