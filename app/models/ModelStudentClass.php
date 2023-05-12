<?php

class ModelStudentClass {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllClassDetailsByStudentId(int $id): array {
        $this->db->query('SELECT * FROM tutoring_class WHERE student_id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }
}