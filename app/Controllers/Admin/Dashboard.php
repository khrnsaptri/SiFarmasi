<?php
namespace App\Controllers\Admin;

// Load Model
use App\Models\Admin\Admin_model;
use App\Models\Admin\Category_model;
use App\Models\Admin\Product_model;
use App\Models\Invoice_model;
use App\Models\Users_model;
// End Load Model

use App\Controllers\BaseController;

class Dashboard extends BaseController{
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
        $modelCategory = new Category_model();
        $modelProduct = new Product_model();
        $modelInvoice = new Invoice_model();
        $modelUser = new Users_model();

        $data = [
            'title'             => "Dashboard",
            "dashboard"         => TRUE,
            "countCategory"     => count($modelCategory->listing()),
            "countProduct"      => count($modelProduct->listing()),
            "countTransaction"  => count($modelInvoice->listing()),
            "countUser"         => count($modelUser->listing()),
            'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
        ];
        return view('admin/index.php', $data);
    }
}