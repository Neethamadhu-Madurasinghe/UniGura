<?php

class ModelAdminDashboard {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getSubjects():array {
        $this->db->query('SELECT * FROM subject');

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getModule($subject_id){
        $this->db->query("SELECT * FROM module WHERE subject_id=$subject_id");

        $rows = $this->db->resultAll();
        
        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getAllTutors(){
        $this->db->query("SELECT * FROM tutor");

        $rows = $this->db->resultAll();
        
        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function tutorGetById($tutorID){
        $this->db->query("SELECT * FROM user WHERE id = :tutorID");
        $this->db->bind(':tutorID', $tutorID);

        return $this->db->resultOne();
    }


    public function getAllStudents(){
        $this->db->query("SELECT * FROM student");

        $rows = $this->db->resultAll();
        
        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function studentGetById($studentID){
        $this->db->query("SELECT * FROM user WHERE id = :studentID");
        $this->db->bind(':studentID', $studentID);

        return $this->db->resultOne();
    }

    public function getAllSubjects(){
        $this->db->query("SELECT * FROM subject");

        $rows = $this->db->resultAll();
        
        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getAllModules(){
        $this->db->query("SELECT * FROM module");

        $rows = $this->db->resultAll();
        
        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getAllTutorialClasses(){
        $this->db->query("SELECT * FROM tutoring_class");

        $rows = $this->db->resultAll();
        
        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }


    public function getAllTutorReports(){
        $this->db->query("SELECT * FROM tutor_report");

        $rows = $this->db->resultAll();
        
        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getAllStudentReports(){
        $this->db->query("SELECT * FROM student_report");

        $rows = $this->db->resultAll();
        
        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

}