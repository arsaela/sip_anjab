<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class FormasiModel extends Model
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
}

/* End of file FormasiModel.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Models/FormasiModel.php */