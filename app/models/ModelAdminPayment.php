<?php

class ModelAdminPayment
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function allUniquePayoffTutors()
    {
        $this->db->query("SELECT `tutor_id`,`is_withdrawed` FROM `payment` GROUP BY `tutor_id`,`is_withdrawed`");
        return $this->db->resultAll();
    }

    public function allPaymentDetails()
    {
        $this->db->query("SELECT payment.*,withdrawal.* FROM payment LEFT JOIN withdrawal ON payment.withdrawal_slip = withdrawal.id");
        return $this->db->resultAll();
    }

    public function getAllClassDaysByTutorId($tutorId)
    {
        $this->db->query("SELECT payment.*, day.*,tutoring_class.*,tutoring_class_template.* FROM payment INNER JOIN day ON payment.day_id = day.id INNER JOIN tutoring_class ON day.class_id = tutoring_class.id INNER JOIN tutoring_class_template ON tutoring_class.class_template_id = tutoring_class_template.id  WHERE payment.tutor_id = :id AND payment.is_withdrawed = 0");
        $this->db->bind(':id', $tutorId,PDO::PARAM_INT);
        return $this->db->resultAll();
    }



    public function getTutorById($tutorId)
    {
        $this->db->query("SELECT * FROM user WHERE id = :id");
        $this->db->bind(':id', $tutorId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }

    public function selectedTutorDetails($tutorId)
    {
        $this->db->query("SELECT * FROM tutor WHERE user_id = :id");
        $this->db->bind(':id', $tutorId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }

    public function getAllClassesByTutorId($tutorId)
    {
        $this->db->query("SELECT * FROM tutoring_class WHERE tutor_id = :id");
        $this->db->bind(':id', $tutorId,PDO::PARAM_INT);
        return $this->db->resultAll();
    }


    public function getClassTemplateDetailsByClassTemplateId($classTemplateId)
    {
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :id");
        $this->db->bind(':id', $classTemplateId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }



    public function selectedTutorBankDetails($tutorId)
    {
        $this->db->query('SELECT * FROM tutor WHERE user_id = :tutor_id');
        $this->db->bind(':tutor_id', $tutorId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }


    public function paymentDetailsByTutorId($tutorId)
    {
        $this->db->query("SELECT * FROM payment WHERE tutor_id = :id");
        $this->db->bind(':id', $tutorId,PDO::PARAM_INT);
        return $this->db->resultAll();
    }

    public function classDayByDayId($classId)
    {
        $this->db->query("SELECT * FROM day WHERE id = :id");
        $this->db->bind(':id', $classId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }

    public function getStudentById($studentId)
    {
        $this->db->query("SELECT * FROM user WHERE id = :id");
        $this->db->bind(':id', $studentId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }

    public function getTutorialClassByClassId($classId)
    {
        $this->db->query("SELECT * FROM tutoring_class WHERE id = :id");
        $this->db->bind(':id', $classId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }

    public function getClassTemplateByClassTemplateId($classTemplateId)
    {
        $this->db->query("SELECT * FROM tutoring_class_template WHERE id = :id");
        $this->db->bind(':id', $classTemplateId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }

    public function getSubjectBySubjectId($subjectId)
    {
        $this->db->query("SELECT * FROM subject WHERE id = :id");
        $this->db->bind(':id', $subjectId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }

    public function getModuleByModuleId($moduleId)
    {
        $this->db->query("SELECT * FROM module WHERE id = :id");
        $this->db->bind(':id', $moduleId,PDO::PARAM_INT);
        return $this->db->resultOne();
    }



    public function insertTutorWithdrawalDetails($slipPath)
    {
        $this->db->query("INSERT INTO withdrawal (slip,time) VALUES (:slipPath,NOW())");
        $this->db->bind(':slipPath', $slipPath);
        $this->db->execute();
    }


    public function getTutorWithdrawalDetailID($slipPath)
    {
        $this->db->query("SELECT * FROM withdrawal WHERE slip = :slipPath");
        $this->db->bind(':slipPath', $slipPath);
        return $this->db->resultOne();
    }

    public function updateTutorWithdrawalDetails($tutorId, $withdrawalSlipID)
    {
        $this->db->query("UPDATE payment SET is_withdrawed = :withdrawalStatus , withdrawal_day = NOW() , withdrawal_slip = :withdrawalSlipID WHERE tutor_id = :tutorId AND is_withdrawed = 0");
        $this->db->bind(':withdrawalStatus', 1);
        $this->db->bind(':withdrawalSlipID', $withdrawalSlipID,PDO::PARAM_INT);
        $this->db->bind(':tutorId', $tutorId);
        $this->db->execute();
    }
}
