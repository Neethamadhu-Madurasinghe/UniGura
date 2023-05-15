<?php

class ModelClass{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllClasses() {
        $this->db->query("SELECT * FROM tutoring_class");

        return $this->db->resultAll();
    }

    public function findStudent($studentId) {
        $this->db->query("SELECT * FROM user WHERE id = :student_id");

        $this->db->bind(':student_id', $studentId);

        return $this->db->resultOne();
    }

    public function findTutor($tutorId) {
        $this->db->query("SELECT * FROM user WHERE id = :tutor_id");

        $this->db->bind(':tutor_id', $tutorId);

        return $this->db->resultOne();
    }

    public function findClassDay($classId) {
        $this->db->query("SELECT * FROM day WHERE class_id = :class_id");

        $this->db->bind(':class_id', $classId);

        return $this->db->resultOne();
    }

    public function findTutoringClassTemplate($classTemplateId) {
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :class_template_id");

        $this->db->bind(':class_template_id', $classTemplateId);

        return $this->db->resultOne();
    }

    public function findModule($moduleId) {
        $this->db->query("SELECT * FROM module WHERE id = :module_id");

        $this->db->bind(':module_id', $moduleId);

        return $this->db->resultOne();
    }

    public function findSubject($subjectId) {
        $this->db->query("SELECT * FROM subject WHERE id = :subject_id");

        $this->db->bind(':subject_id', $subjectId);

        return $this->db->resultOne();
    }

    public function getAllSubjects() {
        $this->db->query("SELECT * FROM subject");

        return $this->db->resultAll();
    }

}