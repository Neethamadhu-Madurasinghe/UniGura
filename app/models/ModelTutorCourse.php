<?php

class ModelTutorCourse
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }


public function setClassTemplateDay($data): bool
    {
        $this->db->query('INSERT INTO  day_template SET
                 class_template_id = :id,
                 title = :title,
                 position = :position'
                 );

        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('title', $data['title'], PDO::PARAM_STR);
        $this->db->bind('position', $data['position'], PDO::PARAM_STR);

        return $this->db->execute();
    }


    public function getTutoringClassTemplateDays($id): array
    {
        $this->db->query('SELECT * FROM day_template  WHERE class_template_id = :id ORDER BY position ASC;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getActivities($id): array
    {
        $this->db->query('SELECT a.id , a.day_template_id , a.description, a.type , a.link FROM activity_template AS a JOIN day_template as d ON d.id = a.day_template_id WHERE d.class_template_id = :id ;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultAllAssoc();
    }

    public function getDayCounts($id): int
    {
        $this->db->query(' SELECT id FROM day_template
        WHERE class_template_id = :id ');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return count($this->db->resultAll());
    }

    public function getTutoringClassTemplateDetails($id): array
    {
        $this->db->query('SELECT * FROM tutoring_class_template WHERE id = :id;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getSubjectName($id) : array
    {
        $this->db->query(' SELECT name as subject 
        FROM subject 
        WHERE id = :id;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getModuleName($id) : array
    {
        $this->db->query(' SELECT name as module 
        FROM module
        WHERE id = :id;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function findDayByName(String $name,$c_id): bool {
        $this->db->query('SELECT * FROM day_template WHERE title=:name and class_template_id = :c_id');
        $this->db->bind('name', $name, PDO::PARAM_STR);
        $this->db->bind('c_id', $c_id, PDO::PARAM_INT);

        $this->db->resultOne();

//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 0;
    }

    public function findDayPosition(String $name, String $cls_temp_id): bool {
        $this->db->query('SELECT * FROM day_template WHERE position=:name AND class_template_id =:id');
        $this->db->bind('name', $name, PDO::PARAM_STR);
        $this->db->bind('id', $cls_temp_id, PDO::PARAM_INT);

        $this->db->resultOne();

//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 1;
    }

    public function setDayPosition($data): bool
    {

        foreach ($data as $key => $value) {
            $this->db->query("UPDATE day_template SET position = :position WHERE id = :id");
            $this->db->bind('position',$value, PDO::PARAM_INT);
            $this->db->bind('id', $key, PDO::PARAM_STR);
            $this->db->execute();  
          }
        return 1;
    }

    public function updateClassTemplate($data) : bool 
    {

        $this->db->query('UPDATE tutoring_class_template SET session_rate = :session_rate , mode = :mode , duration = :duration   WHERE id = :id;');
        $this->db->bind('session_rate', $data['session_rate'], PDO::PARAM_STR);
        $this->db->bind('mode', $data['mode'], PDO::PARAM_STR);
        $this->db->bind('duration', $data['duration'], PDO::PARAM_STR);
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);

//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function deleteClassTemplate($id) : bool 
    {

        $this->db->query('DELETE FROM tutoring_class_template WHERE id = :id;');
        $this->db->bind('id',$id, PDO::PARAM_INT);

//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function setActivityTemplate($data): bool {
        $this->db->query('INSERT INTO activity_template SET
                 day_template_id = :id,
                 link = :link,
                 type = :type,
                 description = :description');

        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('description', $data['description'], PDO::PARAM_STR);
        $this->db->bind('link', $data['activity'], PDO::PARAM_STR);
        $this->db->bind('type', $data['type'], PDO::PARAM_STR);

        return $this->db->execute();
    }

    public function getDayTemplateDetails($id): array
    {
        $this->db->query('SELECT * FROM day_template WHERE id = :id;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }


    public function updateDayTemplate($data) : bool 
    {

        $this->db->query('UPDATE day_template SET title = :title  WHERE id = :id;');
        $this->db->bind('title', $data['title'], PDO::PARAM_STR);
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);


//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function deleteDayTemplate($id) : bool 
    {

        $this->db->query('DELETE FROM day_template WHERE id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);

//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }
    
    public function changeClassTemplateStatus($id,$is_hidden) : bool 
    {
        $this->db->query('UPDATE tutoring_class_template SET is_hidden = :is_hidden WHERE id = :c_id ;');
        $this->db->bind(':c_id', $id, PDO::PARAM_INT);
        $this->db->bind(':is_hidden', $is_hidden, PDO::PARAM_INT);
//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function deleteActivityTemplate($id) : bool 
    {

        $this->db->query('DELETE FROM activity_template WHERE id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);

//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function getOnlineAndPhysicalClassesByTutorId($id): array {
        $classes = [
            "number_of_online_classes" => [],
            "number_of_physical_classes" => [],
        ];
        $this->db->query("SELECT * FROM tutoring_class_template WHERE 
                                              tutor_id = :id AND 
                                              is_hidden = 0 AND 
                                              mode='online'");

        $this->db->bind('id', $id, PDO::PARAM_INT);
        $classes['number_of_online_classes'] = $this->db->resultAllAssoc();

        $this->db->query("SELECT * FROM tutoring_class_template WHERE 
                                              tutor_id = :id AND 
                                              is_hidden = 0 AND 
                                              mode='physical'");

        $this->db->bind('id', $id, PDO::PARAM_INT);
        $classes['number_of_physical_classes'] = $this->db->resultAllAssoc();

        return $classes;

    }
}