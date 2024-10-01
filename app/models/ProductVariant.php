<?php
require_once '../app/core/Model.php';
class ProductVariant extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addProductVariant($product_id, $size_id, $color_id, $quantity_in_stock)
    {
        $this->db->query("INSERT INTO product_variant (product_id, size_id, color_id, quantity_in_stock) VALUES (:product_id, :size_id, :color_id, :quantity_in_stock)");
        $this->db->bind(':product_id', $product_id);
        $this->db->bind(':size_id', $size_id);
        $this->db->bind(':color_id', $color_id);
        $this->db->bind(':quantity_in_stock', $quantity_in_stock);
        return $this->db->execute();
    }

    public function getProductSizes($product_id)
    {
        $this->db->query("SELECT DISTINCT pv.size_id AS id, size_label AS name
        FROM product_variant pv
        JOIN size s ON pv.size_id = s.size_id
        WHERE pv.product_id = :id;");
        $this->db->bind(':id', $product_id);
        return $this->db->resultSet();
    }

    public function getProductColors($product_id)
    {
        $this->db->query("SELECT DISTINCT pv.color_id AS id, color_name AS name, hex_code AS color_code
        FROM product_variant pv
        JOIN color c ON pv.color_id = c.color_id
        WHERE pv.product_id = :id;");
        $this->db->bind(':id', $product_id);
        return $this->db->resultSet();
    }

    public function getVariantId($product_id, $size_id, $color_id)
    {
        $this->db->query("SELECT product_variant_id FROM product_variant WHERE product_id = :product_id AND size_id = :size_id AND color_id = :color_id");
        $this->db->bind(':product_id', $product_id);
        $this->db->bind(':size_id', $size_id);
        $this->db->bind(':color_id', $color_id);
        return $this->db->single();
    }

    public function getVariantsByProductId($product_id)
    {
        $this->db->query("SELECT pv.product_variant_id AS id, color_name, hex_code AS color, size_name AS size, quantity_in_stock AS quantity FROM product_variant pv JOIN color c ON pv.color_id = c.color_id JOIN size s ON pv.size_id = s.size_id WHERE product_id = :id;");
        $this->db->bind(':id', $product_id);
        return $this->db->resultSet();
    }

    public function updateQuantity($product_variant_id, $quantity)
    {
        $this->db->query("UPDATE product_variant SET quantity_in_stock = :quantity WHERE product_variant_id = :id");
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':id', $product_variant_id);
        return $this->db->execute();
    }
}
