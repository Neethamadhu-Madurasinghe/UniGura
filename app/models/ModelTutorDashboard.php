<?php

class ModelTutorDashboard
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTutorName($id)
    {
        $this->db->query('SELECT first_name FROM user where id = :id');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $result = $this->db->resultOne();
        return $result;
    }

    public function countTutoringActiveClasses($id)
    {

        $this->db->query(' SELECT COUNT(CASE WHEN completion_status = 0 then 1 END) as active,
        COUNT(CASE WHEN completion_status = 1 THEN 1 END) as complete, COUNT(CASE WHEN completion_status = 2 THEN 1 END)
        as blocked FROM tutoring_class WHERE tutor_id =:id ');

        $this->db->bind('id', $id, PDO::PARAM_STR);

        $result = $this->db->resultOne();

        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }


    public function getModulesBySubjectId($subjectId): array
    {
        $this->db->query('SELECT * FROM module WHERE subject_id=:subject_id AND is_hidden=0');
        $this->db->bind('subject_id', $subjectId, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getVisibleSubjects(bool $onlyWithModules = false)
    {
        $this->db->query('SELECT * FROM subject where is_hidden=0');
        $subjects = $this->db->resultAllAssoc();


        if ($onlyWithModules) {
            $subjects = array_filter($subjects, function ($subject): bool {
                $this->db->query('SELECT * FROM module WHERE subject_id=:subject_id AND is_hidden=0');
                $this->db->bind('subject_id', $subject['id']);


                return count($this->db->resultAllAssoc()) > 0;
            });
        }


        //      array_filter maintains the original array indexes, array_values removes this
        return array_values($subjects);
    }


    public function getTutoringClassDetails($data): int
    {
        $this->db->query(' SELECT tutor_id
        FROM tutoring_class_template
        WHERE tutor_id = :id AND subject_id = :subject_id AND module_id = :module_id AND class_type = :class_type AND medium = :medium;');
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('subject_id', $data['subject_id'], PDO::PARAM_INT);
        $this->db->bind('module_id', $data['module_id'], PDO::PARAM_INT);
        $this->db->bind('class_type', $data['class_type'], PDO::PARAM_STR);
        $this->db->bind('medium', $data['medium'], PDO::PARAM_STR);
        return count($this->db->resultAll());
    }


    public function setTutorclassTemplate($data): bool
    {
        $this->db->query('INSERT INTO  tutoring_class_template SET
                 tutor_id = :id,
                 subject_id = :subject_id,
                 module_id = :module_id,
                 session_rate = :session_rate,
                 class_type = :class_type,
                 mode = :mode,
                 duration = :duration,
                 medium = :medium');

        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('subject_id', $data['subject_id'], PDO::PARAM_INT);
        $this->db->bind('module_id', $data['module_id'], PDO::PARAM_INT);
        $this->db->bind('session_rate', $data['session_rate'], PDO::PARAM_STR);
        $this->db->bind('class_type', $data['class_type'], PDO::PARAM_STR);
        $this->db->bind('mode', $data['mode'], PDO::PARAM_STR);
        $this->db->bind('duration', $data['duration'], PDO::PARAM_STR);
        $this->db->bind('medium', $data['medium'], PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function getTutoringClassTemplates($id): array
    {

        $this->db->query(' SELECT c.current_rating, c.mode, c.medium, m.name as module , s.name as subject, c.id as course_id,
        (SELECT COUNT(*) FROM tutoring_class WHERE class_template_id = c.id) as class_count
        FROM tutoring_class_template AS c
        JOIN subject AS s 
        ON c.subject_id = s.id
        JOIN module AS m 
        ON c.module_id = m.id
        WHERE c.tutor_id = :id;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getStudentRequests($id): array
    {
        $this->db->query(' SELECT r.id , r.class_template_id , r.mode , r.tutor_id , r.student_id , s.name as subject , m.name as module , u.first_name , u.last_name , u.profile_picture , u.id as user_id FROM request AS r JOIN tutoring_class_template AS c ON r.class_template_id = c.id JOIN subject AS s ON c.subject_id = s.id JOIN module AS m ON c.module_id = m.id JOIN user AS u ON r.student_id = u.id WHERE r.tutor_id = :id AND status = 0;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultAllAssoc();
    }

    public function viewStudentRequests($id): array
    {
        $this->db->query(' SELECT r.id as id , r.class_template_id , r.mode , r.location , r.tutor_id , r.student_id, ST_X(r.location) AS longitude, ST_Y(r.location) AS latitude, s.name as subject , m.name as module , u.first_name , u.last_name , u.profile_picture , u.id as user_id ,c.class_type , c.session_rate , c.duration ,c.medium FROM request AS r JOIN tutoring_class_template AS c ON r.class_template_id = c.id JOIN subject AS s ON c.subject_id = s.id JOIN module AS m ON c.module_id = m.id JOIN user AS u ON r.student_id = u.id WHERE r.id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultAllAssoc();
    }

    public function getRequestTimeSlots($id): array
    {
        $this->db->query("SELECT r.id, r.request_id , r.time_slot_id , t.day  , t.time FROM request_time_slot AS r JOIN time_slot AS t ON r.time_slot_id = t.id WHERE r.request_id = :id;");

        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->resultAllAssoc();
    }


    public function getTutorTimeSlots($id): array
    {
        $this->db->query("SELECT 
                COUNT(CASE WHEN state = '1' THEN 1 END) AS active_count,
                COUNT(CASE WHEN state = '2' THEN 1 END) AS working_count
            FROM time_slot WHERE tutor_id = :tutor_id;");

        $this->db->bind('tutor_id', $id, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->resultAll();
    }


    public function setStudentAproveRequest($id) : bool
    {
        $this->db->query('UPDATE request SET status = 1  WHERE id = :id;');
        $this->db->bind('id', $id , PDO::PARAM_INT);

//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function UpdateTutorTimeSlotWithRequest($id) : bool
    {
        $this->db->query('UPDATE time_slot SET state = 2  WHERE id = :id;');
        $this->db->bind('id', $id , PDO::PARAM_INT);

//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function setNewClass($data):bool
    {
        $this->db->query('INSERT INTO  tutoring_class SET
                 class_template_id = :class_template_id,
                 date = :date,
                 time = :time,
                 mode = :mode,
                 student_id = :student_id,
                 tutor_id = :tutor_id,
                 session_rate = :rate,
                 duration = :duration,
                 class_type = :type,
                 medium = :medium');


        $this->db->bind('class_template_id', $data['c_id'], PDO::PARAM_INT);
        $this->db->bind('date', $data['date'], PDO::PARAM_STR);
        $this->db->bind('time', $data['time'], PDO::PARAM_STR);
        $this->db->bind('mode', $data['mode'], PDO::PARAM_STR);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_STR);
        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_STR);
        $this->db->bind('rate', $data['rate'], PDO::PARAM_INT);
        $this->db->bind('duration', $data['duration'], PDO::PARAM_STR);
        $this->db->bind('type', $data['type'], PDO::PARAM_INT);
        $this->db->bind('medium', $data['medium'], PDO::PARAM_INT);



        return $this->db->execute();
    }

    public function getNewlyAddedclass()
    {
        $this->db->query('SELECT id FROM tutoring_class ORDER BY id DESC LIMIT 1;');
        return $this->db->resultOneAssoc();
    }


    public function setDaysofClass($class_id,$data):bool{
        $this->db->query('
        INSERT INTO day (class_id, title, position,day_template_id)
            SELECT :class_id , title , position , id 
            FROM day_template
            WHERE class_template_id = :c_id ;
            ');

        $this->db->bind('c_id', $data['c_id'] , PDO::PARAM_INT);
        $this->db->bind('class_id', $class_id , PDO::PARAM_INT);
        

        return $this->db->execute();
    }

    public function setActivitiesofDay($class_id):bool{
        $this->db->query('
        INSERT INTO activity (day_id, description, type ,link )
        SELECT d.id , a.description , 0 , a.link 
        FROM activity_template as a JOIN day as d on d.day_template_id = a.day_template_id
        WHERE d.class_id = :class_id ;
            ');

        $this->db->bind('class_id', $class_id , PDO::PARAM_INT);
        
        return $this->db->execute();
    }


    public function setClass($data): bool {
        $this->db->startTransaction();

        $this->setNewClass($data);
        $class_id = $this->getNewlyAddedclass();
        $this->setStudentAproveRequest($data['id']);
        $this->setDaysofClass(intval($class_id['id']),$data);
        $this->setActivitiesofDay($class_id['id']);
        $this->UpdateTutorTimeSlotWithRequest($data['time_slot_id']);

        return $this->db->commitTransaction();
    }

    public function declineStudentAproveRequest($id) : bool
    {
        $this->db->query('UPDATE request SET status = 2  WHERE id = :id;');
        $this->db->bind('id', $id , PDO::PARAM_INT);

//      Returns whether the row count is greater than 0
        return $this->db->execute();
    }

    public function paymentUpdate($data) : bool
    {

        $this->db->query('INSERT INTO payment SET day_id =:day_id,student_id = :student_id, tutor_id = :tutor_id , amount = :amount ,timestamp = NOW(), status = 1;');
        $this->db->bind('amount', $data['amount'], PDO::PARAM_INT);
        $this->db->bind('day_id', $data['day_id'], PDO::PARAM_INT);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_INT);
        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_INT);

        return $this->db->execute();
    }
}


