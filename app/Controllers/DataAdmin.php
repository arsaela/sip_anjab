<?php

namespace App\Controllers;

use App\Models\AdminModel;
// use App\Models\UserModel;
use Config\Services;

class DataAdmin extends BaseController
{
    protected $encrypter;
    protected $M_admin;
    // protected $M_user;
    protected $request;
    protected $form_validation;
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->request = Services::request();
        $this->db = db_connect();
        $this->encrypter = \Config\Services::encrypter();
        $this->M_admin = new AdminModel($this->request);
// $this->M_user = new UserModel($this->request);
        $this->form_validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        helper('form');
    }

// Halaman Data Admin
    public function index()
    {
        $db=\Config\Database::connect();
        $data['title']  = "App-SIP | Data Admin";
        $data['page']   = "dataadmin1";
        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');
        $data['admin']   = $db->query('SELECT *
            FROM tbl_admin, tbl_login
            WHERE tbl_admin.username = tbl_login.username;');
        $data['min'] = $data['admin']->getResultArray();

        return view('v_dataadmin/index', $data);
    }

// Add Data Admin
    public function add()
    {
        $username = $this->request->getPost('username');
        $admin_nama = $this->request->getPost('admin_nama');
        $admin_no_hp = $this->request->getPost('admin_no_hp');
        $admin_email = $this->request->getPost('admin_email');
        $password = $this->request->getPost('password');

        $data = [
            'username' => $username,
            'admin_nama' => $admin_nama,
            'admin_no_hp' => $admin_no_hp,
            'admin_email' => $admin_email,
        ];

        $data2 = [
            'username' => $username,
            'password'    =>  base64_encode($this->encrypter->encrypt($password)),
            'hak_akses'   => 'admin'
        ];

        $save_input_admin_success = $this->M_admin->save_admin_in_admin($data);
        $save_input_login_success = $this->M_admin->save_admin_in_login($data2);

        if($save_input_login_success AND $save_input_admin_success){
            session()->setFlashdata('message', 'Data berhasil di simpan');
            return redirect()->to('/dataadmin');
        } else {
            session()->setFlashdata('err',\Config\Services::validation()->listErrors()); 
            return redirect()->to('dataadmin/'); 
        }

        $validasi = [
            'success'   => true
        ];
        echo json_encode($validasi);
        return redirect()->to('dataadmin');
    }

    public function save_update_admin()
    {
        $db=\Config\Database::connect();
        $id = $this->request->getPost('id');
        $data = array(
            'admin_nama' => $this->request->getPost('admin_nama'),
            'admin_no_hp' => $this->request->getPost('admin_no_hp'),
            'admin_email' => $this->request->getPost('admin_email'),
        );


        $updatedatasuccess = $this->M_admin->update_admin($data,$id);

        if($updatedatasuccess){
            session()->setFlashdata('message', 'Data berhasil di update');
            return redirect()->to('/dataadmin');
        } else {
            session()->setFlashdata('err',\Config\Services::validation()->listErrors()); 
            return redirect()->to('dataadmin/'); 
        }

        $validasi = [
            'success'   => true
        ];
        echo json_encode($validasi);
        return redirect()->to('dataadmin');

    }


// Delete Data Admin
    public function delete_admin($username)
    {
        $success = $this->db->query("DELETE tbl_admin , tbl_login  FROM tbl_admin  INNER JOIN tbl_login  
            WHERE tbl_admin.username = tbl_login.username and tbl_admin.username = '$username'");


        if($success) {
            session()->setFlashdata('message', 'Data berhasil dihapus');
            return redirect()->to('dataadmin');
        }
    }




























    public function update()
    {
        $id = $this->request->getPost('idAdmin');
        $username = $this->request->getPost('username2');
        $admin_nama = $this->request->getPost('admin_nama2');
        $admin_no_hp = $this->request->getPost('admin_no_hp2');
        $admin_email = $this->request->getPost('admin_email2');
        $admin_password = $this->request->getPost('admin_password2');

//Data Admin
        $data = [
            'username' => $username,
            'admin_nama' => $admin_nama,
            'admin_no_hp' => $admin_no_hp,
            'admin_email' => $admin_email,
        ];

        $data2 = [
            'username' => $username,
            'password'    =>  base64_encode($this->encrypter->encrypt($admin_password)),
            'hak_akses'   => 'admin'
        ];

//Update Data petugas
        $this->M_admin->update_admin_in_admin($data);
        $this->M_admin->update_admin_in_login($data2);

        $validasi = [
            'success'   => true
        ];
        echo json_encode($validasi);
    }


// Datatable server side
    public function ajaxDataAdmin()
    {

        if ($this->request->getMethod(true) == 'POST') {
//$lists = $this->M_admin->get_datatables();
            $lists = $this->M_admin->get_admin()->getResult();
            $data = [];
            $no = $this->request->getPost("start");
//$decrypted_string = $this->encrypt->decode($encrypted_password, $key);
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->username;
                $row[] = $this->encrypter->decrypt(base64_decode($list->password));
                $row[] = $list->admin_nama;
                $row[] = $list->admin_no_hp;
                $row[] = $list->admin_email;
                $row[] = $this->_action($list->id);
                $data[] = $row;
            }
            $output = [
                "draw"                 => $this->request->getPost('draw'),
                "recordsTotal"         => $this->M_admin->count_all(),
                "recordsFiltered"     => $this->M_admin->count_filtered(),
                "data"                 => $data
            ];
            echo json_encode($output);
        }
    }
}

/* End of file DataAdmin.php */
/* Location: .//C/xampp/htdocs/app-sip/app/Controllers/DataAdmin.php */
