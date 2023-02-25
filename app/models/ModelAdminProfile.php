<?php

class ModelAdminProfileModel
{
    private mixed $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function updatePassword($adminID, $newPassword) {
        $this->db->query("UPDATE `auth` SET `password` = :newPassword WHERE `id` = :userID");
        $this->db->bind(':userID', $adminID);
        $this->db->bind(':newPassword', $newPassword);

        $this->db->execute();
    }
}
