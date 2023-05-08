<?php

class ModelTutorReportProblem
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function setStudentreport($data):bool
    {
        $this->db->query('INSERT INTO student_report (description, is_inquired, student_id, tutor_id, reason_id ) VALUES (:description, 0, :student_id, :tutor_id, :reason_id )');

        $this->db->bind('description', $data['description'], PDO::PARAM_STR);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_INT);
        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_INT);
        $this->db->bind('reason_id', $data['report_reasons'], PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function getTutorReportReason():Array
    {
        $this->db->query("SELECT * FROM report_reason WHERE is_for_tutor = 0");

        return $this->db->resultAllAssoc();
  }
}
