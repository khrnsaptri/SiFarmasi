<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController{
    public function __construct(){
        helper('form');
        $this->form_validation = \Config\Services::validation();
    }

    public function index(){
        return redirect()->to(base_url('admin/dashboard'));
    }
}