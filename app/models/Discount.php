<?php
require_once '../app/core/Model.php';

class Discount extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function addDiscount($productId, $discount, $startDate, $endDate, $isActive) {
        $this->db->query("INSERT INTO discount (product_id, discount_percentage, start_date, end_date, is_active) VALUES (:product_id, :discount_percentage, :start_date, :end_date, :is_active)");
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':discount_percentage', $discount);
        $this->db->bind(':start_date', $startDate);
        $this->db->bind(':end_date', $endDate);
        $this->db->bind(':is_active', $isActive);
        return $this->db->execute();
    }

    function getActiveDiscountByProductId($productId) {
        $this->db->query("SELECT d.end_date, (p.price - (p.price * (d.discount_percentage / 100))) AS discounted_price FROM product p JOIN discount d ON p.product_id = d.product_id WHERE p.product_id = :product_id AND d.is_active = 1");
        $this->db->bind(':product_id', $productId);
        return $this->db->singleRow();
    }

    function getDiscountsByProductId($productId) {
        $this->db->query("SELECT * FROM discount WHERE product_id = :product_id");
        $this->db->bind(':product_id', $productId);
        return $this->db->resultSet();
    }


    function changeDiscountStatus($productId, $status) {
        $this->db->query("UPDATE discount SET is_active = :status WHERE product_id = :product_id");
        $this->db->bind(':status', $status);
        $this->db->bind(':product_id', $productId);
        return $this->db->execute();
    }


    
}
