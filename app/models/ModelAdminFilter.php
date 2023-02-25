<?php

class ModelAdminFilter{

    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllStudent() {
        $this->db->query("SELECT * FROM student");

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getStudent($studentID) {
        $this->db->query("SELECT * FROM student WHERE user_id = :studentID");
        $this->db->bind(':studentID', $studentID);

        $rows = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getStudentById($studentID) {
        $this->db->query("SELECT * FROM user WHERE id = :studentID");
        $this->db->bind(':studentID', $studentID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }

    public function getActiveTutorialClass($studentID) {
        $this->db->query("SELECT * FROM tutoring_class WHERE student_id = :studentID AND completion_status = '0'");
        $this->db->bind(':studentID', $studentID);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getCompletedTutorialClass($studentID) {
        $this->db->query("SELECT * FROM tutoring_class WHERE student_id = :studentID AND completion_status = '1'");
        $this->db->bind(':studentID', $studentID);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getTutorById($tutorID) {
        $this->db->query("SELECT * FROM user WHERE id = :tutorID");
        $this->db->bind(':tutorID', $tutorID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }


    public function getClassTemplateById($classTemplateID) {
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :classTemplateID");
        $this->db->bind(':classTemplateID', $classTemplateID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }




    public function getSubjectById($subjectID) {
        $this->db->query("SELECT * FROM subject WHERE id = :subjectID");
        $this->db->bind(':subjectID', $subjectID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }

    public function getModuleById($moduleID) {
        $this->db->query("SELECT * FROM module WHERE id = :moduleID");
        $this->db->bind(':moduleID', $moduleID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        }else {
            return false;
        }
    }


    public function getClassDayByTutorialClassId($tutorialClassID) {
        $this->db->query("SELECT * FROM day WHERE class_id = :tutorialClassID");
        $this->db->bind(':tutorialClassID', $tutorialClassID);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }


    
    public function getAllTutor() {
        $this->db->query("SELECT * FROM tutor");

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getTutorContactDetails($tutorID) {
        $this->db->query("SELECT * FROM user WHERE id = :tutor_id");
        $this->db->bind(':tutor_id', $tutorID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() > 0) {
            return $row;
        }else {
            return false;
        }
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