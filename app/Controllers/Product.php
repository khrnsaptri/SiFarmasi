<?php
namespace App\Controllers;

// Load Model
use App\Models\Admin\Category_model;
use App\Models\Admin\Product_model;
use App\Models\Users_model;
// End Load Model

class Product extends BaseController{
    public function __construct(){
        helper('form');
        $this->form_validation = \Config\Services::validation();
    }

    public function detail($id){
        $modelProduk = new Product_model();
        $dataProduk = $modelProduk->read($id);
        $users_model = new Users_model();

        if($dataProduk == FALSE){
            // session()->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to(base_url());
        }
        $data = [
            'title'             => "Detail Produk",
            'product_detail'    => $dataProduk,
            'user_login'        => $users_model->check_email(session()->get('user_email'))
        ];
        return view('product-detail.php', $data);
    }
}