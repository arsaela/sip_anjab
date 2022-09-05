<?php

namespace App\Controllers;

#use App\Models\AdminModel;
use App\Models\HomeModel;
use Config\Services;

class Home extends BaseController
{
    #protected $M_informasi;
    protected $M_Home;
    protected $request;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->request = Services::request();
		$this->M_home = new HomeModel($this->request);
    }

    // Halaman utama aplikasi
    public function index()
    {
        $data['title']   = "App-PMB | Home";

        $data['timer'] = $this->M_home->select_time()->getRow();

        $data['getInformasi'] = $this->M_home->get_data_informasi()->getResult();
        $data['getAlurPengusulan'] = $this->M_home->get_data_alur_pengusulan()->getResult();

        // print_r($data['timer']);
        //die('stttoppp');




        #$data['tanggal'] = $this->M_informasi->first();
        return view('v_home/index', $data);
    }

}
