<?php
require_once BASE_URL . '/app/core/Model.php';

class Contact extends Model
{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getContactinfo($user_id)
    {
        $this->db->query("SELECT contact_id, street, city, postal_code, phone_number FROM contact 
        JOIN user ON contact.user_id = user.user_id WHERE user.user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function update($contact_id, $street, $city, $postal_code, $phone_number)
    {
        $this->db->query("UPDATE contact SET street = :street, city = :city, postal_code = :postal_code, phone_number = :phone_number WHERE contact_id = :contact_id");
        $this->db->bind(':contact_id', $contact_id);
        $this->db->bind(':street', $street);
        $this->db->bind(':city', $city);
        $this->db->bind(':postal_code', $postal_code);
        $this->db->bind(':phone_number', $phone_number);
        return $this->db->execute();
    }

    public function add($user_id, $street, $city, $postal_code, $phone_number)
    {
        $this->db->query("INSERT INTO contact (user_id, street, city, postal_code, phone_number) VALUES (:user_id, :street, :city, :postal_code, :phone_number)");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':street', $street);
        $this->db->bind(':city', $city);
        $this->db->bind(':postal_code', $postal_code);
        $this->db->bind(':phone_number', $phone_number);
        return $this->db->execute();
    }

    public function getDeliveryDetails($orderId)
    {
        $this->db->query("SELECT d.status, c.street, c.city, c.postal_code, c.phone_number, u.first_name, u.last_name FROM `order` o JOIN `delivery` d ON d.delivery_id = o.delivery_id JOIN `contact` c ON c.contact_id = d.contact_id JOIN `user` u ON u.user_id = c.user_id WHERE o.order_id = :orderId");
        $this->db->bind(':orderId', $orderId);
        return $this->db->singleRow();
    }
}