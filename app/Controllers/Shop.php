<?php
namespace App\Controllers;

// Load Model
use App\Models\Admin\Product_model;
use App\Models\Address_model;
use App\Models\Invoice_model;
use App\Models\Transaction_model;
use App\Models\Users_model;
// End Load Model

// require_once dirname(__FILE__) . '/pathofproject/Midtrans.php';

class Shop extends BaseController{
    public function __construct(){
        helper('form');
        $this->form_validation = \Config\Services::validation();
    }

    public function addToCart(){
        if($this->request->isAJAX()){
            $idProduk = service('request')->getPost('id');
            $qty = service('request')->getPost('qty');

            $dataCart = session()->get('dataCart');

            $cart = [
                'id'    => $idProduk,
                'qty'   => $qty
            ];

            if(!empty($dataCart)){
                foreach($dataCart as $key => $value){
                    if($value['id'] == $idProduk){
                        $key1 = $key;
                        $qty1 = $value['qty'];
                    } 
                }

                if(isset($key1)){
                    $cart['qty'] = $qty1 + $qty;
                    $dataCart[$key1] = $cart;
                } else {
                    $dataCart[] = $cart;
                }
            } else {
                $dataCart[] = $cart;
            }
            session()->set('dataCart', $dataCart);
            $this->viewCart();
        }
    }

    public function viewCart(){
        $product_model = new Product_model();

        if($this->request->isAJAX()){
            $dataCart = session()->get('dataCart');
            $miniCart = "";
            foreach($dataCart as $key => $value){
                $dataProduk = $product_model->read($value['id']);
                $gambar = unserialize($dataProduk['image']);
                $miniCart .= '
                    <li class="mini_cart_item">
                        <div class="left-section">
                            <a href="'.base_url('product/detail/'.$value['id']).'">
                                <img src="'.base_url('assets/uploads/images/'.$gambar[0]).'" alt="">
                            </a>
                        </div>
                        <div class="right-section">
                            '.$dataProduk['name'].'
                            <div>
                                <div class="item-desc">Qty: '.$value['qty'].'</div>
                                <div class="item-desc">Rp. '.number_format($dataProduk['price'], 0, ',', '.').'</div>
                            </div>
                        </div>			
                    </li>
                ';
            }
            $miniCart .= '<li class="w-100 d-block">
                <a href="'. base_url('shop/cart'). '" class="btn btn-primary w-100 d-block">
                    lihat Keranjang
                </a>
            </li>';

            $data = [
                'miniCart' => $miniCart,
                'count'    => count($dataCart)
            ];
            return json_encode($data);
        }
    }

    public function cart(){
        // Proteksi
        if(session()->get('user_email') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url());
        }
        // End proteksi

        $address_model = new Address_model();
        $product_model = new Product_model();
        $users_model = new Users_model();

        $dataCart = session()->get('dataCart');
        if(empty($dataCart)){
            return redirect()->to(base_url());
        }
        $dataUser = $users_model->check_email(session()->get('user_email'));
        $dataProduk = [];
        foreach($dataCart as $key => $value){
            $dataProduk[] = $product_model->read($value['id']);
            $dataProduk[$key]['qty'] = $value['qty'];
        }

