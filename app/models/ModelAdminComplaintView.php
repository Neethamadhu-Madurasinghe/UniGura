<?php

use React\Dns\Query\RetryExecutor;

class ModelAdminComplaintView
{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }



    public function getStudentComplaints()
    {
        $this->db->query("SELECT student_report.id as studentReportID,student_report.description,student_report.is_inquired,student_report.student_id ,student_report.tutor_id, student_report.tutoring_class_id as tutorClassId,report_reason.description as ReportReason,tutoring_class.* FROM student_report LEFT JOIN report_reason ON student_report.reason_id = report_reason.id  INNER JOIN tutoring_class ON student_report.tutoring_class_id = tutoring_class.class_template_id");
        return $this->db->resultAll();
    }


    public function getTutorComplaints()
    {
        $this->db->query("SELECT tutor_report.id as tutorReportID,tutor_report.description,tutor_report.is_inquired,tutor_report.student_id ,tutor_report.tutor_id, tutor_report.tutoring_class_template_id as tutorClassTemplateId,report_reason.description as ReportReason FROM tutor_report JOIN report_reason ON tutor_report.reason_id = report_reason.id");
        return $this->db->resultAll();
    }


    public function studentReportById($reportID)
    {
        $this->db->query("SELECT student_report.id as studentReportID,student_report.description,student_report.is_inquired,student_report.student_id ,student_report.tutor_id, student_report.tutoring_class_id as tutorClassId,report_reason.*,tutoring_class.* FROM student_report LEFT JOIN report_reason ON student_report.reason_id = report_reason.id  INNER JOIN tutoring_class ON student_report.tutoring_class_id = tutoring_class.id WHERE student_report.id = :report_id");
        $this->db->bind(':report_id', $reportID);
        return $this->db->resultOne();
    }


    public function tutorReportById($reportID)
    {
        $this->db->query("SELECT tutor_report.id as tutorReportID,tutor_report.description,tutor_report.is_inquired,tutor_report.student_id,tutor_report.tutor_id, tutor_report.tutoring_class_template_id as tutorClassTemplateId,report_reason.description as ReportReason,tutoring_class.is_suspended,tutoring_class.completion_status FROM tutor_report LEFT JOIN report_reason ON tutor_report.reason_id = report_reason.id  LEFT JOIN tutoring_class ON tutor_report.tutoring_class_template_id = tutoring_class.class_template_id WHERE tutor_report.id = :report_id");
        $this->db->bind(':report_id', $reportID, PDO::PARAM_INT);
        return $this->db->resultOne();
    }

    public function tutoringClassGetByClassTemplateId($classTemplateID)
    {
        $this->db->query("SELECT * FROM tutoring_class WHERE class_template_id = :classTemplateID");
        $this->db->bind(':classTemplateID', $classTemplateID, PDO::PARAM_INT);
        return $this->db->resultOne();
    }


    public function reportSeasonById($reasonID)
    {
        $this->db->query("SELECT * FROM report_reason WHERE id = :reason_id");
        $this->db->bind(':reason_id', $reasonID, PDO::PARAM_INT);
        return $this->db->resultOne();
    }


    public function userById($userID)
    {
        $this->db->query("SELECT * FROM user WHERE id = :user_id");
        $this->db->bind(':user_id', $userID, PDO::PARAM_INT);
        return $this->db->resultOne();
    }


    public function updateStudentComplainStatus($complainID, $complainStatus)
    {
        $this->db->query("UPDATE student_report SET is_inquired = :status WHERE id=:complain_id");

        $this->db->bind(':status', $complainStatus, PDO::PARAM_INT);
        $this->db->bind(':complain_id', $complainID, PDO::PARAM_INT);


        if ($this->db->execute()) {
            // echo 'Complain status updated';
            return true;
        } else {
            // echo 'Complain status not updated';
            return false;
        }
    }



    public function updateTutorComplainStatus($complainID, $complainStatus)
    {
        $this->db->query("UPDATE tutor_report SET is_inquired = :status WHERE id=:complain_id");

        $this->db->bind(':status', $complainStatus, PDO::PARAM_INT);
        $this->db->bind(':complain_id', $complainID, PDO::PARAM_INT);


        if ($this->db->execute()) {
            // echo 'Complain status updated';
            return true;
        } else {
            // echo 'Complain status not updated';
            return false;
        }
    }


    public function addNotification($userID, $title, $description)
    {
        $this->db->query("INSERT INTO notification (user_id, title,description) VALUES (:user_id,:title,:description)");
        $this->db->bind(':user_id', $userID, PDO::PARAM_INT);
        $this->db->bind(':title', $title, PDO::PARAM_STR);
        $this->db->bind(':description', $description, PDO::PARAM_STR);
        return $this->db->execute();
    }

    public function updateSuspendStatusTutorialClass($tutorClassId, $suspendStatus)
    {
        $this->db->query("UPDATE tutoring_class SET is_suspended = :suspendStatus WHERE id = :tutorClassId");
        $this->db->bind(':tutorClassId', $tutorClassId, PDO::PARAM_INT);
        $this->db->bind(':suspendStatus', $suspendStatus, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function updateSuspendStatusAllClassByClassTemplateById($classTemplateID, $suspendStatus)
    {
        $this->db->query("UPDATE tutoring_class SET is_suspended = :suspendStatus WHERE class_template_id = :classTemplateID");
        $this->db->bind(':classTemplateID', $classTemplateID, PDO::PARAM_INT);
        $this->db->bind(':suspendStatus', $suspendStatus, PDO::PARAM_INT);

        return $this->db->execute();
    }
}
