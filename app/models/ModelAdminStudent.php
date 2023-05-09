<?php

class ModelAdminStudent {

    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllStudent() {
        $this->db->query("SELECT student.*, user.* FROM student INNER JOIN user ON student.user_id = user.id");

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getAllTutorialClassesByStudentId($studentID)
    {
        $this->db->query("SELECT tutoring_class.*, tutoring_class_template.*,subject.name as subjectName,module.name as moduleName,user.first_name as student_first_name, user.last_name as student_last_name,user.profile_picture as student_profile_picture FROM tutoring_class,tutoring_class_template,subject,module,user WHERE tutoring_class.class_template_id = tutoring_class_template.id AND tutoring_class_template.subject_id = subject.id AND tutoring_class_template.module_id = module.id AND tutoring_class.student_id = user.id AND student_id = :studentID");
        $this->db->bind(':studentID', $studentID);

        return $this->db->resultAll();
    }


    public function findTutor($tutorId)
    {
        $this->db->query("SELECT * FROM user WHERE id = :tutor_id");

        $this->db->bind(':tutor_id', $tutorId);

        return $this->db->resultOne();
    }

    public function getStudent($studentID) {
        $this->db->query("SELECT student.*,user.* FROM student,user WHERE student.user_id = user.id AND student.user_id = :studentID");
        $this->db->bind(':studentID', $studentID);

        $rows = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getStudentById($studentID) {
        $this->db->query("SELECT * FROM user WHERE id = :studentID");
        $this->db->bind(':studentID', $studentID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }

    // public function getAllTutorialClassesByStudentId($studentID) {
    //     $this->db->query("SELECT * FROM tutoring_class WHERE student_id = :studentID");
    //     $this->db->bind(':studentID', $studentID);

    //     $rows = $this->db->resultAll();

    //     if ($this->db->rowCount() >= 0) {
    //         return $rows;
    //     } else {
    //         return false;
    //     }
    // }



    public function getTutorById($tutorID) {
        $this->db->query("SELECT * FROM user WHERE id = :tutorID");
        $this->db->bind(':tutorID', $tutorID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }


    public function getClassTemplateById($classTemplateID) {
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :classTemplateID");
        $this->db->bind(':classTemplateID', $classTemplateID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }


    public function getSubjectById($subjectID) {
        $this->db->query("SELECT * FROM subject WHERE id = :subjectID");
        $this->db->bind(':subjectID', $subjectID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getModuleById($moduleID) {
        $this->db->query("SELECT * FROM module WHERE id = :moduleID");
        $this->db->bind(':moduleID', $moduleID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllClassDays() {
        $this->db->query("SELECT * FROM day");

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }


    public function getClassDayByTutorialClassId($tutorialClassID) {
        $this->db->query("SELECT * FROM day WHERE class_id = :tutorialClassID");
        $this->db->bind(':tutorialClassID', $tutorialClassID);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getAllTutorialClassesByClassId($classID){
        $this->db->query("SELECT * FROM tutoring_class WHERE id = :classID");
        $this->db->bind(':classID', $classID);

        return $this->db->resultOne();
    }

    public function getClassTemplateByClassTemplateId($classTemplateID){
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :classTemplateID");
        $this->db->bind(':classTemplateID', $classTemplateID);

        return $this->db->resultOne();
    }

    public function getCountActiveTutorialClassesByStudentId($studentID){
        $this->db->query("SELECT * FROM tutoring_class WHERE student_id = :studentID AND completion_status = 0");
        $this->db->bind(':studentID', $studentID);
        $this->db->resultAll();

        return $this->db->rowCount();
    }
        

    public function getCountCompletedTutorialClassesByStudentId($studentID){
        $this->db->query("SELECT * FROM tutoring_class WHERE student_id = :studentID AND completion_status = 1");
        $this->db->bind(':studentID', $studentID);
        $this->db->resultAll();

        return $this->db->rowCount();
    }
        

}
