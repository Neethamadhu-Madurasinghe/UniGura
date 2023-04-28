<?php

class ModelTutorReportProblem
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function tutorReportProblem($data)
    {
        $this->db->query('INSERT INTO student_report VALUES (description = :description, is_inquired =: inquire,student_id =: studentID, tutor_id =: tutorID, reason_id =: reasonID)');

        $this->db->bind('description', $data['description'], PDO::PARAM_STR);
        $this->db->bind('is_inquired', 0, PDO::PARAM_INT);
        $this->db->bind('student_id', $data['studentID'], PDO::PARAM_INT);
        $this->db->bind('tutor_id', $data['tutorID'], PDO::PARAM_INT);
        $this->db->bind('reason_id', $data['reasonID'], PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function getTutorReportReason():Array
    {
        $this->db->query("SELECT * FROM report_reason WHERE is_for_tutor = 0");

        return $this->db->resultAllAssoc();
  }
}
