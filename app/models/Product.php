<?php
require_once BASE_URL . '/app/core/Model.php';

class Product extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts()
    {
        $this->db->query('SELECT product_id AS id, product_name AS name, product.description, category.category_name AS category, target_gender, price, is_active FROM product JOIN category ON category.category_id = product.category_id;');
        return $this->db->resultSet();
    }
    public function getProductById($id)
    {
        $this->db->query('SELECT * FROM product WHERE product_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->singleRow();
    }

    public function getBestSellers()
    {
        $this->db->query('SELECT p.product_id, p.product_name, p.price, MAX(pi.image_url) AS image_url, COALESCE(SUM(oi.quantity), 0) AS total_quantity_sold FROM product p LEFT JOIN product_image pi ON pi.product_id = p.product_id LEFT JOIN product_variant pv ON pv.product_id = p.product_id LEFT JOIN order_item oi ON oi.product_variant_id = pv.product_variant_id GROUP BY p.product_id, p.product_name, p.price ORDER BY total_quantity_sold DESC LIMIT 8;');
        return $this->db->resultSet();
    }

    public function getExclusiveOffers()
    {
        $this->db->query('SELECT p.product_id, p.product_name, p.price, pi.image_url, ROUND(COALESCE(
            (p.price - (p.price * d.discount_percentage / 100)), 
            p.price
        ), 2) AS discounted_price FROM product p JOIN product_image pi ON pi.product_id = p.product_id JOIN discount d ON d.product_id = p.product_id WHERE CURRENT_DATE BETWEEN d.start_date AND d.end_date AND d.is_active = 1;');
        return $this->db->resultSet();
    }
    public function getMensProduct($sortOrder = '', $categoryIds = '', $minPrice = null, $maxPrice = null)
    {
        $query = "SELECT
        p.product_id AS id,
        p.product_name AS name,
        p.description,
        p.price AS price,
        pi.image_url AS image_url,
        COALESCE(SUM(oi.quantity), 0) AS sales_count,
        ROUND(COALESCE(
            (p.price - (p.price * d.discount_percentage / 100)), 
            NULL
        ), 2) AS discounted_price
    FROM
        product p
    JOIN
        product_image pi ON pi.product_id = p.product_id
    LEFT JOIN
        product_variant pv ON p.product_id = pv.product_id
    LEFT JOIN
        order_item oi ON pv.product_variant_id = oi.product_variant_id
    LEFT JOIN
        `order` o ON oi.order_id = o.order_id AND o.status = 'Delivered'
    LEFT JOIN
        discount d ON d.product_id = p.product_id AND CURRENT_DATE BETWEEN d.start_date AND d.end_date
    WHERE
        p.target_gender = 'Men' AND p.is_active = 1
    ";

        if ($categoryIds) {
            $query .= " AND p.category_id IN ($categoryIds)";
        }

        if ($minPrice !== null) {
            $query .= " AND p.price >= $minPrice";
        }
        if ($maxPrice !== null) {
            $query .= " AND p.price <= $maxPrice";
        }

        $query .= " GROUP BY p.product_id, p.product_name, p.description, p.price, d.discount_percentage, p.date_added";

        switch ($sortOrder) {
            case 'Newest First':
                $query .= " ORDER BY p.date_added DESC";
                break;
            case 'Oldest First':
                $query .= " ORDER BY p.date_added ASC";
                break;
            case 'Best Selling':
                $query .= " ORDER BY sales_count DESC";
                break;
            default:
                $query .= " ORDER BY p.product_name ASC";
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }



    public function getProductDetails($id)
    {
        $this->db->query("SELECT 
    p.product_id, 
    p.product_name, 
    p.description, 
    p.price, 
    ROUND(COALESCE(
        (p.price - (p.price * d.discount_percentage / 100)), 
        NULL
    ), 2) AS discounted_price, 
    c.category_name AS category, 
    p.is_active, 
    p.target_gender 
FROM 
    product p 
JOIN 
    category c ON c.category_id = p.category_id 
LEFT JOIN 
    discount d ON d.product_id = p.product_id 
    AND CURRENT_DATE BETWEEN d.start_date AND d.end_date 
WHERE 
    p.product_id = :id;
");
        $this->db->bind(":id", $id);
        return $this->db->singleRow();
    }

    public function addProduct($name, $description, $target_gender, $price, $is_active, $category_id)
    {
        $this->db->query('INSERT INTO product (product_name, description, target_gender, price, is_active, category_id) VALUES(:name, :description, :gender, :price, :is_active, :category_id)');

        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->bind(':gender', $target_gender);
        $this->db->bind(':price', $price);
        $this->db->bind(':is_active', $is_active);
        $this->db->bind(':category_id', $category_id);

        return $this->db->execute();
    }

    public function hideProduct($id)
    {
        $this->db->query('UPDATE products SET is_active = 0 WHERE product_id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function updateProduct($productId, $productName, $description, $gender, $price, $isActive, $categoryId)
    {
        $this->db->query('UPDATE product SET product_name = :name, description = :description, target_gender = :gender, price = :price, is_active = :isActive, category_id = :categoryId WHERE product_id = :productId');
        $this->db->bind(':name', $productName);
        $this->db->bind(':description', $description);
        $this->db->bind(':gender', $gender);
        $this->db->bind(':price', $price);
        $this->db->bind(':isActive', $isActive);
        $this->db->bind(':categoryId', $categoryId);
        $this->db->bind(':productId', $productId);

        return $this->db->execute();
    }

    public function getTotalProducts()
    {
        $this->db->query('SELECT COUNT(product_id) AS total_products FROM product');
        return $this->db->single();
    }

    public function getThreeBestSellers()
    {
        $this->db->query('SELECT p.product_name AS name, p.price AS price, SUM(oi.quantity) AS sold, SUM(oi.price * oi.quantity) AS sales FROM `order_item` oi JOIN `order` o ON oi.order_id = o.order_id JOIN product_variant pv ON oi.product_variant_id = pv.product_variant_id JOIN product p ON pv.product_id = p.product_id WHERE o.status = \'Delivered\' GROUP BY p.product_name, p.price, oi.product_variant_id ORDER BY sold DESC LIMIT 3;');
        return $this->db->resultSet();
    }

    public function getLowStockProducts()
    {
        $this->db->query('SELECT p.product_name AS name, c.color_name AS color, s.size_label AS size, pv.quantity_in_stock AS quantity_left FROM product_variant pv JOIN product p ON pv.product_id = p.product_id JOIN color c ON pv.color_id = c.color_id JOIN size s ON pv.size_id = s.size_id WHERE pv.quantity_in_stock < 20;');
        return $this->db->resultSet();
    }
}