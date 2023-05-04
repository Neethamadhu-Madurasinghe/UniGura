<?php

class ModelAdminTutor{
    private Database $db;

    public function __construct() {
        $this->db = new Database();
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

    public function getAllTutorialClassesByTutorId($tutorID)
    {
        $this->db->query("SELECT tutoring_class.*, tutoring_class_template.*,subject.name as subjectName,module.name as moduleName,user.first_name as tutor_first_name, user.last_name as tutor_last_name,user.profile_picture as tutor_profile_picture FROM tutoring_class,tutoring_class_template,subject,module,user WHERE tutoring_class.class_template_id = tutoring_class_template.id AND tutoring_class_template.subject_id = subject.id AND tutoring_class_template.module_id = module.id AND tutoring_class.tutor_id = user.id AND user.id = :tutorID");
        $this->db->bind(':tutorID', $tutorID);

        return $this->db->resultAll();
    }



    public function findStudent($studentId)
    {
        $this->db->query("SELECT * FROM user WHERE id = :student_id");

        $this->db->bind(':student_id', $studentId);

        return $this->db->resultOne();
    }



    public function getTutor($tutorID) {
        $this->db->query("SELECT tutor.*,user.* FROM tutor,user WHERE tutor.user_id = user.id AND tutor.user_id = :tutorID");
        $this->db->bind(':tutorID', $tutorID);

        $rows = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
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

    public function getStudentContactDetails($studentID) {
        $this->db->query("SELECT * FROM user WHERE id = :student_id");
        $this->db->bind(':student_id', $studentID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() > 0) {
            return $row;
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

    public function getStudentById($studentID) {
        $this->db->query("SELECT * FROM student WHERE user_id = :studentID");
        $this->db->bind(':studentID', $studentID);

        $rows = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getTutorByUserId($userID) {
        $this->db->query("SELECT * FROM tutor WHERE user_id = :userID");
        $this->db->bind(':userID', $userID);

        $rows = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }


    public function getAllTimeSlotsByTutorId($tutorID) {
        $this->db->query("SELECT * FROM time_slot WHERE tutor_id = :tutorID");
        $this->db->bind(':tutorID', $tutorID);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }
}