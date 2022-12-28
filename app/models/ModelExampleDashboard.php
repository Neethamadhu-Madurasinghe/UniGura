<?php

class ModelExampleDashboard {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function findUserById($id) {
        $this->db->query('SELECT * FROM auth WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_STR);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() > 0) {
            return $row;
        }else {
            return false;
        }
    }

}