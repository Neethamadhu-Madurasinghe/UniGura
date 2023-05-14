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

        $this->db->query('SELECT d.id AS day_id, d.payment_status, d.is_completed, d.timestamp as date , c.id AS class_id , c.session_rate , m.name AS module, u.first_name, u.last_name, u.profile_picture 
        FROM tutoring_class AS c 
        JOIN user AS u ON u.id = c.student_id 
        JOIN tutoring_class_template AS ct ON ct.id = c.class_template_id 
        JOIN module AS m ON ct.module_id = m.id 
        JOIN day AS d ON d.class_id = c.id 
        WHERE c.tutor_id = :tutorId AND d.is_completed = 1 ORDER BY d.timestamp ASC');


        $this->db->bind('tutorId', $tutorId, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }


    public function getFilteredPayments($tutorId,$startDate,$endDate){

        $this->db->query('SELECT d.id AS day_id, d.payment_status, d.is_completed, d.timestamp as date , c.id AS class_id , c.session_rate , m.name AS module, u.first_name, u.last_name, u.profile_picture FROM tutoring_class AS c JOIN user AS u ON u.id = c.student_id JOIN tutoring_class_template AS ct ON ct.id = c.class_template_id JOIN module AS m ON ct.module_id = m.id JOIN day AS d ON d.class_id = c.id WHERE c.tutor_id = :tutorId AND d.is_completed = 1 AND (d.timestamp BETWEEN :start_date AND :end_date) ORDER BY d.Timestamp ASC;');

        $this->db->bind(':start_date', $startDate, PDO::PARAM_STR);
        $this->db->bind(':end_date', $endDate, PDO::PARAM_STR);
        $this->db->bind(':tutorId', $tutorId, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getMonthlyPaymentStatus($tutorId): array
    {
        $this->db->query("SELECT SUM(CASE WHEN payment_status = 0 AND is_completed = 1 THEN c.session_rate ELSE 0 END) AS Pending, SUM(CASE WHEN payment_status = 1 AND is_completed = 1  THEN c.session_rate ELSE 0 END) AS Earns FROM tutoring_class AS c JOIN day AS d ON d.class_id = c.id WHERE c.tutor_id = :tutorId ;");
        $this->db->bind(':tutorId', $tutorId, PDO::PARAM_INT);

        $this->db->execute();
        return $this->db->resultAllAssoc();
    }

    
    public function getPaymentsByMonth($tutorId): array
    {
        $this->db->query("SELECT 
        SUM(CASE WHEN MONTH(Timestamp) = '1' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS JAN, 
        SUM(CASE WHEN MONTH(Timestamp) = '2' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS FEB,
        SUM(CASE WHEN MONTH(Timestamp) = '3' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS MAR,
        SUM(CASE WHEN MONTH(Timestamp) = '4' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS APR,
        SUM(CASE WHEN MONTH(Timestamp) = '5' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS MAY,
        SUM(CASE WHEN MONTH(Timestamp) = '6' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS JUN,
        SUM(CASE WHEN MONTH(Timestamp) = '7' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS JUL,
        SUM(CASE WHEN MONTH(Timestamp) = '8' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS AUG,
        SUM(CASE WHEN MONTH(Timestamp) = '9' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS SEP,
        SUM(CASE WHEN MONTH(Timestamp) = '10' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS OCT,
        SUM(CASE WHEN MONTH(Timestamp) = '11' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS NOV,
        SUM(CASE WHEN MONTH(Timestamp) = '12' AND YEAR(Timestamp) =  YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS DECE
        FROM payment  WHERE tutor_id =:tutorId;");
        $this->db->bind(':tutorId', $tutorId, PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->resultAllAssoc();
    }
}
