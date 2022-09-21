<?php
namespace App\Controllers\Admin;

// Load Model
use App\Models\Admin\Admin_model;
use App\Models\Admin\Category_model;
// End Load Model

use App\Controllers\BaseController;

class Category extends BaseController{
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
        $modelCat   = new Category_model();

        $data = [
            'title'             => "Daftar Kategori",
            "products"          => TRUE,
            "category"          => TRUE,
            "category_listing"  => $modelCat->listing(),
            'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
        ];
        return view('admin/category/index.php', $data);
    }

    public function add(){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        $modelAdmin = new Admin_model();
        $modelCat   = new Category_model();

        $method = $this->request->getMethod();
        if($method == "get"){
            $data = [
                'title'             => "Tambah Kategori",
                "products"          => TRUE,
                "category"          => TRUE,
                'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
            ];
            return view('admin/category/add.php', $data);
        } else {
            $data = [
                'name'              => filter_var($this->request->getPost('name'), FILTER_SANITIZE_STRING),
                'slug'              => createSlug(filter_var($this->request->getPost('name'), FILTER_SANITIZE_STRING), 'category'),
                'image'             => $this->request->getFile('image')
            ];
            if($this->form_validation->run($data, 'category') == FALSE){
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                return redirect()->to(base_url('admin/category/add'));
            } else {
                // Image upload
                $avatar  	= $this->request->getFile('image');
                $namabaru 	= $avatar->getRandomName();
                $avatar->move(FCPATH.'assets/uploads/category/',$namabaru);
                $data['image'] = $namabaru;
                // End Image upload

                $modelCat->tambah($data);
                session()->setFlashdata('success', 'Data berhasil ditambahkan');
                return redirect()->to(base_url('admin/category'));
            }
        }
    }

    public function edit($id){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        $modelAdmin = new Admin_model();
        $modelCat   = new Category_model();
        $dataCat  = $modelCat->read($id);

        if($dataCat == FALSE){
            session()->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to(base_url('admin/category'));
        }

        $method = $this->request->getMethod();
        if($method == "get"){
            $data = [
                'title'             => "Edit Kategori",
                "products"          => TRUE,
                "category"          => TRUE,
                'data'              => $dataCat,
                'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
            ];
            return view('admin/category/edit.php', $data);
        } else {            
            if($this->request->getFile('image') == ""){
                $data = [
                    'name'              => filter_var($this->request->getPost('name'), FILTER_SANITIZE_STRING),
                    'slug'              => url_title(filter_var($this->request->getPost('name'), FILTER_SANITIZE_STRING), '-', TRUE)
                ];

                $valid = "category_edit";
            } else {
                $data = [
                    'name'              => filter_var($this->request->getPost('name'), FILTER_SANITIZE_STRING),
                    'slug'              => url_title(filter_var($this->request->getPost('name'), FILTER_SANITIZE_STRING), '-', TRUE),
                    'image'             => $this->request->getFile('image')
                ];

                $valid = "category";
            }
            if($this->form_validation->run($data, $valid) == FALSE){
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                return redirect()->to(base_url('admin/category/edit/'.$id));
            } else {
                $dataCat = $modelCat->read($id);
                if($this->request->getFile('image') != ""){
                    if(file_exists(FCPATH.'assets/uploads/category/'.$dataCat['image'])){
                        unlink(FCPATH.'assets/uploads/category/'.$dataCat['image']);
                    }
                    // Image upload
                    $avatar  	= $this->request->getFile('image');
                    $namabaru 	= $avatar->getRandomName();
                    $avatar->move(FCPATH.'assets/uploads/category/',$namabaru);
                    $data['image'] = $namabaru;
                    // End Image upload
                }

                $data['id'] = $id;
                $modelCat->edit($data);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to(base_url('admin/category'));
            }
        }
    }

    public function delete($id){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        $modelCat = new Category_model();
        $dataCat  = $modelCat->read($id);
        
        if($dataCat == FALSE){
            session()->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to(base_url('admin/category'));
        }

        if(file_exists(FCPATH.'assets/uploads/category/'.$dataCat['image'])){
            unlink(FCPATH.'assets/uploads/category/'.$dataCat['image']);
        }
        $modelCat->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/category'));
    }
}