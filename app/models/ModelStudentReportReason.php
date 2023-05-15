<?php

class ModelStudentReportReason {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

//  Checks whether the request exists when the tutorId, studentId and classTemplateId are given
    public function getStudentReportReason(): array {
        $this->db->query('SELECT * FROM report_reason WHERE is_for_tutor=:is_for_tutor');

        $this->db->bind('is_for_tutor', 1, PDO::PARAM_INT);
        return $this->db->resultAllAssoc();
    }
}