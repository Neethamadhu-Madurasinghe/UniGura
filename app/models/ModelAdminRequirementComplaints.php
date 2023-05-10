<?php

class ModelAdminRequirementComplaints
{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getStudentComplaints($start, $rowsPerPage)
    {
        $this->db->query("SELECT student_report.id as studentReportID,student_report.description,student_report.is_inquired,student_report.student_id ,student_report.tutor_id,report_reason.* FROM student_report LEFT JOIN report_reason ON student_report.reason_id = report_reason.id LIMIT $start, $rowsPerPage");
        return $this->db->resultAll();
    }

    public function getTutorComplaints($start, $rowsPerPage)
    {
        $this->db->query("SELECT * FROM tutor_report LIMIT $start, $rowsPerPage");
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


    public function totalNumOfTutorRequest()
    {
        $this->db->query("SELECT * FROM tutor WHERE is_approved = 0 ");
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

    public function userById($userID)
    {
        $this->db->query("SELECT * FROM user WHERE id = :user_id");
        $this->db->bind(':user_id', $userID);
        return $this->db->resultOne();
    }





    public function tutorReportById($reportID)
    {
        $this->db->query("SELECT * FROM tutor_report WHERE id = :report_id");
        $this->db->bind(':report_id', $reportID);
        return $this->db->resultOne();
    }

    public function reportReasonById($reasonID)
    {
        $this->db->query("SELECT * FROM report_reason WHERE id = :reason_id");
        $this->db->bind(':reason_id', $reasonID);
        return $this->db->resultOne();
    }


    public function getTutorRequest()
    {
        $this->db->query("SELECT tutor.*,user.* FROM tutor INNER JOIN user ON tutor.user_id = user.id");
        return $this->db->resultAll();
    }



    public function getStudentComplaintReason()
    {
        $this->db->query("SELECT * FROM report_reason WHERE is_for_tutor = 0");
        return $this->db->resultAll();
    }

    public function getTutorComplaintReason()
    {
        $this->db->query("SELECT * FROM report_reason WHERE is_for_tutor = 1");
        return $this->db->resultAll();
    }



    public function addStudentComplainReason($description)
    {
        $this->db->query("INSERT INTO report_reason(is_for_tutor, description) VALUES (0, :description)");

        $this->db->bind(':description', $description);
        return $this->db->execute();
    }

    public function addTutorComplainReason($description)
    {
        $this->db->query("INSERT INTO report_reason (is_for_tutor, description) VALUES (1, :description)");

        $this->db->bind(':description', $description);
        return $this->db->execute();
    }

    public function updateStudentComplainReason($reasonID, $description)
    {
        $this->db->query("UPDATE report_reason SET description = :description WHERE id = :reason_id");

        $this->db->bind(':reason_id', $reasonID);
        $this->db->bind(':description', $description);
        return $this->db->execute();
    }

    public function updateTutorComplainReason($reasonID, $description)
    {
        $this->db->query("UPDATE report_reason SET description = :description WHERE id = :reason_id");

        $this->db->bind(':reason_id', $reasonID);
        $this->db->bind(':description', $description);
        return $this->db->execute();
    }


    public function deleteComplaint($reasonID)
    {
        try {
            $this->db->query("DELETE FROM report_reason WHERE id = :reason_id");
            $this->db->bind(':reason_id', $reasonID);
            $this->db->execute();
            return "";
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                return 'Foreign key constraint failed';
            } else {
                return 'Error: ' . $e->getMessage();
            }
        }
    }




    public function acceptTutorRequest($tutorID)
    {
        $this->db->query("UPDATE tutor SET is_approved = 1 WHERE user_id = :tutor_id");
        $this->db->bind(':tutor_id', $tutorID);
        return $this->db->execute();
    }

    public function rejectTutorRequest($tutorID)
    {
        $this->db->query("UPDATE tutor SET is_approved = 2 WHERE user_id = :tutor_id");
        $this->db->bind(':tutor_id', $tutorID,PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function addNotification($userID, $title, $description)
    {
        $this->db->query("INSERT INTO notification (user_id, title,description) VALUES (:user_id,:title,:description)");
        $this->db->bind(':user_id', $userID,PDO::PARAM_INT);
        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        return $this->db->execute();
    }
}
