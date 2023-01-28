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

    public function getStudent($studentID){
        $this->db->query("SELECT * FROM student WHERE user_id = :studentID");
        $this->db->bind(':studentID', $studentID);

        $rows = $this->db->resultOne();

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

    public function getActiveTutorialClass($studentID){
        $this->db->query("SELECT * FROM tutoring_class WHERE student_id = :studentID AND completion_status = '0'");
        $this->db->bind(':studentID', $studentID);

        $rows = $this->db->resultAll();

        if($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getCompletedTutorialClass($studentID){
        $this->db->query("SELECT * FROM tutoring_class WHERE student_id = :studentID AND completion_status = '1'");
        $this->db->bind(':studentID', $studentID);

        $rows = $this->db->resultAll();

        if($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getTutorById($tutorID){
        $this->db->query("SELECT * FROM user WHERE id = :tutorID");
        $this->db->bind(':tutorID', $tutorID);

        $row = $this->db->resultOne();

        if($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }


    public function getClassTemplateById($classTemplateID){
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :classTemplateID");
        $this->db->bind(':classTemplateID', $classTemplateID);

        $row = $this->db->resultOne();

        if($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }




    public function getSubjectById($subjectID){
        $this->db->query("SELECT * FROM subject WHERE id = :subjectID");
        $this->db->bind(':subjectID', $subjectID);

        $row = $this->db->resultOne();

        if($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }

    public function getModuleById($moduleID){
        $this->db->query("SELECT * FROM module WHERE id = :moduleID");
        $this->db->bind(':moduleID', $moduleID);

        $row = $this->db->resultOne();

        if($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }


    public function getClassDayByTutorialClassId($tutorialClassID){
        $this->db->query("SELECT * FROM day WHERE class_id = :tutorialClassID");
        $this->db->bind(':tutorialClassID', $tutorialClassID);

        $rows = $this->db->resultAll();

        if($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }
}