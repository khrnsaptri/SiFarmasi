<?php
namespace App\Controllers\Admin;

// Load Model
use App\Models\Admin\Admin_model;
use App\Models\Admin\Product_model;
use App\Models\Invoice_model;
use App\Models\Transaction_model;
use App\Models\Users_model;
// End Load Model

use App\Controllers\BaseController;

class Transaction extends BaseController{
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
        $modelInvoice = new Invoice_model();

        $data = [
            'title'             => "Dashboard",
            "transaction"       => TRUE,
            "invoice"           => $modelInvoice->getTrxAdmin(),
            'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
        ];
        return view('admin/transaction/index.php', $data);
    }

    public function process($noInv = null){
        // Proteksi
        if(session()->get('admin_user') == "") {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect()->to(base_url('admin/login'));
        }
        // End proteksi
        
        $modelAdmin = new Admin_model();
        $modelInvoice = new Invoice_model();
        $modelTransaction = new Transaction_model();

        $dataInvoice = $modelInvoice->getDetail($noInv);
        if($dataInvoice == ""){
            return redirect()->to(base_url("admin/transaction"));
        }

        if($dataInvoice['status'] == "pending" || $dataInvoice['status'] == "cancel"){
            return redirect()->to(base_url("admin/transaction"));
        }

        $dataTransaction = $modelTransaction->getInv($noInv);
        $method = $this->request->getMethod();
        if($method == "get"){
            $subtotal = 0;
            foreach($dataTransaction as $trx){
                $subtotal += $trx['total'];
            }

            $data = [
                'title'             => "Proses Pesanan",
                "transaction"       => TRUE,
                "dataInvoice"       => $dataInvoice,
                'subtotal'          => $subtotal,
                'ppn'               => $subtotal * 0.1,
                'ongkir'            => $dataInvoice['shipping_cost'],
                'dataTrx'           => $dataTransaction,
                'user_login'        => $modelAdmin->check_user(session()->get('admin_user'))
            ];
            return view('admin/transaction/proses.php', $data);
        } elseif ($method == "post"){
            $waybill = filter_var($this->request->getVar('waybill'), FILTER_SANITIZE_STRING);
            // echo $waybill;
            $data = [
                'waybill'   => $waybill,
                'status'    => 'dikirim'
            ];
            $modelInvoice->update($dataInvoice['id'], $data);
            session()->setFlashdata('success', 'Nomor Resi Berhasil di Update');
            return redirect()->to(base_url('admin/transaction'));
        }
    }
}