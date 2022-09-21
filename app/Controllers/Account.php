<?php
namespace App\Controllers;

// Load Model
use App\Models\Address_model;
use App\Models\Invoice_model;
use App\Models\Transaction_model;
use App\Models\Users_model;
// End Load Model

class Account extends BaseController{
    public function __construct(){
        helper('form');
        $this->form_validation = \Config\Services::validation();
    }
    
    public function index(){
        // Proteksi
        if(session()->get('user_email') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url());
        }
        // End proteksi

        $method = $this->request->getMethod();
        $users_model = new Users_model();
        $data_user = $users_model->check_email(session()->get('user_email'));
        if($method == "get"){
            $data = [
                'title'         => 'Akun Saya',
                'user_login'    => $data_user
            ];
            return view('account/index', $data);
        } else {
            $data = [
                'firstname'     => filter_var($this->request->getPost('firstname'), FILTER_SANITIZE_STRING),
                'lastname'      => filter_var($this->request->getPost('lastname'), FILTER_SANITIZE_STRING),
                'phone'         => filter_var($this->request->getPost('phone'), FILTER_SANITIZE_NUMBER_INT),
            ];
            if($this->form_validation->run($data, 'updateAccount') == FALSE){
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                return redirect()->to(base_url('account'));
            } else {
                $users_model->update($data_user['id'], $data);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to(base_url('account'));
            }            
        }
    }

    public function password(){
        // Proteksi
        if(session()->get('user_email') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url());
        }
        // End proteksi

        $method = $this->request->getMethod();
        $users_model = new Users_model();
        $data_user = $users_model->check_email(session()->get('user_email'));
        if($method == "get"){
            $data = [
                'title'         => 'Ganti Password',
                'user_login'    => $data_user
            ];
            return view('account/password', $data);
        } else {
            $data = [
                'old_password'      => filter_var($this->request->getPost('old_password'), FILTER_SANITIZE_STRING),
                'new_password'      => filter_var($this->request->getPost('new_password'), FILTER_SANITIZE_STRING),
                'confirm_password'  => filter_var($this->request->getPost('confirm_password'), FILTER_SANITIZE_STRING),
            ];
            if($this->form_validation->run($data, 'updatePassword') == FALSE){
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                return redirect()->to(base_url('account/password'));
            } else {
                if(password_verify($data['old_password'], $data_user['password'])){
                    if($data['new_password'] == $data['confirm_password']){
                        $data_update = [
                            'password' => password_hash($data['new_password'], PASSWORD_DEFAULT)
                        ];
                        $users_model->update($data_user['id'], $data_update);
                        session()->setFlashdata('success', 'Password berhasil diubah');
                        return redirect()->to(base_url('account/password'));
                    } else {
                        session()->setFlashdata('error', 'Password baru dan konfirmasi password tidak sama');
                        return redirect()->to(base_url('account/password'));
                    }
                } else {
                    session()->setFlashdata('error', 'Password lama salah');
                    return redirect()->to(base_url('account/password'));
                }
            }
        }
    }

    public function address(){
        // Proteksi
        if(session()->get('user_email') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url());
        }
        // End proteksi

        $method = $this->request->getMethod();
        $users_model = new Users_model();
        $address_model = new Address_model();
        $data_user = $users_model->check_email(session()->get('user_email'));
        if($method == "get"){
            $data = [
                'title'         => 'Alamat Pengiriman',
                'address'       => $address_model->listing($data_user['id']),
                'user_login'    => $data_user
            ];
            return view('account/address', $data);
        } else {
            $data = [
                'user_id'       => $data_user['id'],
                'id'            => filter_var($this->request->getPost('id'), FILTER_SANITIZE_STRING),
                'receiver_name' => filter_var($this->request->getPost('receiver_name'), FILTER_SANITIZE_STRING),
                'phone'         => filter_var($this->request->getPost('phone'), FILTER_SANITIZE_NUMBER_INT),
                'address'       => filter_var($this->request->getPost('address'), FILTER_SANITIZE_STRING),
                'apt'           => filter_var($this->request->getPost('apt'), FILTER_SANITIZE_STRING),
                'city'          => filter_var($this->request->getPost('city'), FILTER_SANITIZE_STRING),
                'state'         => filter_var($this->request->getPost('state'), FILTER_SANITIZE_STRING),
                'zipcode'       => filter_var($this->request->getPost('zip_code'), FILTER_SANITIZE_NUMBER_INT),
                'country'       => filter_var($this->request->getPost('country'), FILTER_SANITIZE_STRING),
            ];
            if($this->form_validation->run($data, 'address') == FALSE){
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                return redirect()->to(base_url('account/address'));
            } else {
                if($data['id'] == "0"){
                    $address_model->insert($data);
                    session()->setFlashdata('success', 'Alamat berhasil disimpan');
                } else {
                    $address_model->update($data['id'], $data);
                    session()->setFlashdata('success', 'Alamat berhasil diubah');
                }                
                return redirect()->to(base_url('account/address'));
            }
        }
    }

    public function delete_address(){
        // Proteksi
        if(session()->get('user_email') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url());
        }
        // End proteksi

        $method = $this->request->getMethod();
        $address_model = new Address_model();
        if($method == "post"){
            $id = filter_var($this->request->getPost('id'), FILTER_SANITIZE_STRING);
            $address_model->delete($id);
            session()->setFlashdata('success', 'Alamat berhasil dihapus');
            return redirect()->to(base_url('account/address'));
        } else {
            return redirect()->to(base_url('account/address'));
        }
    }

    public function orders($noInv = null){
        // Proteksi
        if(session()->get('user_email') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url());
        }
        // End proteksi

        $invoice_model = new Invoice_model();
        $transaction_model = new Transaction_model();
        $users_model = new Users_model();
        $data_user = $users_model->check_email(session()->get('user_email'));
        if($noInv == null){
            $data = [
                'title'         => 'Riwayat Pembelian',
                'invoice'       => $invoice_model->listing($data_user['id']),
                'user_login'    => $data_user
            ];
            return view('account/orders', $data);
        } else {
            $data = [
                'title'         => 'Riwayat Pembelian',
                'transaction'   => $transaction_model->getInv($noInv),
                'address'       => $invoice_model->getAddress($noInv),
                'invoice'       => $invoice_model->read($noInv),
                'user_login'    => $data_user
            ];
            return view('account/orders-detail', $data);
            // dd($invoice_model->getAddress($noInv));
        }
    }
}
