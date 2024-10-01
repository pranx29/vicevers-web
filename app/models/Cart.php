<?php
require_once BASE_URL . '/app/core/Model.php';

class Cart extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCartProduct($userId)
    {
        $this->db->query('SELECT 
                ci.cart_id, 
                ci.cart_item_id, 
                ci.quantity, 
                p.product_name, 
                p.price AS price, 
                 ROUND(COALESCE(
            (p.price - (p.price * d.discount_percentage / 100)), 
            NULL
        ), 2) AS discounted_price,
                s.size_label, 
                c.color_name, 
                ( 
                    SELECT pi.image_url 
                    FROM product_image AS pi 
                    WHERE pi.product_id = p.product_id 
                    LIMIT 1 
                ) AS image_url 
            FROM 
                cart AS ct 
            JOIN 
                cart_item AS ci ON ct.cart_id = ci.cart_id 
            JOIN 
                product_variant AS pv ON ci.product_variant_id = pv.product_variant_id 
            JOIN 
                product AS p ON pv.product_id = p.product_id 
            JOIN 
                size AS s ON pv.size_id = s.size_id 
            JOIN 
                color AS c ON pv.color_id = c.color_id 
            LEFT JOIN 
                discount AS d ON d.product_id = p.product_id 
                AND CURRENT_DATE BETWEEN d.start_date AND d.end_date 
            WHERE 
                ct.user_id = :user_id
        ');

        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getCartId($userId)
    {
        $this->db->query('SELECT cart_id FROM cart WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        $cart = $this->db->single();

        if ($cart) {
            return $cart;
        }

        $this->db->query('INSERT INTO cart VALUES (cart_id, :user_id)');
        $this->db->bind(':user_id', $userId);
        $this->db->execute();
        return $this->db->lastInsertId();
    }


    public function getCartTotal($userId)
    {
        $this->db->query('SELECT 
            ROUND(SUM(
                COALESCE((p.price - (p.price * d.discount_percentage / 100)), p.price) * ci.quantity
            ), 2) AS total
            FROM 
                cart AS ct
            JOIN 
                cart_item AS ci ON ct.cart_id = ci.cart_id
            JOIN 
                product_variant AS pv ON ci.product_variant_id = pv.product_variant_id
            JOIN 
                product AS p ON pv.product_id = p.product_id
            LEFT JOIN 
                discount d ON d.product_id = p.product_id 
                AND CURRENT_DATE BETWEEN d.start_date AND d.end_date
            WHERE 
                ct.user_id = :user_id;
        ');

        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }

    public function getCartItemCount($userId)
    {
        $this->db->query('SELECT 
            COUNT(ci.cart_item_id) AS count
        FROM 
            cart AS ct
        JOIN 
            cart_item AS ci ON ct.cart_id = ci.cart_id
        WHERE 
            ct.user_id = :user_id');

        $this->db->bind(':user_id', $userId);
        return $this->db->single();

    }

    public function addCartItem($cartId, $productVariantId, $quantity)
    {
        $this->db->query('INSERT INTO cart_item (cart_id, product_variant_id, quantity) VALUES (:user_id, :product_variant_id, :quantity)');
        $this->db->bind(':user_id', $cartId);
        $this->db->bind(':product_variant_id', $productVariantId);
        $this->db->bind(':quantity', $quantity);
        return $this->db->execute();
    }

    public function removeCartItem($cartItemId)
    {
        $this->db->query('
        DELETE FROM cart_item
        WHERE cart_item_id = :cart_item_id
    ');

        $this->db->bind(':cart_item_id', $cartItemId);
        return $this->db->execute();
    }

    public function updateCartItem($cartItemId, $quantity)
    {
        $this->db->query('
        UPDATE cart_item
        SET quantity = :quantity
        WHERE cart_item_id = :cart_item_id');

        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':cart_item_id', $cartItemId);
        return $this->db->execute();
    }

}


