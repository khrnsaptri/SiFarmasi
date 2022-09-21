<?php
namespace App\Controllers;

// Load Model
use App\Models\Admin\Admin_model;
use App\Models\Users_model;
// End Load Model

use App\Controllers\BaseController;

class Auth extends BaseController{
    public function __construct(){
        helper('form');
        $this->form_validation = \Config\Services::validation();
    }

    public function register(){
        $method = $this->request->getMethod();
        if($method != "post"){
            return redirect()->to(base_url());
        }

        $data = [
            'firstname' => filter_var($this->request->getVar('firstname'), FILTER_SANITIZE_STRING),
            'lastname' => filter_var($this->request->getVar('lastname'), FILTER_SANITIZE_STRING),
            'email' => filter_var($this->request->getVar('email'), FILTER_SANITIZE_EMAIL),
            'phone' => filter_var($this->request->getVar('phone'), FILTER_SANITIZE_NUMBER_INT),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'verif_code' => random(25),
            'status' => 'active'
        ];

        $model = new Users_model();
        $check_user = $model->where('email', $data['email'])->first();
        if($check_user){
            session()->setFlashdata('error', "Email sudah terdaftar.");
            return redirect()->to($_SERVER['HTTP_REFERER']);
        }

        if($this->form_validation->run($data, 'registerUser') == FALSE){
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
            session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->form_validation->getErrors());
            return redirect()->to($_SERVER['HTTP_REFERER']);
        } else {
            $model->save($data);
            session()->setFlashdata('success', 'Pendaftaran berhasil, silahkan cek email Anda untuk konfirmasi.');
            return redirect()->to($_SERVER['HTTP_REFERER']);
            
        }
    }

    // public function email_verification($kode){
    //     $model = new Users_model();
    //     $user = $model->where('verif_code', $kode)->first();
    //     if($user){
    //         $model->update($user['id'], ['status' => 'active', 'verif_code' => '']);
    //         session()->setFlashdata('success', 'Akun anda telah aktif, silahkan login.');
    //         return redirect()->to(base_url());
    //     } else {
    //         session()->setFlashdata('error', 'Kode verifikasi tidak valid.');
    //         return redirect()->to(base_url());
    //     }
    // }

    public function login_user(){
        $method = $this->request->getMethod();
        if($method != "post"){
            return redirect()->to(base_url());
        }

        $data = [
            'email' => filter_var($this->request->getVar('email'), FILTER_SANITIZE_EMAIL),
            'password' => filter_var($this->request->getVar('password'), FILTER_SANITIZE_STRING),
        ];

        $model = new Users_model();
        $user = $model->where('email', $data['email'])->first();
        if($user){
            if(password_verify($data['password'], $user['password'])){
                if($user['status'] == 'active'){
                    session()->set('user_email', $user['email']);
                    return redirect()->to($_SERVER['HTTP_REFERER']);
                } else if($user['status'] == 'pending'){
                    session()->setFlashdata('error', 'Akun anda belum aktif, silahkan cek email Anda untuk konfirmasi.');
                    return redirect()->to($_SERVER['HTTP_REFERER']);
                } else {
                    session()->setFlashdata('error', 'Akun anda telah diblokir.');
                    return redirect()->to($_SERVER['HTTP_REFERER']);
                }
            } else {
                session()->setFlashdata('error', 'Password salah.');
                return redirect()->to($_SERVER['HTTP_REFERER']);
            }
        } else {
            session()->setFlashdata('error', 'Email tidak terdaftar.');
            return redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }

    public function logout_user(){
        // Proteksi
        if(session()->get('user_email') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url());
        }
        // End proteksi

        unset($_SESSION['user_email']);
        return redirect()->to(base_url());
    }

    public function login(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "GET"){
            return view('admin/login.php');
        } else if($method == "POST"){
            $modelAdmin = new Admin_model();
            $username = filter_var($this->request->getVar('username'), FILTER_SANITIZE_STRING);
            $password = filter_var($this->request->getVar('password'), FILTER_SANITIZE_STRING);
            $login = [
                'username'  => $username,
                'password'  => $password
            ];
            if($this->form_validation->run($login, 'login_admin') == FALSE){
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                return redirect()->to(base_url('admin/login'));
            } else {
                $check_user = $modelAdmin->check_user($username);
                if($check_user){
                    if(password_verify($password, $check_user['password'])){
                        session()->set('admin_user',$check_user['username']);
                        return redirect()->to(base_url('admin/dashboard'));
                    } else {
                        session()->setFlashdata('error', 'Password salah');
                        return redirect()->to(base_url('admin/login'));
                    }
                } else {
                    session()->setFlashdata('error', 'Username tidak ditemukan');
                    return redirect()->to(base_url('admin/login'));
                }
            }
        }        
    }

    public function logout(){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        unset($_SESSION['admin_user']);
        return redirect()->to(base_url("admin/login"));
    }
}