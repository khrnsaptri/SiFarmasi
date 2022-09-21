<?php
namespace App\Controllers\Admin;

// Load Model
use App\Models\Admin\Admin_model;
use App\Models\Users_model;
// End Load Model

use App\Controllers\BaseController;

class Users extends BaseController{
    public function __construct(){
        helper('form');
        $this->form_validation = \Config\Services::validation();
    }

    public function index(){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        $modelAdmin = new Admin_model();
        $modelUsers = new Users_model();

        $data = [
            'title'             => "Pengguna",
            "users"             => TRUE,
            "dataUser"          => $modelUsers->listing(),
            'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
        ];
        return view('admin/users/index.php', $data);
    }

    public function edit($id){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        $modelAdmin = new Admin_model();
        $modelUsers = new Users_model();
        $dataUser = $modelUsers->read($id);
        if($dataUser == null){
            session()->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to(base_url('admin/users'));
        }

        $method = $this->request->getMethod();
        if($method == "get"){
            $data = [
                'title'             => "Pengguna",
                "users"             => TRUE,
                "dataUser"          => $dataUser,
                'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
            ];
            return view('admin/users/edit.php', $data);
        } else if($method == "post"){
            $data = [
                'firstname'         => filter_var($this->request->getVar('firstname'), FILTER_SANITIZE_STRING),
                'lastname'          => filter_var($this->request->getVar('lastname'), FILTER_SANITIZE_STRING),
                'email'             => filter_var($this->request->getVar('email'), FILTER_SANITIZE_EMAIL),
                'phone'             => filter_var($this->request->getVar('phone'), FILTER_SANITIZE_STRING),
                'status'            => filter_var($this->request->getVar('status'), FILTER_SANITIZE_STRING),
            ];

            if($this->form_validation->run($data, 'editUser') == FALSE){
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                return redirect()->to(base_url('admin/users/edit/'.$id));
            } else {
                $modelUsers->update($id, $data);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to(base_url('admin/users'));
            }
        }
    }
}