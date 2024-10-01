<?php
require_once BASE_URL . '/app/core/Model.php';

class Category extends Model
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function getAllCategory(){

        $this->db->query('SELECT category_id AS id, category_name AS name, description FROM category');
        return $this->db->resultSet();
    }

    public function getAllCategoryById($id){

        $this->db->query('SELECT * FROM category WHERE category_id = :id');
        $this->db->bind(':id', $id);
        $this->db->single();
    }

    public function addCategory($name, $description){
        $this->db->query('INSERT INTO category (category_name, description) VALUES (:name, :description)');
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);

        return $this->db->execute();
    }

}
