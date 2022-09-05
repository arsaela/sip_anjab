<?php

namespace App\Controllers\Opd;
use App\Controllers\BaseController;

use App\Models\Opd\DashboardPetugasModel;
use App\Models\HomeModel;
use Config\Services;

class Dashboard extends BaseController
{
    protected $session;
    protected $M_dashboard_opd;
    protected $request;
    protected $form_validation;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = Services::request();
        $this->M_dashboard_opd = new DashboardPetugasModel($this->request);
        $this->M_home = new HomeModel($this->request);
        $this->form_validation =  \Config\Services::validation();
    }

    // Halaman Dashboard Petugas
    public function index()
    {
        $username = $this->session->get('username');
        $data['title']  = "App-SIP | Dashboard";
        $data['page']   = "dashboard";
        $data['username']   = $this->session->get('username');
        $data['get_petugas_by_login']  = $this->M_dashboard_opd->getPetugasNamaOpd($username)->getRow();    

        $data['getInformasi'] = $this->M_home->get_data_informasi()->getResult();

        // print_r($data);
        // print_r($data['get_petugas_by_login']);
        // die('stttopp');

        return view('v_dashboard_petugas/index', $data);
    }

    // Logout
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}

/* End of file Dashboard.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Controllers/Dashboard.php */
