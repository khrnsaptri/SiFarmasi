<?php
namespace App\Controllers;

// Load Model
use App\Models\Address_model;
use App\Models\Admin\Product_model;
// End Load Model

class Data extends BaseController{
    public function __construct(){
        helper('form');
        $this->form_validation = \Config\Services::validation();
    }

    // Refresh Token
    public function refreshToken(){        
        // Generate new Token
        $data = csrf_hash();
        return $data;
    }

    // Cek Ongkir
    public function getOngkir(){
        if($this->request->isAJAX()){
            // Get Data Kota RajaOngkir
            // $city = json_decode(getCity(), true);
                
            $alamat = service('request')->getPost('alamat');
            $kurir = service('request')->getPost('kurir');
            
            $address_model = new Address_model();
            $dataAddress = $address_model->read($alamat);
            $zipcode = $dataAddress['zipcode'];

            // foreach($city['rajaongkir']['results'] as $key => $value){
            //     if($value['postal_code'] == $dataAddress['zipcode']){
            //         $city_id = $value['city_id'];
            //     }
            // }

            $product_model = new Product_model();
            $dataCart = session()->get('dataCart');
            $berat = 0;
            foreach($dataCart as $key => $value){
                $dataProduk = $product_model->read($value['id']);
                $berat += $dataProduk['weight'] * $value['qty'];
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=399&destination=$zipcode&weight=$berat&courier=$kurir", // origin dari kota semarang, deestination bisa pakai kode pos
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
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
    }
}