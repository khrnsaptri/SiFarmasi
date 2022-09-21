<?php
namespace App\Controllers;

// Load Model
use App\Models\Admin\Category_model;
use App\Models\Admin\Product_model;
use App\Models\Users_model;
// End Load Model

class Home extends BaseController{
    public function index(){
        $category_model = new Category_model();
        $product_model = new Product_model();
        $users_model = new Users_model();

        $data = [
            'title'         => 'Home',
            'category'      => $category_model->listing(),
            'product'       => $product_model->listing(),
            'user_login'    => $users_model->check_email(session()->get('user_email'))
        ];
        return view('index', $data);
    }
}
