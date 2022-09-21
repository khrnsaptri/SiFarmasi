<?php

// Load Model
use App\Models\Admin\Category_model;
use App\Models\Admin\Product_model;
// End Load Model

function createSlug($slug, $type){
    $slug = url_title($slug, '-', TRUE);
    $modelCategory = new Category_model();
    $modelProduct  = new Product_model();
    if($type == 'category'){
        $check = $modelCategory->check_slug($slug);
    } else if($type == 'product'){
        $check = $modelProduct->check_slug($slug);
    }

    if($check){
        $total = count($check);
        $slug = $slug.'-'.$total;
    }
    return $slug;
}

// Fungsi Generate Teks
function random($length = 10){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Fungsi cek daftar kota rajaongkir
function getCity($id_city = null, $id_prov = null){
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=$id_city&province=$id_prov",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 645e2a795033b43bb13404ea9deb993a"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

function generateInv(){
    // mengambil data barang dengan kode paling besar
    $today = date("Ymd");
    $db    = \Config\Database::connect();
    $data = $db->query("SELECT max(invoice_number) AS noINV FROM invoice WHERE invoice_number LIKE '$today%'")->getRowArray();
    // $query = mysqli_query($koneksi, "SELECT max(kode) as kodeTerbesar FROM barang");
    // $data = mysqli_fetch_array($query);
    // return $data;
    $lastNoTransaksi = $data['noINV'];
 
    // baca nomor urut transaksi dari id transaksi terakhir 
    $lastNoUrut = substr($lastNoTransaksi, 8); 
    
    // nomor urut ditambah 1
    $nextNoUrut = (int) $lastNoUrut + 1;
    
    // membuat format nomor transaksi berikutnya
    $nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);
    return $nextNoTransaksi;
}
