<?php

class ModelTutorPayment
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPaymentDetails($tutorId): array
    {
        $this->db->query('SELECT d.id AS day_id, d.payment_status, d.is_completed, d.Date , c.id AS class_id , c.rate , m.name AS module, u.first_name, u.last_name, u.profile_picture 
        FROM tutoring_class AS c 
        JOIN user AS u ON u.id = c.student_id 
        JOIN tutoring_class_template AS ct ON ct.id = c.class_template_id 
        JOIN module AS m ON ct.module_id = m.id 
        JOIN day AS d ON d.class_id = c.id 
        Join 
        WHERE c.tutor_id = :tutorId AND d.is_completed = 1 ORDER BY d.timestamp ASC');

        $this->db->bind('tutorId', $tutorId, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getFilteredPayments($tutorId,$startDate,$endDate){

        $this->db->query('SELECT d.id AS day_id, d.payment_status, d.is_completed, d.Date , c.id AS class_id , c.rate , m.name AS module, u.first_name, u.last_name, u.profile_picture 
        FROM tutoring_class AS c 
        JOIN user AS u ON u.id = c.student_id 
        JOIN tutoring_class_template AS ct ON ct.id = c.class_template_id 
        JOIN module AS m ON ct.module_id = m.id 
        JOIN day AS d ON d.class_id = c.id 
        WHERE c.tutor_id = :tutorId AND d.is_completed = 1 AND (d.Date BETWEEN :start_date AND :end_date) ORDER BY d.Timestamp ASC');

        $this->db->bind(':start_date', $startDate, PDO::PARAM_STR);
        $this->db->bind(':end_date', $endDate, PDO::PARAM_STR);
        $this->db->bind(':tutorId', $tutorId, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getMonthlyPaymentStatus($tutorId): array
    {
        $this->db->query("SELECT SUM(CASE WHEN payment_status = 0 THEN c.rate ELSE 0 END) AS Pending, SUM(CASE WHEN payment_status = 1 OR payment_status = 2 THEN c.rate ELSE 0 END) AS Earns FROM tutoring_class AS c JOIN day AS d ON d.class_id = c.id WHERE MONTH(d.Date) = MONTH(CURRENT_DATE()) AND YEAR(d.Date) = YEAR(CURRENT_DATE()) AND c.tutor_id = :tutorId ;");

        $this->db->bind(':tutorId', $tutorId, PDO::PARAM_INT);

        $this->db->execute();
        return $this->db->resultAllAssoc();
    }

    public function getPaymentsByMonth($tutorId): array
    {
        $this->db->query("SELECT 
        SUM(CASE WHEN MONTH(d.Date) = '1' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS JAN, 
        SUM(CASE WHEN MONTH(d.Date) = '2' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS FEB,
        SUM(CASE WHEN MONTH(d.Date) = '3' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS MAR,
        SUM(CASE WHEN MONTH(d.Date) = '4' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS APR,
        SUM(CASE WHEN MONTH(d.Date) = '5' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS MAY,
        SUM(CASE WHEN MONTH(d.Date) = '6' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS JUN,
        SUM(CASE WHEN MONTH(d.Date) = '7' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS JUL,
        SUM(CASE WHEN MONTH(d.Date) = '8' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS AUG,
        SUM(CASE WHEN MONTH(d.Date) = '9' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS SEP,
        SUM(CASE WHEN MONTH(d.Date) = '10' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS OCT,
        SUM(CASE WHEN MONTH(d.Date) = '11' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS NOV,
        SUM(CASE WHEN MONTH(d.Date) = '12' AND YEAR(d.Date) =  YEAR(CURRENT_DATE()) THEN c.rate ELSE 0 END) AS DECE
        FROM tutoring_class AS c JOIN day AS d ON d.class_id = c.id WHERE c.tutor_id =:tutorId;");
        $this->db->bind(':tutorId', $tutorId, PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->resultAllAssoc();
    }
}
