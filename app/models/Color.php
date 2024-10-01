<?php
require_once BASE_URL . '/app/core/Model.php';

class Color extends Model
{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getAllColors()
    {
        $this->db->query('SELECT color_id AS id, color_name AS name, hex_code AS code FROM color');
        return $this->db->resultSet();
    }

    public function getColorById($id)
    {
        $this->db->query('SELECT * FROM color WHERE color_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addColor($name, $hexCode)
    {
        $this->db->query('INSERT INTO color (color_name, hex_code) VALUES (:name, :hexCode)');
        $this->db->bind(':name', $name);
        $this->db->bind(':hexCode', $hexCode);
        return $this->db->execute();
    }



}
