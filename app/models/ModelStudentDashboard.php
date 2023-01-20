<?php

class ModelStudentDashboard {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserProfilePicture($id) {
        $this->db->query('SELECT profile_picture FROM user WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $row = $this->db->resultOne();
        if (!$row) { return false; }
        if ($row->profile_picture === NULL || $row->profile_picture === '') { return false; }

//      Returns whether the row count is greater than 0
        return $row->profile_picture;
    }
}
