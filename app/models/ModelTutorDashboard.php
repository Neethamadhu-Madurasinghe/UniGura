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
        return $this->db->resultOneAssoc();
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

        $this->db->query(' SELECT c.current_rating, c.mode, c.medium, c.session_rate, m.name as module , s.name as subject, c.id as course_id,
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
        $this->db->query(' SELECT r.id , r.class_template_id , r.mode , r.tutor_id , r.student_id , 
        s.name as subject , m.name as module , u.first_name , u.last_name , u.profile_picture , u.id as 
        user_id FROM request AS r JOIN tutoring_class_template AS c ON r.class_template_id = c.id JOIN subject
            AS s ON c.subject_id = s.id JOIN module AS m ON c.module_id = m.id JOIN user AS u ON r.student_id = u.id 
                                                                    WHERE r.tutor_id = :id AND status = 0;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultAllAssoc();
    }

    public function viewStudentRequests($id): array
    {
        $this->db->query(' SELECT r.id as id , r.class_template_id , r.mode, r.tutor_id , r.student_id, 
        ST_X(r.location) AS longitude, ST_Y(r.location) AS latitude, s.name as subject , m.name as module , u.first_name , u.last_name ,
         u.profile_picture , u.id as user_id ,c.class_type , c.session_rate , c.duration ,c.medium FROM request AS r JOIN tutoring_class_template 
         AS c ON r.class_template_id = c.id JOIN subject AS s ON c.subject_id = s.id JOIN module AS m ON c.module_id = m.id 
             JOIN user AS u ON r.student_id = u.id WHERE r.id = :id;');
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

    public function UpdateTutorTimeSlotWithRequest(array $timeSlotIds, $classId) : bool
    {
        foreach ($timeSlotIds as $timeSlotId) {
            $this->db->query('UPDATE time_slot SET state = 2, tutoring_class_id=:classId  WHERE id = :id;');
            $this->db->bind('id', $timeSlotId, PDO::PARAM_INT);
            $this->db->bind('classId', $classId , PDO::PARAM_INT);

            $this->db->execute();
        }
        return true;
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
                 class_type = :class_type,
                 medium = :medium');


        $this->db->bind('class_template_id', $data['c_id'], PDO::PARAM_INT);
        $this->db->bind('date', $data['date'], PDO::PARAM_STR);
        $this->db->bind('time', $data['time'], PDO::PARAM_STR);
        $this->db->bind('mode', $data['mode'], PDO::PARAM_STR);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_STR);
        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_STR);
        $this->db->bind('rate', $data['rate'], PDO::PARAM_INT);
        $this->db->bind('duration', $data['duration'], PDO::PARAM_STR);
        $this->db->bind('class_type', $data['class_type'], PDO::PARAM_STR);
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
        SELECT d.id , a.description , a.type, a.link 
        FROM activity_template as a JOIN day as d on d.day_template_id = a.day_template_id
        WHERE d.class_id = :class_id ;
            ');

        $this->db->bind('class_id', $class_id , PDO::PARAM_INT);
        
        return $this->db->execute();
    }


    public function setClass($data): bool {
        $this->db->startTransaction();
        $classDetails = $this->getPriceAndClassTypeByRequestId($data['id']);
        $data['rate'] = $classDetails['session_rate'];
        $data['class_type'] = $classDetails['class_type'];
        $this->setNewClass($data);
        $class_id = $this->getNewlyAddedclass();
        $this->setStudentAproveRequest($data['id']);
        $this->declineSameTimeSlotRequests($data['time_slot_list'],$data['id']);
        $this->setDaysofClass(intval($class_id['id']),$data);
        $this->setActivitiesofDay($class_id['id']);
        $this->UpdateTutorTimeSlotWithRequest(explode(",", $data['time_slot_list']), $class_id['id']);

        return $this->db->commitTransaction();
    }

//    When the tutor request id is given, this will give the corresponding
//    class template's price and Class type (Revision/theory)
    public function getPriceAndClassTypeByRequestId(int $id): array {
        $this->db->query('
                SELECT tutoring_class_template.* FROM tutoring_class_template 
                JOIN request ON tutoring_class_template.id = request.class_template_id WHERE request.id=:id
            ');

        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultOneAssoc();
    }

    public function declineSameTimeSlotRequests($data,$r_id): bool {
        $success = true;
        $data = explode(",", $data);
        foreach ($data as $id) {
            $this->db->query('UPDATE request r
            INNER JOIN request_time_slot rts ON r.id = rts.request_id
            SET r.status = 2
            WHERE r.id != :r_id AND rts.time_slot_id = :id;');
            $this->db->bind('id', $id, PDO::PARAM_INT);
            $this->db->bind('r_id', $r_id, PDO::PARAM_INT);
            if (!$this->db->execute()) {
                $success = false;
            }
        }
        return $success;
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


    public function getTutorSelectedClassMode($id): array
    {
        $this->db->query('SELECT mode FROM user WHERE id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultOneAssoc();
    }

    public function getAllPaymentDetails($tutorId): array
    {

        $this->db->query('SELECT d.id AS day_id, d.payment_status, d.is_completed, d.timestamp as date , c.id AS class_id , c.session_rate , m.name AS module, u.first_name, u.last_name, u.profile_picture 
        FROM tutoring_class AS c 
        JOIN user AS u ON u.id = c.student_id 
        JOIN tutoring_class_template AS ct ON ct.id = c.class_template_id 
        JOIN module AS m ON ct.module_id = m.id 
        JOIN day AS d ON d.class_id = c.id 
        WHERE c.tutor_id = :tutorId AND d.is_completed = 1 ORDER BY d.timestamp ASC LIMIT 5');


        $this->db->bind('tutorId', $tutorId, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();

    }

    public function getTutoringClasses($id,$today): array
    {
        $this->db->query('SELECT c.id as classid , c.mode , c.student_id , c.session_rate, c.time , c.duration , ct.class_type , m.name, u.first_name , u.last_name , u.profile_picture 
        FROM tutoring_class AS c
        JOIN user AS u 
        ON c.student_id = u.id
        JOIN tutoring_class_template AS ct 
        ON ct.id = c.class_template_id
        Join module AS m 
        ON m.id = ct.module_id
        WHERE c.tutor_id = :id AND c.completion_status = 0 AND c.is_suspended = 0 AND c.date = :today');

        $this->db->bind('id', $id , PDO::PARAM_INT);
        $this->db->bind('today',$today, PDO::PARAM_STR);
        

        return $this->db->resultAll();
    }

}


