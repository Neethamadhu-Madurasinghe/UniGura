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



    public function selectedTutorBankDetails($tutorId){
        $this->db->query('SELECT * FROM tutor WHERE user_id = :tutor_id');
        $this->db->bind(':tutor_id', $tutorId);
        return $this->db->resultOne();
    }


    public function paymentDetailsByTutorId($tutorId){
        $this->db->query("SELECT * FROM `payment` WHERE `tutor_id` = :id");
        $this->db->bind(':id', $tutorId);
        return $this->db->resultAll();
    }

    public function classDayByDayId($classId){
        $this->db->query("SELECT * FROM `day` WHERE `id` = :id");
        $this->db->bind(':id', $classId);
        return $this->db->resultOne();
    }
        
    public function getStudentById($studentId){
        $this->db->query("SELECT * FROM `user` WHERE `id` = :id");
        $this->db->bind(':id', $studentId);
        return $this->db->resultOne();
    }

    public function getTutorialClassByClassId($classId){
        $this->db->query("SELECT * FROM `tutoring_class` WHERE `id` = :id");
        $this->db->bind(':id', $classId);
        return $this->db->resultOne();
    }

    public function getClassTemplateByClassTemplateId($classTemplateId){
        $this->db->query("SELECT * FROM `tutoring_class_template` WHERE `id` = :id");
        $this->db->bind(':id', $classTemplateId);
        return $this->db->resultOne();
    }

    public function getSubjectBySubjectId($subjectId){
        $this->db->query("SELECT * FROM `subject` WHERE `id` = :id");
        $this->db->bind(':id', $subjectId);
        return $this->db->resultOne();
    }

    public function getModuleByModuleId($moduleId){
        $this->db->query("SELECT * FROM `module` WHERE `id` = :id");
        $this->db->bind(':id', $moduleId);
        return $this->db->resultOne();
    }
}