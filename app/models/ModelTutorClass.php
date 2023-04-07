<?php

class ModelTutorClass
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }



    public function getTutoringClasses($id): array
    {

        $this->db->query(' SELECT c.id as classid , c.mode , ct.class_type , m.name, u.first_name , u.last_name , u.profile_picture 
        FROM tutoring_class AS c
        JOIN user AS u 
        ON c.student_id = u.id
        JOIN tutoring_class_template AS ct 
        ON ct.id = c.class_template_id
        Join module AS m 
        ON m.id = ct.module_id
        WHERE c.tutor_id = :id;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getsingleclassdetails($id):array 
    {
        $this->db->query(' SELECT c.id , c.mode , ct.class_type , m.name, u.first_name , u.last_name , u.profile_picture 
        FROM tutoring_class AS c
        JOIN user AS u 
        ON c.student_id = u.id
        JOIN tutoring_class_template AS ct 
        ON ct.id = c.class_template_id
        Join module AS m 
        ON m.id = ct.module_id
        WHERE c.id = :id;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }
}
