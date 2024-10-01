<?php 
require_once '../app/core/Model.php';
class ProductImage extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function addProductImage($imageUrl, $productId, $colorId) {
        $this->db->query("INSERT INTO product_image (image_url, product_id, color_id) VALUES (:url, :product_id, :color_id)");
        $this->db->bind(':url', $imageUrl);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':color_id', $colorId);
        return $this->db->execute();
    }

    public function getProductImages($productId) {
        $this->db->query("SELECT image_url, color_id FROM product_image WHERE product_id = :product_id");
        $this->db->bind(':product_id', $productId);
        return $this->db->resultSet();
    }




    
}
