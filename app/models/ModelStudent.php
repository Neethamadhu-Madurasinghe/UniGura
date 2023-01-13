<?php

class ModelStudent{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllStudent(){
        $this->db->query("SELECT * FROM student");

        $rows = $this->db->resultAll();

        if($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getStudentById($studentID){
        $this->db->query("SELECT * FROM user WHERE id = :studentID");
        $this->db->bind(':studentID', $studentID);

        $row = $this->db->resultOne();

        if($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }
}