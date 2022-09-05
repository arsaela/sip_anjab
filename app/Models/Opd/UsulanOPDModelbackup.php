<?php

namespace App\Models\Opd;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class UsulanOPDModel extends Model
{
	protected $table = "tbl_formasi";
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


	public function inputusulanopd($data)
	{
		$query = $this->db->table('tmp_usulan')->insert($data);
		return $query;
	}

	// public function getFormasiExisting($kebutuhanformasi) {
	// 	$query =  $this->db->table('tbl_formasi')
	// 		->select('*,tbl_pegawai.pegawai_nip,count(tbl_pegawai.pegawai_nip) as jumlahasn,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
	// 		->where('tbl_formasi.instansi_id', $idInstansi)
	// 		->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
	// 		->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
	// 		->join('tbl_pegawai', 'tbl_formasi.instansi_unor = tbl_pegawai.instansi_unor and tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
	// 		->groupBy('jabatan')
	// 		->orderBy('tbl_formasi.instansi_unor asc')
	// 		->get();
	// 	return $query;
	// }

	public function getKebutuhanFormasi($idInstansi)
	{
		$query =  $this->db->table('tbl_formasi')

			->select('*,tbl_pegawai.pegawai_nip,count(tbl_pegawai.pegawai_nip) as jumlahasn,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
			->where('tbl_formasi.instansi_id', $idInstansi)
			->join('tmp_usulan', 'tbl_formasi.instansi_unor = tmp_usulan.instansi_unor and tbl_formasi.jabatan_kode = tmp_usulan.jabatan_kode', 'left')
			->join('tbl_pegawai', 'tbl_formasi.instansi_unor = tbl_pegawai.instansi_unor and tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
			->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
			->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
			//->join('tbl_usulan', 'tbl_formasi.instansi_id = tbl_usulan.instansi_id', 'left')
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

	public function getLihatUsulan($idInstansi)
	{
		$query =  $this->db->table('tmp_usulan')
			->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
			->where('tmp_usulan.instansi_id', $idInstansi)
			->join('tbl_formasi',  'tbl_formasi.instansi_unor = tmp_usulan.instansi_unor and tbl_formasi.jabatan_kode = tmp_usulan.jabatan_kode', 'left')
			->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
			->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
			->join('status_usulan', 'status_usulan.status_usulan_id = tmp_usulan.status_usulan_id', 'left')
			->join('tbl_instansi', 'tbl_instansi.instansi_id = tmp_usulan.instansi_id', 'left')
			->groupBy('jabatan')
			->orderBy('tbl_formasi.instansi_unor asc')
			->get();
		return $query;
	}

	public function getLihatUsulanDescYear($idInstansi)
	{
		$query =  $this->db->table('tmp_usulan')
			->select('*,concat(tbl_formasi.jabatan_kode,tbl_formasi.instansi_unor) as jabatan')
			->where('tmp_usulan.instansi_id', $idInstansi)
			->join('tbl_formasi',  'tbl_formasi.instansi_unor = tmp_usulan.instansi_unor and tbl_formasi.jabatan_kode = tmp_usulan.jabatan_kode', 'left')
			->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
			->join('tbl_unor', 'tbl_formasi.instansi_unor = tbl_unor.instansi_unor', 'left')
			->join('status_usulan', 'status_usulan.status_usulan_id = tmp_usulan.status_usulan_id', 'left')
			->join('tbl_instansi', 'tbl_instansi.instansi_id = tmp_usulan.instansi_id', 'left')
			->groupBy('tmp_usulan.tahun_usulan')
			->orderBy('tmp_usulan.tahun_usulan DESC')
			->get();
		return $query;
	}

	public function getUsulanByYear($idInstansi, $tahun_usulan_now)
	{
		$query =  $this->db->table('tmp_usulan')
			->select('*')
			->where('tmp_usulan.instansi_id', $idInstansi)
			->join('tbl_formasi',  'tbl_formasi.instansi_unor = tmp_usulan.instansi_unor and tbl_formasi.jabatan_kode = tmp_usulan.jabatan_kode', 'left')
			->join('tbl_jabatan', 'tmp_usulan.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
			->join('tbl_unor', 'tmp_usulan.instansi_unor = tbl_unor.instansi_unor', 'left')
			->join('status_usulan', 'status_usulan.status_usulan_id = tmp_usulan.status_usulan_id', 'left')
			->join('tbl_instansi', 'tbl_instansi.instansi_id = tmp_usulan.instansi_id', 'left')
			->where('tmp_usulan.tahun_usulan', $tahun_usulan_now)
			->get();
		return $query;
	}

	public function aksi_kirim_usulan_move_tmp_to_usulan($data2)
	{
		$query = $this->db->table('tbl_usulan')->insertBatch($data2);
		return $query;
	}
}

/* End of file FormasiModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/FormasiModel.php */