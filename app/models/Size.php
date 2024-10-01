<?php
require_once '../app/core/Model.php';

class Size extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllSizes()
    {
        $this->db->query('SELECT size_id AS id, size_label AS label, size_name AS name FROM size');
        return $this->db->resultSet();
    }

    public function addSize($name, $label)
    {
        $this->db->query('INSERT INTO size (size_name, size_label) VALUES (:name, :label)');
        $this->db->bind(':name', $name);
        $this->db->bind(':label', strtoupper($label));
        return $this->db->execute();
    }
}
