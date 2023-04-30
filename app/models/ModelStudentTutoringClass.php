<?php
class ModelStudentTutoringClass {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTutoringClassByStudentId($studentId): array {
        $this->db->query('SELECT * FROM tutoring_class WHERE student_id=:student_id');
        $this->db->bind('student_id', $studentId, PDO::PARAM_INT);

//        Fetch all the records as an array of objects and covert it into an array of associative arrays
        $rows = json_decode(json_encode($this->db->resultAll()), true);

        if (!$rows) { return $rows; }

//        After fetching tutoring classes, fetch the first name, last name and profile picture of each class's tutor
//        Also do the same to  subject name and module name

        foreach ($rows as $key => $value) {
//            Fetch tutor
            $this->db->query('SELECT first_name, last_name, profile_picture FROM user WHERE id=:id');
            $this->db->bind('id', $value['tutor_id'], PDO::PARAM_INT);
            $tutor = $this->db->resultOne();
            $rows[$key]['tutor'] = json_decode(json_encode($tutor), true);

//            Fetch subject
            $this->db->query('
                SELECT subject.id as id, subject.name as name FROM tutoring_class_template JOIN subject ON
                tutoring_class_template.subject_id = subject.id WHERE tutoring_class_template.id = :template_id
                ');

            $this->db->bind('template_id', $value['class_template_id'], PDO::PARAM_INT);
            $subject = json_decode(json_encode($this->db->resultOne()), true);
            $rows[$key]['subject'] = $subject;

//            Fetch Module
            $this->db->query('
                SELECT module.id as id, module.name as name FROM tutoring_class_template JOIN module ON
                tutoring_class_template.module_id = module.id WHERE tutoring_class_template.id = :template_id
            ');

            $this->db->bind('template_id', $value['class_template_id'], PDO::PARAM_INT);
            $module = json_decode(json_encode($this->db->resultOne()), true);
            $rows[$key]['module'] = $module;

//           Fetch all the days
            $this->db->query('
                SELECT COUNT(day.id) as day_count FROM tutoring_class JOIN day ON
                tutoring_class.id= day.class_id WHERE tutoring_class.id=:id'
            );

            $this->db->bind('id', $value['id'], PDO::PARAM_INT);
            $dayCount = $this->db->resultOne();
            $rows[$key]['day_count'] = $dayCount->day_count;

//           Fetch all the incomplete days
            $this->db->query('
                SELECT COUNT(day.id) as incomplete_day_count FROM tutoring_class JOIN day ON
                tutoring_class.id= day.class_id WHERE tutoring_class.id=:id AND day.is_completed = 1'
            );

            $this->db->bind('id', $value['id'], PDO::PARAM_INT);
            $incompleteDayCount = $this->db->resultOne();
            $rows[$key]['incomplete_day_count'] = $incompleteDayCount->incomplete_day_count;

//           Payment due
            $this->db->query('
                SELECT COUNT(day.id) as payment_due_day_count FROM tutoring_class JOIN day ON
                tutoring_class.id= day.class_id WHERE tutoring_class.id=:id AND day.payment_status = 1'
            );

            $this->db->bind('id', $value['id'], PDO::PARAM_INT);
            $paymentDueDayCount = $this->db->resultOne();
            $rows[$key]['payment_due_day_count'] = $paymentDueDayCount->payment_due_day_count;


        }
        return $rows;
    }

//    Returns all the details related to a tutoring class (Not a course) when the id is given
    public function getFullTutoringClassDetails(int $id): array {

//        Get the all the data from tutoring class table
        $this->db->query('SELECT * FROM tutoring_class WHERE id=:id AND is_suspended=0');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $tutoring_class = $this->db->resultOneAssoc();

        if (!isset($tutoring_class['id'])) {
            return [];
        }

//        Get relevant template and tutor data
        $this->db->query('SELECT * FROM tutoring_class_tutor WHERE id=:id');
        $this->db->bind('id', $tutoring_class['class_template_id'], PDO::PARAM_INT);
        $tutoring_class_tutor = $this->db->resultOneAssoc();

        if (!isset($tutoring_class_tutor['id'])) {
            return [];
        }

        $tutoring_class['tutor_name'] = $tutoring_class_tutor['first_name'] . ' ' . $tutoring_class_tutor['last_name'];
        $tutoring_class['subject_name'] = $tutoring_class_tutor['subject_name'];
        $tutoring_class['module_name'] = $tutoring_class_tutor['module_name'];

//        Get days
        $this->db->query('SELECT * FROM day WHERE class_id=:id AND is_hidden=0 ORDER BY position asc');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $days = $this->db->resultAllAssoc();

        $tutoring_class['days'] = $days;

//        Get activities for each day
        foreach ($tutoring_class['days'] as $key => $day) {
            $this->db->query('SELECT * FROM activity WHERE day_id=:day_id AND is_hidden=0 ORDER BY position asc');
            $this->db->bind('day_id', $day['id'], PDO::PARAM_INT);
            $activities = $this->db->resultAllAssoc();

            $tutoring_class['days'][$key]['activities'] = $activities;
        }

        return $tutoring_class;
    }
}
