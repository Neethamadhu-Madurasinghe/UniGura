<?php

class ModelAdminFilter
{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllStudent()
    {
        $this->db->query("SELECT * FROM student");

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getStudent($studentID)
    {
        $this->db->query("SELECT * FROM student WHERE user_id = :studentID");
        $this->db->bind(':studentID', $studentID);

        $rows = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getStudentById($studentID)
    {
        $this->db->query("SELECT * FROM user WHERE id = :studentID");
        $this->db->bind(':studentID', $studentID);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getActiveTutorialClass($studentID)
    {
        $this->db->query("SELECT * FROM tutoring_class WHERE student_id = :studentID AND completion_status = '0'");
        $this->db->bind(':studentID', $studentID,PDO::PARAM_INT);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getCompletedTutorialClass($studentID)
    {
        $this->db->query("SELECT * FROM tutoring_class WHERE student_id = :studentID AND completion_status = '1'");
        $this->db->bind(':studentID', $studentID,PDO::PARAM_INT);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getTutorById($tutorID)
    {
        $this->db->query("SELECT * FROM user WHERE id = :tutorID");
        $this->db->bind(':tutorID', $tutorID,PDO::PARAM_INT);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }


    public function getClassTemplateById($classTemplateID)
    {
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :classTemplateID");
        $this->db->bind(':classTemplateID', $classTemplateID,PDO::PARAM_INT);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }




    public function getSubjectById($subjectID)
    {
        $this->db->query("SELECT * FROM subject WHERE id = :subjectID");
        $this->db->bind(':subjectID', $subjectID,PDO::PARAM_INT);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getModuleById($moduleID)
    {
        $this->db->query("SELECT * FROM module WHERE id = :moduleID");
        $this->db->bind(':moduleID', $moduleID,PDO::PARAM_INT);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() >= 0) {
            return $row;
        } else {
            return false;
        }
    }


    public function getClassDayByTutorialClassId($tutorialClassID)
    {
        $this->db->query("SELECT * FROM day WHERE class_id = :tutorialClassID");
        $this->db->bind(':tutorialClassID', $tutorialClassID,PDO::PARAM_INT);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }



    public function getAllTutor()
    {
        $this->db->query("SELECT tutor.*, user.* FROM tutor INNER JOIN user ON tutor.user_id = user.id");

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }


    public function getTutorByQuery($sql){
        $this->db->query($sql);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getStudentByQuery($sql){
        $this->db->query($sql);

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }
    

    public function getTutorContactDetails($tutorID)
    {
        $this->db->query("SELECT * FROM user WHERE id = :tutor_id");
        $this->db->bind(':tutor_id', $tutorID,PDO::PARAM_INT);

        $row = $this->db->resultOne();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }



    public function getAllClasses()
    {

        $this->db->query("SELECT tutoring_class.tutor_id as tutorID, tutoring_class.date as date, tutoring_class.time as time, tutoring_class.class_type as class_type, tutoring_class.mode as mode,tutoring_class.session_rate as session_rate,tutoring_class.completion_status as completion_status, tutoring_class.student_id as student_id, tutoring_class_template.*,subject.name as subjectName,module.name as moduleName,user.first_name as student_first_name, user.last_name as student_last_name,user.profile_picture as student_profile_picture, tutoring_class_template.current_rating as currentRating FROM tutoring_class,tutoring_class_template,subject,module,user WHERE tutoring_class.class_template_id = tutoring_class_template.id AND tutoring_class_template.subject_id = subject.id AND tutoring_class_template.module_id = module.id AND tutoring_class.student_id = user.id");

        return $this->db->resultAll();
    }


    public function findStudent($studentId)
    {
        $this->db->query("SELECT * FROM user WHERE id = :student_id");

        $this->db->bind(':student_id', $studentId,PDO::PARAM_INT);

        return $this->db->resultOne();
    }

    public function findTutor($tutorId)
    {
        $this->db->query("SELECT * FROM user WHERE id = :tutor_id");

        $this->db->bind(':tutor_id', $tutorId,PDO::PARAM_INT);

        return $this->db->resultOne();
    }

    public function findClassDay($classId)
    {
        $this->db->query("SELECT * FROM day WHERE class_id = :class_id");

        $this->db->bind(':class_id', $classId,PDO::PARAM_INT);

        return $this->db->resultOne();
    }

    public function findTutoringClassTemplate($classTemplateId)
    {
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :class_template_id");

        $this->db->bind(':class_template_id', $classTemplateId,PDO::PARAM_INT);

        return $this->db->resultOne();
    }

    public function findModule($moduleId)
    {
        $this->db->query("SELECT * FROM module WHERE id = :module_id");

        $this->db->bind(':module_id', $moduleId,PDO::PARAM_INT);

        return $this->db->resultOne();
    }

    public function findSubject($subjectId)
    {
        $this->db->query("SELECT * FROM subject WHERE id = :subject_id");

        $this->db->bind(':subject_id', $subjectId,PDO::PARAM_INT);

        return $this->db->resultOne();
    }

    public function getAllSubjects()
    {
        $this->db->query("SELECT * FROM subject");

        return $this->db->resultAll();
    }



    // For Student Complaint Search & Filter

    public function getStudentComplaints($start, $rowsPerPage)
    {
        $this->db->query("SELECT * FROM student_report LIMIT $start, $rowsPerPage");
        return $this->db->resultAll();
    }

    public function totalNumOfStudentComplaints()
    {
        $this->db->query("SELECT * FROM student_report");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function totalNumOfTutorComplaints()
    {
        $this->db->query("SELECT * FROM tutor_report");
        $this->db->resultAll();
        return $this->db->rowCount();
    }


    public function studentReportById($reportID)
    {
        $this->db->query("SELECT * FROM student_report WHERE id = :report_id");
        $this->db->bind(':report_id', $reportID);
        return $this->db->resultOne();
    }

    public function reportSeasonById($reasonID)
    {
        $this->db->query("SELECT * FROM report_reason WHERE id = :reason_id");
        $this->db->bind(':reason_id', $reasonID);
        return $this->db->resultOne();
    }



    // For Tutor Complaint Search & Filter

    public function getTutorComplaints($start, $rowsPerPage)
    {
        $this->db->query("SELECT * FROM tutor_report LIMIT $start, $rowsPerPage");
        return $this->db->resultAll();
    }


    public function tutorReportById($reportID)
    {
        $this->db->query("SELECT * FROM tutor_report WHERE id = :report_id");
        $this->db->bind(':report_id', $reportID);
        return $this->db->resultOne();
    }


    public function userById($userID)
    {
        $this->db->query("SELECT * FROM user WHERE id = :user_id");
        $this->db->bind(':user_id', $userID);
        return $this->db->resultOne();
    }
}
