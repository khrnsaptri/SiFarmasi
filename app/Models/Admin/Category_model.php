<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class Category_model extends Model{
    protected $table 		= 'category';
	protected $primaryKey 	= 'id';
    protected $allowedFields = ['name', 'slug', 'image'];

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
    public function check_slug($slug){
        $this->select('*');
		$this->where(['slug' => $slug]);
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