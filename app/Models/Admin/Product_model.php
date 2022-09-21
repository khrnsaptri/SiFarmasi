<?php namespace App\Models\Admin;

use CodeIgniter\Model;

class Product_model extends Model{
    protected $table 		= 'product';
	protected $primaryKey 	= 'id';
    protected $allowedFields = ['name', 'price', 'weight', 'category_id', 'stock', 'image', 'description', 'additional_information'];

    // Listing
	public function listing(){
		$this->select('product.*, category.name as category_name');
		$this->join('category', 'category.id = product.category_id');
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
		$this->select('product.*, category.name as category_name');
		$this->join('category', 'category.id = product.category_id');
		$this->where(['product.id' => $id]);
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