<?php namespace App\Models;

use CodeIgniter\Model;

class Address_model extends Model{
    protected $table 		= 'address';
	protected $primaryKey 	= 'id';
    protected $allowedFields = ['user_id', 'receiver_name', 'phone', 'address', 'apt', 'city', 'state', 'zipcode', 'country'];

    // Listing
	public function listing($id){
		$this->select('*');
		$this->where('user_id', $id);
		$this->orderBy('id','DESC');
		$query = $this->get();
		return $query->getResultArray();
	}

	//Tambah
	public function tambah($data){
		$this->save($data);
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