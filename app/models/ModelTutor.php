<?php

class ModelTutor{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllTutor(){
        $this->db->query("SELECT * FROM tutor");

        $rows = $this->db->resultAll();

        if($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getTutorContactDetails($tutorID){
        $this->db->query("SELECT * FROM user WHERE id = :tutor_id");
        $this->db->bind(':tutor_id', $tutorID);

        $row = $this->db->resultOne();

        if($this->db->rowCount() > 0) {
            return $row;
        }else {
            return false;
        }
    }
}