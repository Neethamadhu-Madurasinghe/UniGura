<?php

class ModelDashboard {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getSubjects():array {
        $this->db->query('SELECT * FROM subject');

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getModule($subject_id){
        $this->db->query("SELECT * FROM module WHERE subject_id=$subject_id");

        $rows = $this->db->resultAll();
        
        if ($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getTutoringClasses($id): array
    {
        $this->db->query('SELECT c.id as classid , c.mode , c.student_id ,ct.class_type , m.name, u.first_name , u.last_name , u.profile_picture 
        FROM tutoring_class AS c
        JOIN user AS u 
        ON c.student_id = u.id
        JOIN tutoring_class_template AS ct 
        ON ct.id = c.class_template_id
        Join module AS m 
        ON m.id = ct.module_id
        WHERE c.tutor_id = :id AND c.completion_status = 0 AND c.is_suspended = 0');

        $this->db->bind('id', $id , PDO::PARAM_INT);
        

        return $this->db->resultAllAssoc();
    }

}