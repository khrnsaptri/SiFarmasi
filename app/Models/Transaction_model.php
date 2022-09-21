<?php namespace App\Models;

use CodeIgniter\Model;

class Transaction_model extends Model{
    protected $table 		= 'transaction';
	protected $primaryKey 	= 'id';
    protected $allowedFields = ['invoice', 'product_id', 'qty', 'price', 'total'];

    // Listing
	public function listing(){
		$this->select('*');
		$this->orderBy('id','DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	//Tambah
	public function tambah($data){
		$this->save($data);
	}

	//Read
    public function getInv($invoice){
		$this->select('transaction.*, product.name, product.image, product.id as ProdukID');
		$this->join('product', 'transaction.product_id = product.id');
		$this->where(['transaction.invoice' => $invoice]);
		$query = $this->get();
		return $query->getResultArray();
	}

	//Read
    public function read($id){
		$this->select('*');
		$this->where(['id' => $id]);
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