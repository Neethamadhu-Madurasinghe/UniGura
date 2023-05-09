<?php

class ModelAdminComplaintView
{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getStudentComplaints()
    {
        $this->db->query("SELECT * FROM student_report");
        return $this->db->resultAll();
    }

    public function getTutorComplaints()
    {
        $this->db->query("SELECT * FROM tutor_report");
        return $this->db->resultAll();
    }

    public function studentReportById($reportID)
    {
        $this->db->query("SELECT * FROM student_report WHERE id = :report_id");
        $this->db->bind(':report_id', $reportID);
        return $this->db->resultOne();
    }

    public function tutorReportById($reportID)
    {
        $this->db->query("SELECT * FROM tutor_report WHERE id = :report_id");
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
        $this->db->bind(':user_id', $userID);
        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        return $this->db->execute();
    }
}
