<?php

class ModelAdminComplaintView{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getStudentComplaints(){
        $this->db->query("SELECT * FROM student_report");
        return $this->db->resultAll();
    }

    public function studentReportById($reportID){
        $this->db->query("SELECT * FROM student_report WHERE id = :report_id");
        $this->db->bind(':report_id', $reportID);
        return $this->db->resultOne();
    }

    public function reportSeasonById($reasonID){
        $this->db->query("SELECT * FROM report_reason WHERE id = :reason_id");
        $this->db->bind(':reason_id', $reasonID);
        return $this->db->resultOne();
    }

    public function userById($userID){
        $this->db->query("SELECT * FROM user WHERE id = :user_id");
        $this->db->bind(':user_id', $userID);
        return $this->db->resultOne();
    }
}