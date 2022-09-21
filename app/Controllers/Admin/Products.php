<?php
namespace App\Controllers\Admin;

// Load Model
use App\Models\Admin\Admin_model;
use App\Models\Admin\Category_model;
use App\Models\Admin\Product_model;
// End Load Model

use App\Controllers\BaseController;

class Products extends BaseController{
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

        $modelAdmin     = new Admin_model();
        $modelProduk    = new Product_model();

        $data = [
            'title'             => "Daftar Produk",
            "products"          => TRUE,
            "product"           => TRUE,
            "product_listing"   => $modelProduk->listing(),
            'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
        ];
        return view('admin/products/index.php', $data);
    }

    public function add(){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        $modelAdmin = new Admin_model();
        $modelCategoryegory = new Category_model();
        $modelProduk   = new Product_model();

        $method = $this->request->getMethod();
        if($method == "get"){
            unset($_SESSION['dataGambar']);
            $data = [
                'title'             => "Tambah Produk",
                "products"          => TRUE,
                "product"           => TRUE,
                "categories"        => $modelCategoryegory->listing(),
                'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
            ];
            return view('admin/products/add.php', $data);
        } else {
            $data = [
                'name'                       => filter_var($this->request->getPost('name'), FILTER_SANITIZE_STRING),
                'price'                      => filter_var($this->request->getPost('price'), FILTER_SANITIZE_NUMBER_INT),
                'weight'                     => filter_var($this->request->getPost('weight'), FILTER_SANITIZE_NUMBER_INT),
                'category_id'                => filter_var($this->request->getPost('category_id'), FILTER_SANITIZE_NUMBER_INT),
                'stock'                      => filter_var($this->request->getPost('stock'), FILTER_SANITIZE_NUMBER_INT),
                'image'                      => serialize(session()->get('dataGambar')),
                'description'                => $this->request->getPost('description'),
                'additional_information'     => $this->request->getPost('additional_information'),
            ];
            if($this->form_validation->run($data, 'product') == FALSE){
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                return redirect()->to(base_url('admin/products/add'));
            } else {
                $modelProduk->tambah($data);
                session()->setFlashdata('success', 'Data berhasil ditambahkan');
                unset($_SESSION['dataGambar']);
                return redirect()->to(base_url('admin/products'));
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
        $modelCategory = new Category_model();
        $modelProduk = new Product_model();
        $dataProduk = $modelProduk->read($id);

        if($dataProduk == FALSE){
            session()->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to(base_url('admin/products'));
        }

        $method = $this->request->getMethod();
        if($method == "get"){
            unset($_SESSION['dataGambar']);
            $data = [
                'title'             => "Edit Produk",
                "products"          => TRUE,
                "product"           => TRUE,
                'data'              => $dataProduk,
                "categories"        => $modelCategory->listing(),
                'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
            ];
            return view('admin/products/edit.php', $data);
        } else {           
            $data = [
                'id'                         => $id,
                'name'                       => filter_var($this->request->getPost('name'), FILTER_SANITIZE_STRING),
                'price'                      => filter_var($this->request->getPost('price'), FILTER_SANITIZE_NUMBER_INT),
                'weight'                     => filter_var($this->request->getPost('weight'), FILTER_SANITIZE_NUMBER_INT),
                'category_id'                => filter_var($this->request->getPost('category_id'), FILTER_SANITIZE_NUMBER_INT),
                'stock'                      => filter_var($this->request->getPost('stock'), FILTER_SANITIZE_NUMBER_INT),
                'image'                      => unserialize($dataProduk['image']),
                'description'                => $this->request->getPost('description'),
                'additional_information'     => $this->request->getPost('additional_information'),
            ];
            if(isset($_SESSION['dataGambar'])){
                $foto = $_SESSION['dataGambar'];
                foreach($foto as $value){
                    $data['image'][] = $value;
                }
            }
            $data['image'] = serialize($data['image']);
            if($this->form_validation->run($data, 'product') == FALSE){
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $this->request->getPost());
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $this->form_validation->getErrors());
                return redirect()->to(base_url('admin/products/edit/'.$id));
            } else {
                $modelProduk->edit($data);
                session()->setFlashdata('success', 'Data berhasil diubah');
                unset($_SESSION['dataGambar']);
                return redirect()->to(base_url('admin/products'));
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

        $modelProduk = new Product_model();
        $dataProduk = $modelProduk->read($id);
        
        if($dataProduk == FALSE){
            session()->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to(base_url('admin/products'));
        }

        $produk = $modelProduk->read($id);
        $photos = unserialize($produk['image']);
        $no = 0;
        foreach($photos as $value){
            // unset($photos[$no]);
            \array_splice($photos, $no, 1);
            if(file_exists(FCPATH.'assets/uploads/images/'.$value)){
                unlink(FCPATH.'assets/uploads/images/'.$value);
            }
            $no++;
        }

        $modelProduk->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/products'));
    }

    public function upload_image(){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "POST"){
            // Image upload
			$avatar  	= $this->request->getFile('file');
			$namabaru 	= $avatar->getRandomName();
			$avatar->move(FCPATH . 'assets/uploads/images/',$namabaru);

            // Baca & Simpan Session Data Gambar
            $namaGambar = session()->get('dataGambar');
            $namaGambar[] = $namabaru;
            session()->set('dataGambar',$namaGambar);
        }
    }

    public function getPhoto($id){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        $modelProduk   = new Product_model();
        $product = $modelProduk->read($id);
        $photo = unserialize($product['image']);
        $images = "";
        foreach($photo as $p){
            $images .= '<div class="filtr-item col-sm-2">
                <a href="#" data-toggle="lightbox" data-link="'.base_url("assets/uploads/images/".$p).'" data-filename="'.$p.'">
                    <img src="'. base_url("assets/uploads/images/".$p) .'" class="img-fluid mb-2" alt="white sample" />
                </a>
            </div>';
        }

        return $images;
    }

    public function deletePhoto(){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi

        $modelProduk   = new Product_model();

        $photo = service('request')->getPost('name');
        $id = service('request')->getPost('id');
        $produk = $modelProduk->read($id);
        $photos = unserialize($produk['image']);
        
        $no = 0;
        foreach($photos as $value){
            if($value == $photo){
                // unset($photos[$no]);
                \array_splice($photos, $no, 1);
                if(file_exists(FCPATH.'assets/uploads/images/'.$photo)){
                    unlink(FCPATH.'assets/uploads/images/'.$photo);
                }
            }
            $no++;
        }
        
        $photos = serialize($photos);
        $data = [
            'image'		    => $photos
        ];
        $modelProduk->update($id, $data);

        echo json_encode(array("status" => true));
    }
}