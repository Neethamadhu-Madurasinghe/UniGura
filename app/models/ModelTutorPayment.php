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
        WHERE c.tutor_id = :tutorId AND d.is_completed = 1 ORDER BY d.Timestamp ASC');

        $this->db->bind('tutorId', $tutorId, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }
}
