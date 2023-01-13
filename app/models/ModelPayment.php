<?php

class ModelPayment{
    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function allPayoffTutor(){
        $this->db->query("SELECT * FROM `payment` WHERE `is_withdrawed` = '0'");
        return $this->db->resultAll();
    }



    public function getTutorById($tutorId){
        $this->db->query("SELECT * FROM `user` WHERE `id` = :id");
        $this->db->bind(':id', $tutorId);
        return $this->db->resultOne();
    }

    public function selectedTutorDetails($tutorId){
        $this->db->query("SELECT * FROM `tutor` WHERE `user_id` = :id");
        $this->db->bind(':id', $tutorId);
        return $this->db->resultOne();
    }

    public function getAllClassesByTutorId($tutorId){
        $this->db->query("SELECT * FROM `tutoring_class` WHERE `tutor_id` = :id");
        $this->db->bind(':id', $tutorId);
        return $this->db->resultAll();
    }


    public function getClassTemplateDetailsByClassTemplateId($classTemplateId){
        $this->db->query("SELECT * FROM `tutoring_class_template` WHERE `id` = :id");
        $this->db->bind(':id', $classTemplateId);
        return $this->db->resultOne();
    }
        
}