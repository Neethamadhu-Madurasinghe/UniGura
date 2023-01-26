<?php

class ModelStudentRequest {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function doesRequestExist(array $data): bool {
        $this->db->query('SELECT * FROM request WHERE tutor_id=:tutor_id AND student_id=:student_id');

        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_INT);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_INT);

        $this->db->resultOne();
//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 0;
    }
}