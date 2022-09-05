<?php

// function getDetailFormasiManuk($jabatan_kode,$instansi_uker)
// {
//     $db      = \Config\Database::connect();
//     $query =  $db->table('tbl_formasi')
//         ->select('tbl_formasi.instansi_id,tbl_formasi.instansi_unor,tbl_formasi.jabatan_kode,formasi_jumlah,tbl_jabatan.jabatan_nama,tbl_unor.instansi_unor_nama,tbl_pegawai.pegawai_nama,tbl_pegawai.pegawai_nip, CONCAT(tbl_jabatan.jabatan_nama, tbl_unor.instansi_unor_nama) as jabatan, count(tbl_pegawai.pegawai_nama) as jumlahasn')
//         ->where('tbl_formasi.instansi_unor', $instansi_uker)
//         ->where('tbl_formasi.jabatan_kode', $jabatan_kode)
//         ->join('tbl_instansi', 'tbl_formasi.instansi_id = tbl_instansi.instansi_id', 'left')
//         ->join('tbl_jabatan', 'tbl_formasi.jabatan_kode = tbl_jabatan.jabatan_kode', 'left')
//         ->join('tbl_unor', 'tbl_unor.instansi_unor = tbl_formasi.instansi_unor', 'left')
//         ->join('tbl_pegawai', 'tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
//         //->groupBy('jabatan')
//         ->where('tbl_pegawai.instansi_unor = tbl_formasi.instansi_unor')
//         // ->orderBy('tbl_formasi.jabatan_kode asc')
//         ->get();
//     return $query;
// }

// function getDetailPegawai($idUnor,$idJabatan)
// 	{
//         $db      = \Config\Database::connect();
// 		$query =  $db->table('tbl_pegawai')

        
//         ->join('tbl_formasi', 'tbl_formasi.jabatan_kode = tbl_pegawai.jabatan_kode', 'left')
//         ->where('tbl_pegawai.instansi_unor = tbl_formasi.instansi_unor')
//         ->where('tbl_pegawai.instansi_unor', $idUnor)
//         ->where('tbl_pegawai.jabatan_kode', $idJabatan)
// 			->get();
// 		return $query;
// 	}
// Fungsi untuk mengubah format tanggal mejadi format tanggal Indonesia
function tgl_indonesia($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $nama_bulan = array(
        "Januari", "Februari", "Maret", "April", "Mei",
        "Juni", "Juli", "Agustus", "September",
        "Oktober", "November", "Desember"
    );
    $bulan = $nama_bulan[substr($tgl, 5, 2) - 1];
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

// Fungsi untuk mengubah susunan format tanggal dari form ke database 
function ubah_tgl1($tanggal)
{
    $pisah   = explode('/', $tanggal);
    $larik   = array($pisah[2], $pisah[0], $pisah[1]);
    $satukan = implode('-', $larik);
    return $satukan;
}

// Fungsi untuk mengubah susunan format tanggal dari database ke form
function ubah_tgl2($tanggal)
{
    $pisah   = explode('-', $tanggal);
    $larik   = array($pisah[1], $pisah[2], $pisah[0]);
    $satukan = implode('/', $larik);
    return $satukan;
}
