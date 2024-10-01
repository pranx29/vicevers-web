<?php

require_once '../app/core/Model.php';


class Order extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllOrders()
    {
        $this->db->query("SELECT order_id, user_id, order_date, total_amount, delivery.status AS delivery_status
        FROM `order` o JOIN delivery ON delivery.delivery_id = o.delivery_id ORDER BY delivery_status");
        return $this->db->resultSet();
    }

    public function getOrdersByUserId($userId)
    {
        $this->db->query("SELECT order_id, order_date, total_amount, d.status AS delivery_status FROM `order` o
                                JOIN delivery d ON o.delivery_id = d.delivery_id
                                WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);
        return $this->db->resultSet();
    }

    public function getTotalOrders()
    {
        $this->db->query("SELECT COUNT(order_id) AS total_orders FROM `order`");
        return $this->db->single();
    }

    public function getTotalSales()
    {
        $this->db->query("SELECT SUM(oi.price * oi.quantity) AS total_sales
            FROM `order` o
            JOIN `order_item` oi ON o.order_id = oi.order_id
            WHERE o.status = 'Delivered';");
        return $this->db->single();
    }

    public function getMonthlySales()
    {
        $this->db->query("SELECT DATE_FORMAT(order_date, '%M') AS order_month, SUM(oi.price * oi.quantity) AS sales
        FROM `order` o
        JOIN `order_item` oi ON o.order_id = oi.order_id
        WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) AND status = 'Delivered' GROUP BY order_month ORDER BY order_date DESC LIMIT 3;");
        return $this->db->resultSet();
    }

    public function getOrderById($orderId)
    {
        $this->db->query("SELECT order_id, order_date, total_amount, status FROM `order`
        WHERE order_id = :orderId");
        $this->db->bind(':orderId', $orderId);
        return $this->db->singleRow();
    }

    public function getOrderItems($orderId)
    {
        $this->db->query("SELECT p.product_name, s.size_label AS size, c.color_name AS color, oi.quantity, (oi.quantity * oi.price) AS value FROM order_item oi JOIN product_variant pv ON oi.product_variant_id = pv.product_variant_id JOIN product p ON pv.product_id = p.product_id JOIN size s ON pv.size_id = s.size_id JOIN color c ON pv.color_id = c.color_id WHERE oi.order_id = :orderId;");
        $this->db->bind(':orderId', $orderId);
        return $this->db->resultSet();
    }

    public function updateStatus($orderId, $status)
    {
        if ($status == 'Delivered') {
            $this->db->query("UPDATE `order` o JOIN delivery d ON d.delivery_id = o.delivery_id SET o.status = 'Delivered', d.status = 'Delivered' WHERE o.order_id = :orderId");
        } else if ($status == 'Shipped') {
            $this->db->query("UPDATE `order` o JOIN delivery d ON d.delivery_id = o.delivery_id SET d.status = 'Shipped' WHERE o.order_id = :orderId");
        }
        $this->db->bind(':orderId', $orderId);
        // Removed unnecessary binding
        return $this->db->execute();
    }

    public function createOrder($userId, $cartId, $contactId, $shippingMethod, $totalAmount)
    {
        try {
            $this->db->query("START TRANSACTION");

            // Step 1: Insert into Deliveries
            $this->db->query("INSERT INTO delivery (delivery_method, contact_id) VALUES (:delivery_method, :contact_id)");
            $this->db->bind(':delivery_method', $shippingMethod);
            $this->db->bind(':contact_id', $contactId);
            $this->db->execute();

            // Get the last inserted delivery_id
            $deliveryId = $this->db->lastInsertId();

            // Step 2: Insert into Orders
            $this->db->query("INSERT INTO `order` (user_id, order_date, total_amount, delivery_id) VALUES (:user_id, CURDATE(), :total_amount, :delivery_id)");
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':total_amount', $totalAmount);
            $this->db->bind(':delivery_id', $deliveryId);
            $this->db->execute();

            // Get the last inserted order_id
            $orderId = $this->db->lastInsertId();

            // Step 3: Insert into OrderItems
            $this->db->query("
           INSERT INTO order_item (order_id, product_variant_id, price, quantity) SELECT :order_id, ci.product_variant_id, ROUND(COALESCE( (p.price - (p.price * d.discount_percentage / 100)), p.price ), 2) AS price, ci.quantity FROM cart_item ci JOIN product_variant pv ON ci.product_variant_id = pv.product_variant_id JOIN product p ON p.product_id = pv.product_id LEFT JOIN discount d ON d.product_id = p.product_id AND CURRENT_DATE BETWEEN d.start_date AND d.end_date WHERE ci.cart_id = :cart_id;
        ");
            $this->db->bind(':order_id', $orderId);
            $this->db->bind(':cart_id', $cartId);
            $this->db->execute();

            // Step 4: Delete the cart
            $this->db->query("DELETE FROM cart_item WHERE cart_id = :cart_id");
            $this->db->bind(':cart_id', $cartId);
            $this->db->execute();

            // Commit the transaction
            $this->db->query("COMMIT");
            return true;
        } catch (Exception $e) {
            // Rollback if there is an error
            $this->db->query("ROLLBACK");
            echo "Error: " . $e->getMessage();
        }
    }

}