        $data = [
            'title'      => "Keranjang",
            'dataProduk' => $dataProduk,
            'dataCart'   => $dataCart,
            'dataAlamat' => $address_model->listing($dataUser['id']),
            'user_login' => $dataUser
        ];
        return view('shop/cart', $data);
    }

    public function updateCart(){
        if($this->request->isAJAX()){
            $key = service('request')->getPost('key');
            $qty = service('request')->getPost('qty');

            $dataCart = session()->get('dataCart');

            $dataCart[$key]['qty'] = $qty;
            session()->set('dataCart', $dataCart);
            $this->viewCart();
        }
    }

    public function deleteCart(){
        if($this->request->isAJAX()){
            $key = service('request')->getPost('key');

            $dataCart = session()->get('dataCart');
            $count = count($dataCart);

            if($count == 1){
                session()->remove('dataCart');
            } else {
                unset($dataCart[$key]);
                session()->set('dataCart', $dataCart);
            }

            $data = [
                'count'    => $count-1
            ];
            return json_encode($data);
        }
    }

    public function emptyCart(){
        session()->remove('dataCart');
        return redirect()->to(base_url());
    }
    

    public function checkout(){
        // Proteksi
        if(session()->get('user_email') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url());
        }
        // End proteksi

        $address_model = new Address_model();
        $product_model = new Product_model();
        $users_model = new Users_model();
        $invoice_model = new Invoice_model();
        $transaction_model = new Transaction_model();

        if($this->request->isAJAX()){
            $idAlamat = service('request')->getPost('idAlamat');
            $courier = service('request')->getPost('courier');
            $shipping_cost = service('request')->getPost('shipping_cost');
            $total_price = service('request')->getPost('total');
            $dataUser = $users_model->check_email(session()->get('user_email'));
            $dataCart = session()->get('dataCart');
            if(empty($dataCart)){
                return redirect()->to(base_url());
            }
            if($shipping_cost == "" || $idAlamat == ""){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Data kurir atau alamat belum dipilih'
                ]);
            }
            
            $noInv = generateInv();
            foreach($dataCart as $key => $value){
                $dataProduk = $product_model->read($value['id']);
                $data = [
                    'invoice'        => $noInv,
                    'product_id'     => $value['id'],
                    'qty'            => $value['qty'],
                    'price'          => $dataProduk['price'],
                    'total'          => $dataProduk['price'] * $value['qty']
                ];
                $transaction_model->insert($data);
            }

            $data1 = [
                'user_id'       => $dataUser['id'],
                'invoice_number'=> $noInv,
                'address_id'    => $idAlamat,
                'courier'       => $courier,
                'shipping_cost' => $shipping_cost,
                'total'         => $total_price,
                'status'        => 'pending'
            ];
            $invoice_model->insert($data1);
            session()->remove('dataCart');
            // return $noInv;
            return $this->response->setJSON([
                'status' => true,
                'noInv' => $noInv
            ]);
        }
    }

    public function payment($noInv){
        // Proteksi
        if(session()->get('user_email') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url());
        }
        // End proteksi

        $invoice_model = new Invoice_model();
        $transaction_model = new Transaction_model();
        $users_model = new Users_model();

        $dataInvoice = $invoice_model->read($noInv);
        if(empty($dataInvoice)){
            return redirect()->to(base_url());
        }

        $dataTransaction = $transaction_model->getInv($noInv);
        $subtotal = 0;
        foreach($dataTransaction as $key => $value){
            $subtotal += $value['total'];
        }
        $ppn = $subtotal * 0.1;

        $dataUser = $users_model->check_email(session()->get('user_email'));

        // Set your Merchant Server Key
        $serverKey = \Midtrans\Config::$serverKey = $_ENV['Mid-server-MjkEOlGfsTMxUbL8bcYypm_p'];
        $clientKey = \Midtrans\Config::$clientKey = $_ENV['Mid-client-7BiatSfq3IaK9J_V'];
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $noInv,
                'gross_amount' => $dataInvoice['total'],
            ),
            'customer_details' => array(
                'first_name' => $dataUser['firstname'],
                'last_name' => $dataUser['lastname'],
                'email' => $dataUser['email'],
                'phone' => $dataUser['phone'],
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        $data = [
            'title'      => "Pembayaran",
            'subtotal'   => $subtotal,
            'ppn'        => $ppn,
            'ongkir'     => $dataInvoice['shipping_cost'],
            'total'      => $subtotal + $ppn + $dataInvoice['shipping_cost'],
            'clientKey'  => $clientKey,
            'snapToken'  => $snapToken,
            'dataInvoice'=> $dataInvoice
        ];
        return view('shop/payment', $data);
    }

    public function notification(){
		$json = $this->request->getJSON(true);

		if($json['status_code'] == 200){
			$db      = \Config\Database::connect();
			$db->query("UPDATE invoice SET status = 'dibayar', payment_type ='".$json['payment_type']."', transaction_id ='".$json['transaction_id']."', payment_date ='".$json['transaction_time']."' WHERE invoice_number = '".$json['order_id']."'");
			$db->affectedRows();
		} else {
			$db      = \Config\Database::connect();
			$db->query("UPDATE invoice SET status = '".$json['transaction_status']."', payment_type ='".$json['payment_type']."', transaction_id ='".$json['transaction_id']."', payment_date ='".$json['transaction_time']."' WHERE invoice_number = '".$json['order_id']."'");
			$db->affectedRows();
		}

		return $this->response->setJSON(['status' => 'success']);
	}
}
