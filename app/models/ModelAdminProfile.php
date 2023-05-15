<?php

class ModelAdminProfile
{
    private mixed $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function updatePassword($adminID, $newPassword) {
        $this->db->query("UPDATE auth SET password = :newPassword WHERE id = :userID");
        $this->db->bind(':userID', $adminID,PDO::PARAM_INT);
        $this->db->bind(':newPassword', $newPassword);

        $this->db->execute();
    }

    public function getAdminCurrentPassword($adminID){
        $this->db->query("SELECT password FROM auth WHERE id = :userID");
        $this->db->bind(':userID', $adminID,PDO::PARAM_INT);

        return $this->db->resultOne();
    }
}
