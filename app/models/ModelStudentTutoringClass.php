<?php
class ModelStudentTutoringClass {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTutoringClassByStudentId(int $studentId, array $filters = []): array {
//        Add optional parts to query to make filter

        $filterString = '';
        foreach ($filters as $field => $value) {
            if ($value != 'all') {
                if ($field == 'sort-subject') {
                    $filterString = $filterString . ' AND tutoring_class_template.subject_id=:subject_id';
                }elseif ($field == 'sort-completion') {
                    $filterString = $filterString . ' AND tutoring_class.completion_status=:completion_status';
                }elseif ($field == 'sort-payment') {
                    if ($value == 'payment-not-due') {
                        $filterString = $filterString . ' AND payment_due_day_counts.payment_due_day_count IS NULL';
                    }elseif ($value == 'payment-due') {
                        $filterString = $filterString . ' AND payment_due_day_counts.payment_due_day_count>0';
                    }
                }
            }
        }

        $this->db->query('SELECT 
                            tutoring_class.*,
                            tutoring_class_template.subject_id,
                            user.first_name,
                            user.last_name,
                            user.profile_picture,
                            subject.name as subject_name,
                            module.name as module_name,
                            day_counts.day_count,
                            incomplete_day_counts.incomplete_day_count,
                            payment_due_day_counts.payment_due_day_count
                        FROM 
                            tutoring_class
                            JOIN user ON tutoring_class.tutor_id = user.id
                            JOIN tutoring_class_template ON tutoring_class.class_template_id = tutoring_class_template.id
                            JOIN subject ON tutoring_class_template.subject_id = subject.id
                            JOIN module ON tutoring_class_template.module_id = module.id
                            LEFT JOIN (
                                SELECT class_id, COUNT(*) as day_count
                                FROM day
                                WHERE is_hidden = 0
                                GROUP BY class_id
                            ) as day_counts ON tutoring_class.id = day_counts.class_id
                            LEFT JOIN (
                                SELECT class_id, COUNT(*) as incomplete_day_count
                                FROM day
                                WHERE is_hidden = 0 AND is_completed = 0
                                GROUP BY class_id
                            ) as incomplete_day_counts ON tutoring_class.id = incomplete_day_counts.class_id
                            LEFT JOIN (
                                SELECT class_id, COUNT(*) as payment_due_day_count
                                FROM day
                                WHERE is_completed = 1 AND payment_status = 0
                                GROUP BY class_id
                            ) as payment_due_day_counts ON tutoring_class.id = payment_due_day_counts.class_id
                            WHERE tutoring_class.student_id = :student_id' . $filterString);

        $this->db->bind('student_id', $studentId, PDO::PARAM_INT);

        if (isset($filters['sort-subject']) && $filters['sort-subject'] != 'all') {
            $this->db->bind('subject_id', $filters['sort-subject'], PDO::PARAM_INT);
        }

        if (isset($filters['sort-subject']) && $filters['sort-completion'] == 'not-completed') {
            $this->db->bind('completion_status', 0, PDO::PARAM_INT);
        }elseif (isset($filters['sort-subject']) && $filters['sort-completion'] == 'completed') {
            $this->db->bind('completion_status', 1, PDO::PARAM_INT);
        }

        return $this->db->resultAllAssoc();
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

        //        Get the number of complete and incomplete day counts
        $this->db->query('
                SELECT COUNT(day.id) as day_count FROM tutoring_class JOIN day ON
                tutoring_class.id= day.class_id WHERE tutoring_class.id=:id AND day.is_hidden = 0'
        );
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $dayCount = $this->db->resultOneAssoc();
        $tutoring_class['day_count'] = $dayCount['day_count'];

        $this->db->query('
                SELECT COUNT(day.id) as incomplete_day_count FROM tutoring_class JOIN day ON
                tutoring_class.id= day.class_id WHERE tutoring_class.id=:id AND day.is_completed = 1 AND day.is_hidden = 0'
        );

        $this->db->bind('id', $id, PDO::PARAM_INT);
        $incompleteDayCount = $this->db->resultOneAssoc();
        $tutoring_class['incomplete_day_count'] = $incompleteDayCount['incomplete_day_count'];

//        Get days
        $this->db->query('SELECT * FROM day WHERE class_id=:id AND is_hidden=0 ORDER BY position asc');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $days = $this->db->resultAllAssoc();

        $tutoring_class['days'] = $days;

//        Get activities for each day
        foreach ($tutoring_class['days'] as $key => $day) {
            $this->db->query('SELECT * FROM activity WHERE day_id=:day_id AND is_hidden=0');
            $this->db->bind('day_id', $day['id'], PDO::PARAM_INT);
            $activities = $this->db->resultAllAssoc();

//            Add session rate into each day sub array (because it is needed in that way to implement payment)
            $tutoring_class['days'][$key]['session_rate'] = $tutoring_class['session_rate'];

//            Format file download link
            foreach ($activities as $actKey => $actValue) {
                if ($actValue['type'] != 2) {
                    $explodedFileName = explode('/', $actValue['link']);
                    $activities[$actKey]['link'] = end($explodedFileName);
                }
            }

            $tutoring_class['days'][$key]['activities'] = $activities;
        }

        return $tutoring_class;
    }
}
