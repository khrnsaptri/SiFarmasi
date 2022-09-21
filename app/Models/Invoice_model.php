<?php namespace App\Models;

use CodeIgniter\Model;

class Invoice_model extends Model{
    protected $table 		= 'invoice';
	protected $primaryKey 	= 'id';
    protected $allowedFields = ['user_id', 'invoice_number', 'address_id', 'courier', 'shipping_cost', 'total', 'waybill', 'status', 'payment_date'];

    // Listing
	public function listing(){
		$this->select('*');
		$this->orderBy('id','DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	// Listing Admin Panel
	public function getTrxAdmin(){
		$this->select('invoice.*, users.firstname, users.lastname, users.email, users.phone');
		$this->join('users', 'invoice.user_id = users.id');
		$this->orderBy('id','DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	// Detail Invoice
	public function getDetail($noInv){
		$this->select('invoice.*, users.firstname, users.lastname, users.email, users.phone, address.phone, address.address, address.state, address.city, address.zipcode, address.apt');
		$this->join('users', 'invoice.user_id = users.id');
		$this->join('address', 'invoice.address_id = address.id');
		$this->orderBy('id','DESC');
		$this->where(['invoice.invoice_number' => $noInv]);
		$query = $this->get();
		return $query->getRowArray();
	}

	//Tambah
	public function tambah($data){
		$this->save($data);
	}

	//Read
    public function read($invoice){
		$this->select('*');
		$this->where(['invoice_number' => $invoice]);
		$query = $this->get();
		return $query->getRowArray();
	}

	//Read
    public function getAddress($invoice){
		$this->select('invoice.*, address.phone, address.address, address.state, address.city, address.zipcode, address.apt');
		$this->join('address', 'invoice.address_id = address.id');
		$this->where(['invoice.invoice_number' => $invoice]);
		$query = $this->get();
		return $query->getRowArray();
	}

	
	// Edit
	public function edit($data){
		$this->update(['id' => $data['id']], $data);
	}
	
	// Delete
	public function hapus($id){
		$this->where('id',$id);
		$this->delete();
	}
}