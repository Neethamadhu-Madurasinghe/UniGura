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
        $this->db->query('SELECT c.id as classid , c.mode , c.student_id ,ct.class_type , m.name, u.first_name , u.last_name , u.profile_picture 
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

    public function getsingleclassdetails($id): array
    {
        $this->db->query(' SELECT c.id , c.mode ,c.student_id, ct.class_type , m.name, u.first_name , u.last_name , u.profile_picture 
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


    public function getTutoringClassDays($id): array
    {
        $this->db->query('SELECT position,title, d.id as dayid , dt.id as day_template_id , is_hidden FROM day AS d JOIN day_template AS dt ON dt.id = d.day_temp_id  WHERE class_id = :id ORDER BY dt.position ASC;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function setIshidden($id): bool
    {
        $this->db->query('UPDATE day SET is_hidden = 1  WHERE id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }
}
