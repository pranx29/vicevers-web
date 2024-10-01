<?php
require_once BASE_URL . '/app/core/Model.php';

class User extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUser($id)
    {
        $this->db->query("SELECT first_name AS fname,
        last_name AS lname, email FROM user WHERE user_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->singleRow();
    }

    public function authenticate($email, $password, $role)
    {
        $this->db->query("SELECT user_id, role FROM user WHERE email = :email AND password = :password AND role = :role");
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $this->db->bind(':role', $role);
        return $this->db->single();
    }


    public function register($fname, $lname, $email, $password)
    {
        $this->db->query("INSERT INTO user (first_name, last_name, email, password) VALUES (:fname, :lname, :email, :password)");
        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function update($id, $fname, $lname, $email)
    {
        $this->db->query("UPDATE user SET first_name = :fname, last_name = :lname, email = :email WHERE user_id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':email', $email);
        return $this->db->execute();
    }

    public function isEmailExist($email)
    {
        $this->db->query("SELECT user_id FROM user WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function getEmail($id)
    {
        $this->db->query("SELECT email FROM user WHERE user_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getAllCustomers()
    {
        $this->db->query("SELECT user_id AS id, first_name AS fname, last_name AS lname, email, registration_date, is_active FROM user WHERE role = 'customer'");
        return $this->db->resultSet();
    }

    public function changeStatus($id, $status)
    {
        $this->db->query("UPDATE user SET is_active = :status WHERE user_id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }

    public function getTotalCustomers()
    {
        $this->db->query("SELECT COUNT(user_id) AS total_customers FROM user WHERE role = 'customer'");
        return $this->db->single();
    }
}