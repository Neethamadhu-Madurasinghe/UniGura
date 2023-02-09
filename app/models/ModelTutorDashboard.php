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
        $this->db->bind('medium', $data['medium'], PDO::PARAM_STR);

        return $this->db->execute();
    }

    public function getTutoringClassTemplates($id): array
    {
        $this->db->query(' SELECT c.mode, c.medium, m.name as module , s.name as subject, c.id as course_id
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
        $this->db->query(' SELECT r.id , r.class_template_id , r.mode , r.tutor_id , r.student_id , s.name as subject , m.name as module , u.first_name , u.last_name FROM request AS r JOIN tutoring_class_template AS c ON r.class_template_id = c.id JOIN subject AS s ON c.subject_id = s.id JOIN module AS m ON c.module_id = m.id JOIN user AS u ON r.student_id = u.id WHERE r.tutor_id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
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
}