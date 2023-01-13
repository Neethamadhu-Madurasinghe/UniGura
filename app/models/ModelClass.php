<?php

class ModelClass{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllClasses(){
        $this->db->query("SELECT * FROM tutoring_class");

        $rows = $this->db->resultAll();

        return $rows;
    }

    public function findStudent($studentId){
        $this->db->query("SELECT * FROM user WHERE id = :student_id");

        $this->db->bind(':student_id',$studentId);

        $student = $this->db->resultOne();

        return $student;
    }

    public function findTutor($tutorId){
        $this->db->query("SELECT * FROM user WHERE id = :tutor_id");

        $this->db->bind(':tutor_id',$tutorId);

        $tutor = $this->db->resultOne();

        return $tutor;
    }

    public function findClassDay($classId){
        $this->db->query("SELECT * FROM day WHERE class_id = :class_id");

        $this->db->bind(':class_id',$classId);

        $classDay = $this->db->resultOne();

        return $classDay;
    }

    public function findTutoringClassTemplate($classTemplateId){
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :class_template_id");

        $this->db->bind(':class_template_id',$classTemplateId);

        $classTemplate = $this->db->resultOne();

        return $classTemplate;
    }

    public function findModule($moduleId){
        $this->db->query("SELECT * FROM module WHERE id = :module_id");

        $this->db->bind(':module_id',$moduleId);

        $module = $this->db->resultOne();

        return $module;
    }

    public function findSubject($subjectId){
        $this->db->query("SELECT * FROM subject WHERE id = :subject_id");

        $this->db->bind(':subject_id',$subjectId);

        $subject = $this->db->resultOne();

        return $subject;
    }

    public function getAllSubjects(){
        $this->db->query("SELECT * FROM subject");

        $rows = $this->db->resultAll();

        return $rows;
    }

}