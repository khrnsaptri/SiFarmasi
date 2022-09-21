<?php namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model{
    protected $table 		= 'users';
	protected $primaryKey 	= 'id';
    protected $allowedFields = ['firstname', 'lastname', 'email', 'phone', 'password', 'verif_code', 'status'];

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

    //Check Slug
    public function check_email($email){
        $this->select('*');
		$this->where(['email' => $email]);
		$query = $this->get();
		return $query->getRowArray();
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