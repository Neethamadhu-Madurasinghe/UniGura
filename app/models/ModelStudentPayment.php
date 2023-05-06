<?php

class ModelStudentPayment {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllPaymentsByStudentId(int $id): array {
        $this->db->query('SELECT 
                          p.id,
                          CONCAT(u.first_name, " ", u.last_name) AS tutor_name,
                          s.name AS subject_name,
                          m.name AS module_name,
                          p.amount,
                          p.timestamp
                          FROM 
                          payment p 
                          JOIN user u ON p.tutor_id = u.id 
                          JOIN day d ON p.day_id = d.id 
                          JOIN tutoring_class tc ON d.class_id = tc.id 
                          JOIN tutoring_class_template tct ON tc.class_template_id = tct.id 
                          JOIN subject s ON tct.subject_id = s.id 
                          JOIN module m ON tct.module_id = m.id 
                          WHERE 
                          p.student_id=:student_id
                          ORDER BY 
                          p.timestamp DESC;
                        ');
        $this->db->bind('student_id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function savePayment($data) : bool {
        $this->db->query('INSERT INTO payment SET day_id =:day_id,student_id = :student_id, tutor_id = :tutor_id , amount = :amount ,timestamp = NOW(), status = 1;');
        $this->db->bind('amount', $data['amount'], PDO::PARAM_INT);
        $this->db->bind('day_id', $data['day_id'], PDO::PARAM_INT);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_INT);
        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_INT);

        return $this->db->execute();
    }
}