<?php

class ModelUser {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function isTutor(int $id): bool {
        $this->db->query('SELECT * FROM tutor WHERE user_id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $this->db->resultOne();
        return $this->db->rowCount() > 0;
    }

    public function isStudent(int $id): bool {
        $this->db->query('SELECT * FROM student WHERE user_id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $this->db->resultOne();
        return $this->db->rowCount() > 0;
    }

    public function getProfilePicture(int $id) {
        $this->db->query('SELECT profile_picture FROM user WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultOneAssoc();
    }
}