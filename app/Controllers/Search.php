<?php
namespace App\Controllers;

// Load Model
use App\Models\Users_model;
// End Load Model

class Search extends BaseController{
    public function __construct(){
        helper('form');
        $this->form_validation = \Config\Services::validation();
    }

    public function index(){
        $users_model = new Users_model();

        $q = $this->request->getGet('q');
        if($q == ""){
            return redirect()->to(base_url('/'));
        }

        $db      = \Config\Database::connect();

        $data = [
            'title'         => 'Pencarian',
            'q'             => $q,
            'product'       => $db->query("SELECT * FROM `product` WHERE `name` LIKE '%$q%'")->getResultArray(),
            'user_login'    => $users_model->check_email(session()->get('user_email'))
        ];
        return view('search', $data);
    }
}