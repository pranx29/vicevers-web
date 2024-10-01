<?php
require_once '../app/core/Model.php';
class ProductColor extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addProductColor($colorId, $productId)
    {
        $this->db->query("INSERT INTO product_color (color_id, product_id) VALUES (:color_id, :product_id)");
        $this->db->bind(':color_id', $colorId);
        $this->db->bind(':product_id', $productId);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function getAvailableColors($productId)
    {
        $this->db->query("SELECT c.color_id AS id, c.color_name AS name, c.hex_code AS color FROM product_color pc JOIN color c ON pc.color_id = c.color_id WHERE pc.product_id = :id");
        $this->db->bind(':id', $productId);
        return $this->db->resultSet();
    }
    
}

