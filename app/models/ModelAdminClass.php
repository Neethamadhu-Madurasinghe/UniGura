<?php

class ModelAdminClass
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllClasses()
    {

        $this->db->query("SELECT tutoring_class.tutor_id as tutorID, tutoring_class.date as date, tutoring_class.time as time, tutoring_class.class_type as class_type, tutoring_class.mode as mode,tutoring_class.session_rate as session_rate,tutoring_class.completion_status as completion_status, tutoring_class.student_id as student_id, tutoring_class_template.*,subject.name as subjectName,module.name as moduleName,user.first_name as student_first_name, user.last_name as student_last_name,user.profile_picture as student_profile_picture, tutoring_class_template.current_rating as currentRating FROM tutoring_class,tutoring_class_template,subject,module,user WHERE tutoring_class.class_template_id = tutoring_class_template.id AND tutoring_class_template.subject_id = subject.id AND tutoring_class_template.module_id = module.id AND tutoring_class.student_id = user.id");

        return $this->db->resultAll();
    }

    public function findStudent($studentId)
    {
        $this->db->query("SELECT * FROM user WHERE id = :student_id");

        $this->db->bind(':student_id', $studentId);

        return $this->db->resultOne();
    }

    public function findTutor($tutorId)
    {
        $this->db->query("SELECT * FROM user WHERE id = :tutor_id");

        $this->db->bind(':tutor_id', $tutorId);

        return $this->db->resultOne();
    }

    public function findClassDay($classId)
    {
        $this->db->query("SELECT * FROM day WHERE class_id = :class_id");

        $this->db->bind(':class_id', $classId);

        return $this->db->resultOne();
    }

    public function findTutoringClassTemplate($classTemplateId)
    {
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :class_template_id");

        $this->db->bind(':class_template_id', $classTemplateId);

        return $this->db->resultOne();
    }

    public function findModule($moduleId)
    {
        $this->db->query("SELECT * FROM module WHERE id = :module_id");

        $this->db->bind(':module_id', $moduleId);

        return $this->db->resultOne();
    }

    public function findSubject($subjectId)
    {
        $this->db->query("SELECT * FROM subject WHERE id = :subject_id");

        $this->db->bind(':subject_id', $subjectId);

        return $this->db->resultOne();
    }

    public function getAllSubjects()
    {
        $this->db->query("SELECT * FROM subject");

        return $this->db->resultAll();
    }
}
