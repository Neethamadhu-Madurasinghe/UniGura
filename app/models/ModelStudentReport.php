<?php

class ModelStudentReport {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function saveStudentReport($data): bool {
        $this->db->query('INSERT INTO tutor_report SET 
                                    description=:description, 
                                    tutor_id=:tutor_id, 
                                    student_id=:student_id, 
                                    reason_id=:reason_id,
                                    tutoring_class_template_id=:template_id');

        $this->db->bind('description', $data['description'], PDO::PARAM_STR);
        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_INT);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_INT);
        $this->db->bind('reason_id', $data['reason_id'], PDO::PARAM_STR);
        $this->db->bind('template_id', $data['template_id'], PDO::PARAM_STR);

        return $this->db->execute();
    }

    public function doesReportExist($data): bool {
        $this->db->query('SELECT * FROM student_report WHERE
                          tutor_id=:tutor_id AND
                          student_id=:student_id AND
                          tutoring_class_template_id=:template_id AND
                          is_inquired=:is_inquired');

        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_INT);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_INT);
        $this->db->bind('template_id', $data['template_id'], PDO::PARAM_INT);
        $this->db->bind('is_inquired', 0, PDO::PARAM_INT);

        $this->db->resultOne();
//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 0;
    }

}