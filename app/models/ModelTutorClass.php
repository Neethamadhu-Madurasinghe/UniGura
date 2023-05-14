<?php

class ModelTutorClass
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }



    public function getTutoringClasses($id,$data): array
    {
        $this->db->query('SELECT c.id as classid , c.mode , c.student_id ,ct.class_type , m.name, u.first_name , u.last_name , u.profile_picture 
        FROM tutoring_class AS c
        JOIN user AS u 
        ON c.student_id = u.id
        JOIN tutoring_class_template AS ct 
        ON ct.id = c.class_template_id
        Join module AS m 
        ON m.id = ct.module_id
        WHERE c.tutor_id = :id AND c.completion_status = :completion_status AND c.is_suspended = :is_suspended');

        $this->db->bind('id', $id , PDO::PARAM_INT);
        $this->db->bind('completion_status', $data['completion_status'] , PDO::PARAM_INT);
        $this->db->bind('is_suspended', $data['is_suspended'] , PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getsingleclassdetails($id): array
    {
        $this->db->query(' SELECT c.id , c.mode ,c.date, c.time ,c.student_id, ct.class_type , m.name, u.first_name , u.last_name , u.profile_picture 
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
        $this->db->query('SELECT position, title, id as dayid , day_template_id , is_hidden , is_completed , payment_status FROM day WHERE class_id = :id ORDER BY position ASC;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultAllAssoc();
    }

    public function getActivities($id): array
    {
        $this->db->query('SELECT a.id , a.day_id, a.description, a.is_completed , a.type, a.link FROM activity AS a JOIN day as d ON d.id = a.day_id WHERE d.class_id = :id ORDER BY a.type ASC;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultAllAssoc();
    }

    public function setIshidden($id): bool
    {
        $this->db->query('UPDATE day SET is_hidden = 1  WHERE id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function finishclass($id): bool
    {
        $this->db->query('UPDATE tutoring_class SET completion_status = 1  WHERE id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }
    
    public function setActivity($data): bool {
        $this->db->query('INSERT INTO activity SET
                 day_id = :id,
                 link = :link,
                 type = :type,
                 description = :description');


        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('description', $data['description'], PDO::PARAM_STR);
        $this->db->bind('link', $data['link'], PDO::PARAM_STR);
        $this->db->bind('type', $data['type'], PDO::PARAM_STR);

        return $this->db->execute();
    }

    public function markDayAsHiden($id) : bool 
    {
        $this->db->query('UPDATE day SET is_hidden = 1 WHERE id = :id ;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function markDayAsUnHiden($id) : bool 
    {
        $this->db->query('UPDATE day SET is_hidden = 0 WHERE id = :id ;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function markDayAsComplete($id) : bool 
    {
        $this->db->query('UPDATE day SET is_completed = 1 UPDATE day SET payment_status=1 , timestamp = NOW() WHERE id = :id ;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }



    public function setClassDay($data): bool
    {
        $this->db->query('INSERT INTO  day SET
                 class_id = :id,
                 title = :title, 
                 position = :position'
                 );

        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('title', $data['title'], PDO::PARAM_STR);
        $this->db->bind('position', $data['position'], PDO::PARAM_STR);

        return $this->db->execute();
    }

    public function getDayCounts($id): int
    {
        $this->db->query(' SELECT * FROM day
        WHERE class_id = :id ');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return count($this->db->resultAll());
    }

    public function findDayByName(String $name,$c_id): bool {
        $this->db->query('SELECT * FROM day WHERE title=:name and class_id = :c_id');
        $this->db->bind('name', $name, PDO::PARAM_STR);
        $this->db->bind('c_id', $c_id, PDO::PARAM_INT);

        $this->db->resultOne();

//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 0;
    }

    public function setDayPosition($data): bool
    {

        foreach ($data as $key => $value) {
            $this->db->query("UPDATE day SET position = :position WHERE id = :id");
            $this->db->bind('position',$value, PDO::PARAM_INT);
            $this->db->bind('id', $key, PDO::PARAM_STR);
            $this->db->execute();  
          }
        return 1;
    }
}
